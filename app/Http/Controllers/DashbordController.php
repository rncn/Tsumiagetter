<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Socialite;
use App\User;
use Auth;
use App\Tsumiage;
use App\Folder;
use Spatie\GoogleCalendar\Event;
class DashbordController extends Controller
{
    function showDashbord(){
        if(! Auth::check()) {
            return redirect()->route('index');
        }
        $tsumiagedata = Tsumiage::where('user_id', Auth::user()->id)->get();
        $tsumiagefolder = Folder::where('user_id', Auth::user()->id)->get();

        return view('dashbord', [
            'tsumiagedata' => $tsumiagedata,
            'tsumiagefolder' => $tsumiagefolder
        ]);
    }

    function showTweetformat(){
        //ログインしてますか
        if(! Auth::check()) {
            return redirect()->route('index');
        }
        return view('dashbords.tweetformat');
    }

    function showSettings(){
        //ログインしてますか
        if(! Auth::check()) {
            return redirect()->route('index');
        }
        $calendarid = Auth::user()->calendarid;
        return view('dashbords.settings', ['calendarid' => $calendarid, 'error' => false]);
    }

    /**
     *
     * @param  Request  $request
     * @return Response
     */

    function postTsumiage(Request $tsumiage){
        //ログインしてますか
        if(! Auth::check()) {
            return redirect()->route('index');
        }

        $validatedData = $tsumiage->validate([
            'name' => ['required', 'string', 'max:21'],
            'folder' => ['required'],
        ]);

        //エラー回避
        error_reporting(E_ALL ^ E_NOTICE);
        //公開設定チェックしていたら
        if(is_null($tsumiage->isprivate[0])){
            $isprivate = false;
        } elseif($tsumiage->isprivate[0] == 'on') {
            $isprivate = true;
        }
        $post = new Tsumiage;
        $post->name = $tsumiage->name;
        $post->user_id = Auth::user()->id;
        $post->isprivate = $isprivate;
        $post->pfolder_id = $tsumiage->folder;
        $post->save();

        //GoogleCalendarと同期
        //まず、Calendar IDが設定してあるかな？
        if(! is_null(Auth::user()->calendarid)) {
            $event = new Event;

            $event->name = "{$post->name}@r";
            $event->startDate = Carbon::now();
            $event->endDate = Carbon::now()->addDay();

            $event->save();
        }

        return redirect()->route('dashbord');
    }

    function deleteTsumiage($tsumiageid){
        //それ、存在しますか
        $post = \App\Tsumiage::where('id', $tsumiageid)->first();
        if(! $post){
            return redirect()->route('dashbord');
        }
        //それ、あなたのですか
        if($post->user_id == Auth::user()->id) {
            //自分のだったら削除
            $post->delete();
        }
        return redirect()->route('dashbord');
    }

    /**
     *
     * @param  Request  $request
     * @return Response
     */

    function postFolder(Request $folder){
        //ログインしてますか
        if(! Auth::check()) {
            return redirect()->route('index');
        }

        $validatedData = $folder->validate([
            'name' => ['required', 'string', 'max:16'],
        ]);

        $add = new Folder;
        $add->user_id = Auth::user()->id;
        $add->name = $folder->name;
        $add->save();
        return redirect()->route('dashbord');
    }

    /**
     *
     * @param  Request  $request
     * @return Response
     */

    function setCalendarID(Request $request) {
        //ログインしてますか
        if(! Auth::check()) {
            return redirect()->route('index');
        }
        $validatedData = $request->validate([
            'id' => ['max:255'],
        ]);
        
        //テスト
        if(! is_null($request->id)){
            try {
                Event::get(null, null, [], $request->id);
            } catch (\Exception $e) {
                return view('dashbords.settings', ['calendarid' => false, 'error' => '正常に接続できませんでした。もう一度確認してください。']);
            } 
        }

        $set = User::where('id', Auth::user()->id)->first();
        $set->calendarid = $request->id;
        $set->save();
        
        return view('dashbords.settings', ['calendarid' => $request->id, 'error' => false]);
    }
}
