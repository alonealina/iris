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

    public function news_update(Request $request)
    {
        $rules = [
            'title' => ['max:20', 'required'],
            'content' => 'required',
        ];

        $messages = [
            'title.max' => 'タイトルは20文字以下でお願いします',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '内容を入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $news = News::find($request['id']);

        $fill_data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'release_flg' => $request['release'] == 1 ? 1 : 0,
            'notice_date' => date('Y/m/d'),
        ];

        DB::beginTransaction();
        try {
            $news->update($fill_data);
            DB::commit();
            return redirect()->to('admin/news_list')->with('message', 'お知らせの更新が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function news_delete($id)
    {
        DB::beginTransaction();
        try {
            News::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.news_list')->with('message', 'お知らせ情報を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
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
