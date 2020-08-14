<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use App\Folder;
use Auth;
class SnsBaseController extends Controller
{
    //https://qiita.com/nooboolean/items/7c524cb84bf5dc4f52c3
    public function getAuth() {
        return Socialite::driver('twitter')->redirect();
    }
    public function authCallback() {
        //https://qiita.com/KeisukeKudo/items/18dd8a342a4bdd43913c
        //DB保存
        $socialUser = Socialite::driver('twitter')->user();
        $user = User::firstOrNew(['email' => $socialUser->getEmail()]);

        // すでに会員になっている場合の処理を書く
        // そのままログインさせてもいいかもしれない
        if ($user->exists) {
            Auth::login($user);
            return redirect()->route('dashbord');
        }
        $user->email = $socialUser->getEmail();
        $user->name = $socialUser->getNickname();
        $user->save();

        Auth::login($user);

        //初期設定
        Self::initial(Auth::user());

        return redirect()->route('dashbord');
    }
    public static function getProviderUserInfo(){
        return Socialite::driver('twitter')->user();
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }

    private static function initial($user) {
        //初期フォルダーの追加
        $folder = new Folder;
        $folder->name = "規定のフォルダー";
        $folder->user_id = $user->id;
        $folder->save();
        return;
    }
}
