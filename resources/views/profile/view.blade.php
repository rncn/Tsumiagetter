@extends('layouts.main')
@section('page-title', "{$show_user->name}")
@section('article')
    <h2>{{$show_user->name}} の公開積み上げ</h2>
@endsection