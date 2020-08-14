<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
class SearchController extends Controller
{

    /**
     *
     * @param  Request  $request
     * @return Response
     */
    function viewProfile(Request $req){
        //空白だったら、トップページへ移動
        if(is_null($req->name)){
            return redirect()->route('index');
        }
        $user = User::where('name', $req->name)->first();
        if (is_null($user)) {
            return view('profile.notfound');
        } 
        return view('profile.view', ['show_user'=>$user]);
    }
}
