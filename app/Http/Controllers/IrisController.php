<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use App\Models\Adminuser;
use DB;
use Mail;

class IrisController extends Controller
{

    public function app_store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'mail' => 'required',
        ];

        $messages = [
            'name.required' => 'お名前を入力してください',
            'address.required' => '住所を入力してください',
            'tel.required' => '電話番号を入力してください',
            'mail.required' => 'メールアドレスを入力してください',
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

    public function confirm()
    {
        return view('confirm_form');
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
            return redirect()->to('complete');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function complete()
    {
        return view('complete');
    }

    public function login(Request $request)
    {

        $admin_user = Adminuser::where('login_id', $request->login_id)->first();
        if (isset($admin_user)) {
            if ($request->password == $admin_user->password) {
                // セッション
                session(['login_id' => $admin_user->login_id]);
                return redirect('admin/news_list'); 
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
