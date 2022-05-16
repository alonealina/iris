<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Application;
use App\Models\Adminuser;
use App\Rules\AlphaNumCheck;
use App\Rules\PhoneCheck;
use App\Rules\MailCheck;
use DB;
use Mail;
use Session;

class IrisController extends Controller
{

    public function app_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required',
            'uid' => 'required',
            'tel' => ['required', new PhoneCheck()],
            'mail' => ['required', 'email:strict,dns', new MailCheck()],
            'pass' => ['required', 'min:6', new AlphaNumCheck(), ],
        ];

        $messages = [
            'name.required' => 'お名前を入力してください',
            'code.required' => '紹介コードを入力してください',
            'uid.required' => 'Bitget UIDを入力してください',
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
            'uid' => $request['uid'],
            'tel' => $request['tel'],
            'mail' => $request['mail'],
            'code' => $request['code'],
            'pass' => $request['pass'],
        ];

        $data = ['mail' => $request['mail'],
        'pass' => $request['pass'],];

        $this->mail = $request['mail'];

        DB::beginTransaction();
        try {
            $application->fill($fill_data)->save();
            DB::commit();
            Mail::send('mail', $data, function($message){
                $message->to($this->mail)->subject('【 Iris system 】ご登録ありがとうございます！');
            });
            return redirect()->to('complete')->with('id', $application->id);
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

        $data = ['txid' => $request['txid'],];

        $this->mail = $application->mail;

        DB::beginTransaction();
        try {
            $application->update($fill_data);
            DB::commit();
            Mail::send('mail_txid', $data, function($message){
                $message->to($this->mail)->subject('【 Iris system 】お支払いが完了いたしました');
            });
            return redirect()->to('complete_pay')->with('id', $request['id']);
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

    public function complete_pay()
    {
        $id = Session::get('id');
        if (is_null($id)) {
            return redirect('/');
        } else {
            return view('complete_pay');
        }
    }

    public function dashboard()
    {
        $id = Session::get('id');
        $app = Application::where('id', $id)->first();
        return view('dashboard', ['app' => $app]);
    }

    public function connect(Request $request)
    {
        $rules = [
            'uid' => 'required',
        ];

        $messages = [
            'uid.required' => 'Bitget UIDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $application = Application::find($request['id']);

        $fill_data = [
            'uid' => $request['uid'],
            'api_key' => $request['api_key'],
            'secret_key' => $request['secret_key'],
            'pass_t' => $request['pass_t'],
        ];

        DB::beginTransaction();
        try {
            $application->update($fill_data);
            DB::commit();
            return redirect()->to('dashboard')->with('message', '保存しました');
        } catch (\Exception $e) {
            DB::rollback();
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
            $app_list = Application::orwhere('name', 'like', "%$freeword%")->orwhere('uid', 'like', "%$freeword%")->orwhere('tel', 'like', "%$freeword%")
                ->orwhere('mail', 'like', "%$freeword%")->orwhere('code', 'like', "%$freeword%")->orwhere('txid', 'like', "%$freeword%")
                ->where('delete_flg', 0)->where('check_flg', 0)->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $app_list = Application::where('delete_flg', 0)->where('check_flg', 0)->orderBy('created_at', 'desc')->paginate(15);
        }

        return view('app_list', [
            'app_list' => $app_list,
        ]);
    }

    public function deleted_list(Request $request)
    {
        $filter_array = $request->all();
        $freeword = null;

        if (isset($filter_array['freeword'])) {
            $freeword = $filter_array['freeword'];
        }

        if (!empty($freeword)) {
            $app_list = Application::orwhere('name', 'like', "%$freeword%")->orwhere('uid', 'like', "%$freeword%")->orwhere('tel', 'like', "%$freeword%")
                ->orwhere('mail', 'like', "%$freeword%")->orwhere('code', 'like', "%$freeword%")->orwhere('txid', 'like', "%$freeword%")
                ->where('delete_flg', 1)->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $app_list = Application::where('delete_flg', 1)->orderBy('created_at', 'desc')->paginate(15);
        }

        return view('deleted_list', [
            'app_list' => $app_list,
        ]);
    }

    public function checked_list(Request $request)
    {
        $filter_array = $request->all();
        $freeword = null;

        if (isset($filter_array['freeword'])) {
            $freeword = $filter_array['freeword'];
        }

        if (!empty($freeword)) {
            $app_list = Application::orwhere('name', 'like', "%$freeword%")->orwhere('uid', 'like', "%$freeword%")->orwhere('tel', 'like', "%$freeword%")
                ->orwhere('mail', 'like', "%$freeword%")->orwhere('code', 'like', "%$freeword%")->orwhere('txid', 'like', "%$freeword%")
                ->where('check_flg', 1)->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $app_list = Application::where('check_flg', 1)->orderBy('created_at', 'desc')->paginate(15);
        }

        return view('checked_list', [
            'app_list' => $app_list,
        ]);
    }

    public function app_list_update(Request $request)
    {
        $request = $request->all();
        $chk_list = isset($request['chk']) ? $request['chk'] : null;
        $type = $request['type'];
        if (!empty($chk_list)) {
            DB::beginTransaction();
            foreach ($chk_list as $chk) {
                try {
                    Application::where('id', $chk)->update(['delete_flg' => 1, $type => 1]);
                } catch (\Exception $e) {
                    DB::rollback();
                }
            }
            DB::commit();
        }

        return redirect('admin/app_list')->with('message', '申し込みを削除しました');
    }

    public function app_active($id, $flg)
    {
        DB::beginTransaction();
        try {
            Application::where('id', $id)->update(['active_flg' => $flg]);
        } catch (\Exception $e) {
            DB::rollback();
        }

        DB::commit();

        return redirect('admin/app_list')->with('message', '申し込みを変更しました');
    }

    public function csv_export()
    {
        $apps = Application::where('delete_flg', 0)->orderBy('created_at', 'desc')->get();
        $cvsList[] = ['お名前', '電話番号', 'メールアドレス', 'パスワード', '紹介コード', 'Bitget UID', 'API Key', 'Secret Key', 'TXID', 'API Status', '作成日時', 
        ];
        foreach ($apps as $app) {
            $cvsList[] = $app->outputCsvContent();
        }

        $response = new StreamedResponse (function() use ($cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            $buffer = str_replace("\n", "\r\n", stream_get_contents($stream));
            fclose($stream);
            //出力ストリーム
            $fp = fopen('php://output', 'w+b');
            //さっき置換した内容を出力 
            fwrite($fp, $buffer);
        
            fclose($fp);
        });
        
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="iris.csv"');
 
        return $response;
    }

    public function forget_mail(Request $request)
    {
        $rules = [
            'name' => 'required',
            'mail' => 'required',
            'tel' => 'required',
            'uid' => 'required',
        ];

        $messages = [
            'name.required' => '名前を入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'tel.required' => '電話番号を入力してください',
            'uid.required' => 'Bitget UIDを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $data = ['name' => $request->name,
        'mail' => $request->mail,
        'tel' => $request->tel,
        'uid' => $request->uid,];

        Mail::send('mail_forget', $data, function($message){
            $message->to('william_billl2008@yahoo.co.jp')->subject('【 Iris system 】Forget password');
        });

        return redirect('reminder_comp');
    }
    
    public function login_user(Request $request)
    {
        $user = Application::where('mail', $request->login_id)->where('delete_flg', 0)->first();
        if (isset($user)) {
            if ($request->password == $user->pass) {
                // セッション
                session(['id' => $user->id]);
                session(['mail' => $user->mail]);
                return redirect('dashboard'); 
            }
        }

        return redirect('login')->with(['login_error' => 1]);
    }
    
    public function logout_user()
    {
        session()->forget('id');
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
