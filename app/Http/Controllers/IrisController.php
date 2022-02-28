<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use App\Models\Adminuser;
use App\Rules\AlphaNumCheck;
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
            'mail' => ['required', 'email:strict,dns'],
            'pass' => ['required', 'min:6', new AlphaNumCheck(), ],
        ];

        $messages = [
            'name.required' => 'お名前を入力してください',
            'address.required' => '住所を入力してください',
            'tel.required' => '電話番号を入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.email' => 'メールアドレスを正しく入力してください',
            'pass.required' => 'パスワードを入力してください',
            'pass.min' => 'パスワードは6文字以上入力してください',
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
            'pass' => $request['pass'],
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

    public function dashboard()
    {
        return view('dashboard');
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

    public function login_user(Request $request)
    {
        $user = Application::where('mail', $request->login_id)->first();
        if (isset($user)) {
            if ($request->password == $user->pass) {
                // セッション
                session(['mail' => $user->mail]);
                return redirect('dashboard'); 
            }
        }

        return redirect('login')->with(['login_error' => 1]);
    }
    
    public function logout_user()
    {
        session()->forget('mail');
        return redirect('login');
    }

    public function login_admin(Request $request)
    {
        $admin_user = Adminuser::where('login_id', $request->login_id)->first();
        if (isset($admin_user)) {
            if ($request->password == $admin_user->password) {
                // セッション
                session(['login_id' => $admin_user->login_id]);
                return redirect('admin/app_list'); 
            }
        }

        return redirect('admin/login')->with(['login_error' => 1]);
    }
    
    public function logout_admin()
    {
        session()->forget('login_id');
        return redirect('admin/login');
    }

}
