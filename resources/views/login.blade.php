@extends('layouts.main')
@section('page-title', 'ログイン')
@section('article')
@if(Auth::check())
<h2>すでにログインしてますよ</h2>
<p>ブラウザを閉じると、ログアウトします<br/>使ってくれてありがとうございます</p>
<a class="button" href="{{route('dashbord')}}">ダッシュボードへ</a>
@else
<h2>Twitter認証でログインしてください</h2>
<p>勝手にツイートしないよ。あんしんしてね。<br/>パスワード・DMとかも取得しません(できないようになってるよ)</p>
<h5>このサービスにTwitterでログインすると、利用規約及びプライバシーポリシーに同意したとみなされます。</h5>
<a class="button" href="{{route('auth.login')}}">Twitterでログイン</a>
@endif
@endsection
