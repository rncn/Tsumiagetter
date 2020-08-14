@extends('layouts.frame')
@section('body')
    <header>
        <p class="brand">{{ config('app.name') }}</p>
        <form class="sform" method="GET" action="{{ route('search') }}">
            @csrf
            <input name="name" class="search" type="text" uk-tooltip="Twitterのidで検索すると、そのidに関連づけされた積み上げが見れます。(本サービスに登録している場合にのみ)" placeholder="あの人の積み上げを検索...">
        </form>
        <button class="col-w" type="button" uk-icon="menu"></button>
            <div uk-dropdown="mode: click; pos: bottom-right;">
                <ul class="uk-nav uk-dropdown-nav">
                    <h4>{{Auth::user()->name}}</h4>
                    <li><a href="{{route('jumptwlink')}}">お問い合わせ</a></li>
                    <li><a href="http://rncn.github.io/pp">利用規約/プライバシー・ポリシー</a></li>
                    <li><a href="{{route('logout')}}">ログアウト</a></li>
                </ul>
            </div>
    </header>
    <article>
        <div class="dashbord">
            <div class="navbar">
                <h3>{{Auth::user()->name}}</h3>
                <p>積み上げPoint : </p>
                <ul class="uk-nav">
                    <li><a href="{{route('dashbord')}}">積み上げ管理</a></li>
                    <li><a href="">積み上げをツイート</a></li>
                    <li><a href="">過去の積み上げ(アーカイブ)</a></li>
                    <li><a href="{{route('dashbord.format')}}">ツイートフォーマット</a></li>
                    <li><a href="{{route('dashbord.settings')}}">設定</a></li>
                    <li><a href="{{route('logout')}}">ログアウト</a></li>
                </ul>
                <a href="#" uk-toggle="target: #howtouse">詳しい使い方を見る</a>
                <div id="howtouse" hidden>
                    <h3 id="hwu_about">積み上げtterは積み上げを管理しやすくするためのツールです</h3>
                        <p>#今日の積み上げ を管理しやすくすることによって、積み上げを確実なものにします。</p>
                    <h3 id="hwu_warning">Warning: 積み上げは一日たつと、アーカイブされます</h3>
                        <p>
                            <ul>
                                <li>Googleと同期しておきたい方は、GoogleCalendarと同期してください</li>
                                <li>同期先のGoogleカレンダーの予定は削除されません</li>
                                <li>{{ config('app.name') }}で同期されたイベント名には、@tがつきます</li>
                                <li>Googleカレンダーからは同期されません</li>
                            </ul>
                        </p>
                    <h3 id="hwu_syncgoogle">Googleとの同期の仕方</h3>
                        <p><b>まず、Googleアカウントを用意してください。</b></p>
                        <ol>
                            <li>Google Calendarにアクセスします。</li>
                            <li>設定を開きます。</li>
                            <li>「マイカレンダーの設定」という項目がありますから、そこをクリックします。</li>
                            <li>「特定のユーザーとの共有」を見つけて開きます</li>
                            <li>「+ユーザーを追加」 をクリックします</li>
                            <li><pre>tsumiagetter@tsumiagetter.iam.gserviceaccount.com</pre>を入力して、「権限」を「予定の変更」に変更します。</li>
                            <li>「送信」をクリックします。</li>
                        </ol>
                        <p><b>画面はそのままにしてください。次があります。</b></p>
                        <ol>
                            <li>先程の「マイカレンダーの設定」の中にある、「カレンダーの統合」をクリックしてください。</li>
                            <li>「カレンダーID」というものが記されていますので、それをコピー([Ctrl]+[V]、または、長くタップして、メニューから「コピー」を選択)してください。</li>
                            <li>コピーしたものを、上記フォームに貼り付けてください。</li>
                        </ol>
                </div>
            </div>
            <div class="main">
                @yield('article')
            </div>
        </div>
    </article>
@endsection