@extends('layouts.dashbord')
@section('page-title', '設定')
@section('article')
<h2>設定</h2>
<h3>Google Calendar ID</h3>
<form method="POST" action="{{route('dashbord.gcalset')}}">
    @csrf
    <label>空白にすると、Googleとの連携は解除されます。</label><br>
    <input name="id" class="input" type="text" autocomplete="off" value="@if($calendarid){{$calendarid}}@endif">
    @if($error)
        <div class="uk-alert-danger" uk-alert>{{$error}}<br/><a uk-toggle="target: #howtosetting" href="#">設定方法</a></div>
    @endif
    @if($calendarid)
        <div class="uk-alert-success" uk-alert>GoogleCalendarと共有しています。</div>
    @endif
    <button class="button" type="submit">完了</button>
</form>
<div>
    <a uk-toggle="target: #howtouse" href="#">設定方法</a>
</div>
<div>
    <h3>削除する：アカウント</h3>
    <form method="POST">
        @csrf
        <button class="button" type="button" uk-toggle="target: #deleteaccount">アカウントを削除しますか</button>
        <div id="deleteaccount" hidden>
            <h2>アカウントを削除</h2>
            <button class="button" type="submit">アカウントを削除する</button>
        </div>
    </form>
</div> 
@endsection