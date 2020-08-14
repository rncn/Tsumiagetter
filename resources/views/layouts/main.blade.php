@extends('layouts.frame')
@section('body')
<header>
    <a href="{{route('index')}}"><p class="brand">{{ config('app.name') }}</p></a>
    <form class="sform" method="GET" action="{{ route('search') }}">
            @csrf
            <input name="name" class="search" type="text" uk-tooltip="Twitterのidで検索すると、そのidに関連づけされた積み上げが見れます。(本サービスに登録している場合にのみ)" placeholder="あの人の積み上げを検索..."
            {{-- もし、ユーザーで検索していたら、ユーザー名を表示 --}}
            @if(isset($show_user))
                value="{{$show_user->name}}"
            @endif
            >
    </form>    
    <div id="button">
        @if(Auth::check())
            <a href="{{ route('dashbord') }}">ダッシュボードへ移動</a>
        @else
            <a href="{{route('login')}}">Twitterでログイン</a>
        @endif
    </div>
</header>
<article>
    @yield('article')
</article>
@endsection