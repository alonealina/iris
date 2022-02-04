<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use App\Models\Adminuser;
use App\Rules\PhoneCheck;
use DB;
use Mail;
use Session;

class IrisController extends Controller
{

    public function app_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'tel' => ['required', new PhoneCheck()],
            'mail' => ['required', 'email:strict,dns']
        ];

        $messages = [
            'name.required' => 'お名前を入力してください',
            'address.required' => '住所を入力してください',
            'tel.required' => '電話番号を入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.email' => 'メールアドレスが不正です',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $application = new Application();

        $request = $request->all();
        $fill_data = [
            'name' => $request['name'],
            'address' => $request['address'],
            'tel' => $request['tel'],
            'mail' => $request['mail'],
            'code' => $request['code'],
        ];

        DB::beginTransaction();
        try {
            $application->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('settle')->with('id', $application->id);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function settle()
    {
            return view('settle_form');
    }

    public function confirm_post(Request $request)
    {
        return redirect()->to('confirm')->with('id', $request->id);
    }

    public function confirm(Request $request)
    {
        $id = Session::get('id');
        if (is_null($id) && is_null($request->old('id'))) {
            return redirect('/');
        } else {
            return view('confirm_form');
        }
    }

    public function txid_store(Request $request)
    {
        $rules = [
            'txid' => 'required',
        ];

        $messages = [
            'txid.required' => 'TXIDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $application = Application::find($request['id']);

        $fill_data = [
            'txid' => $request['txid'],
        ];

        DB::beginTransaction();
        try {
            $application->update($fill_data);
            DB::commit();
            return redirect()->to('complete')->with('id', $request['id']);
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function complete()
    {
        $id = Session::get('id');
        if (is_null($id)) {
            return redirect('/');
        } else {
            return view('complete');
        }
    }

    public function app_list(Request $request)
    {
        $filter_array = $request->all();
        $freeword = null;

        if (isset($filter_array['freeword'])) {
            $freeword = $filter_array['freeword'];
        }

        if (!empty($freeword)) {
            $app_list = Application::orwhere('name', 'like', "%$freeword%")->orwhere('address', 'like', "%$freeword%")->orwhere('tel', 'like', "%$freeword%")
                ->orwhere('mail', 'like', "%$freeword%")->orwhere('code', 'like', "%$freeword%")->orwhere('txid', 'like', "%$freeword%")
                ->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $app_list = Application::orderBy('created_at', 'desc')->paginate(15);
        }

        return view('app_list', [
            'app_list' => $app_list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filter_array = $request->all();
        $freeword = null;

        if (isset($filter_array['area'])) {
            $area = $filter_array['area'];
        }
        if (isset($filter_array['open_only'])) {
            $open_only = $filter_array['open_only'];
        }
        if (isset($filter_array['highly_rated'])) {
            $highly_rated = $filter_array['highly_rated'];
        }

        if (isset($filter_array['freeword'])) {
            $freeword = $filter_array['freeword'];
        }

        $category_id = $filter_array['category_id'];
        $open = $filter_array['open'];
        $close = $filter_array['close'];
        $pref = $filter_array['pref'];
        unset($filter_array['search_radio'], $filter_array['search_radio_ipad'], $filter_array['freeword'], $filter_array['open'], $filter_array['close'],
        $filter_array['pref'], $filter_array['area'], $filter_array['open_only'], $filter_array['highly_rated']);
        
        $query = Restaurant::where('release_flg', 1);

        if (!empty($freeword)) {
            $query->where(function ($query) use ($freeword) {
                $query->whereIn('restaurants.id', function($q) use($freeword) {
                    return $q->from('menus')
                        ->select('restaurant_id')
                        ->where('name', 'like', "%$freeword%")
                        ->groupBy('restaurant_id');
                    })
                    ->orwhere('name1', 'like', "%$freeword%")->orwhere('name2', 'like', "%$freeword%")->orwhere('name3', 'like', "%$freeword%")
                    ->orwhere('profile', 'like', "%$freeword%")->orwhere('zip', 'like', "%$freeword%")->orwhere('pref', 'like', "%$freeword%")
                    ->orwhere('address', 'like', "%$freeword%")->orwhere('address_remarks', 'like', "%$freeword%")->orwhere('url', 'like', "%$freeword%")
                    ->orwhere('tel', 'like', "%$freeword%")->orwhere('access', 'like', "%$freeword%")->orwhere('station1', 'like', "%$freeword%")
                    ->orwhere('station2', 'like', "%$freeword%")->orwhere('station3', 'like', "%$freeword%")->orwhere('station4', 'like', "%$freeword%")
                    ->orwhere('station5', 'like', "%$freeword%")->orwhere('route1', 'like', "%$freeword%")->orwhere('route2', 'like', "%$freeword%")
                    ->orwhere('route3', 'like', "%$freeword%")->orwhere('route4', 'like', "%$freeword%")->orwhere('route5', 'like', "%$freeword%");
                });
        }

        if (isset($request['scenes'])) {
            $restaurant_id_list_scene = array_column(Restaurant::get()->toArray(), 'id');
            foreach ($request['scenes'] as $key => $value) {
                $restaurant_scenes = array_column(RestaurantScene::where('scene_id', $key)->get()->toArray(), 'restaurant_id');
                $restaurant_id_list_scene = array_intersect($restaurant_id_list_scene, $restaurant_scenes);
            }
            $query->whereIn( 'restaurants.id', $restaurant_id_list_scene);
        }

        if (isset($request['commitments'])) {
            $restaurant_id_list_commitment = array_column(Restaurant::get()->toArray(), 'id');
            foreach ($request['commitments'] as $key => $value) {
                $restaurant_commitments = array_column(RestaurantCommitment::where('commitment_id', $key)->get()->toArray(), 'restaurant_id');
                $restaurant_id_list_commitment = array_intersect($restaurant_id_list_commitment, $restaurant_commitments);
            }
            $query->whereIn( 'restaurants.id', $restaurant_id_list_commitment);

        }

        if ($area == 'area') {
            $query->where('pref', $pref);
        } 
        if ($open_only == 'open_only') {
            $query->whereTime('close_time', '>=', date("H:i:s"));
            $query->whereTime('open_time', '<=', date("H:i:s"));
        }
        if ($highly_rated == 'highly_rated') {
            $avg_star_4 = Comment::selectRaw('restaurant_id, AVG(fivestar) as avg_star')
                ->groupBy('restaurant_id')
                ->having('avg_star', '>=', 4)->get();
            $id_list = [];
            foreach ($avg_star_4 as $value) {
                $id_list[] = $value->restaurant_id;
            }
            $query->WhereIn('restaurants.id', $id_list);
        } 

        if ($open != 0) {
            $query->whereTime('close_time', '>=', $open);
        } else {
            // フィルター検索値保持用
            $open = 'none';
        }
        if ($close != 0) {
            $query->whereTime('open_time', '<', $close);
        } else {
            // フィルター検索値保持用
            $close = 'none';
        }
        if ($category_id != '指定なし') {
            $query->where('category_id', $category_id);
        } else {
            // フィルター検索値保持用
            $category_id = '指定なし';
        }

        $restaurants = $query->paginate(24);

        $scenes = Scene::all();
        $commitments = Commitment::all();
        $filter_scenes = isset($request['scenes']) ? $request['scenes'] : null;
        $filter_commitments = isset($request['commitments']) ? $request['commitments'] : null;
        return view('search', [
            'categories' => $categories,
            'restaurants' => $restaurants,
            'scenes' => $scenes,
            'commitments' => $commitments,
            'freeword' => $freeword,
            'filter_freeword' => $freeword,
            'filter_pref' => $pref,
            'area' => $area,
            'open_only' => $open_only,
            'highly_rated' => $highly_rated,
            'filter_category_id' => $category_id,
            'filter_open' => $open,
            'filter_close' => $close,
            'filter_scenes' => $filter_scenes,
            'filter_commitments' => $filter_commitments,
        ]);
    }

    public function login(Request $request)
    {

        $admin_user = Adminuser::where('login_id', $request->login_id)->first();
        if (isset($admin_user)) {
            if ($request->password == $admin_user->password) {
                // セッション
                session(['login_id' => $admin_user->login_id]);
                return redirect('admin/app_list'); 
            }
        }

        return redirect('admin/login', ['login_error' => '1']);
    }
    
    public function logout(Request $request)
    {
        session()->forget('login_id');
        return redirect('admin/login');
    }

}
