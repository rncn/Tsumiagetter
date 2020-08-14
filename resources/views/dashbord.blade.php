@extends('layouts.dashbord')
@section('page-title', 'ホーム')
@section('article')
       
    <h2>積み上げ管理</h2>
    
    <form id="tsumiageform">
        
        <div>
            <input id="tsname" name="name" class="input" maxlength="21" type="text" placeholder="積み上げ 21文字以内" autocomplete="off">
        </div>
        <div>
            <label>
                <input id="tsprivate" type="checkbox" name="isprivate[0]"><span>非公開</span>
            </label>
        </div>
        <div>
            <span>追加先：</span>
            <select id="tsfolder" name="folder">
                @foreach ($tsumiagefolder as $tmagf)
                <option value="{{$tmagf->id}}">{{$tmagf->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="button" class="button" id="posttsumiagebutton">Add</button>
        @error('name')
            <div uk-alert>
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </form>

    <ul uk-tab>
        @foreach ($tsumiagefolder as $tmagf)
        <li><a href="#">{{$tmagf->name}}</a></li>
        @endforeach
        <li><a href="#">フォルダー追加</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        {{-- フォルダーループ --}}
        @foreach ($tsumiagefolder as $tmagf)
        <li>
            <button type="button" href="" uk-icon="menu"></button>
            <div uk-dropdown="mode: click">
                <h4>操作</h4>
                <ul class="uk-nav">
                    <li><a href="">フォルダーを削除</a></li>
                    <li><a href="">Googleからインポート</a></li>
                </ul>
            </div>
            <table id="todolist" class="uk-table uk-table-divider uk-table-justify">
                <thead>
                    <tr>
                        <th>積み上げ内容</th>
                        <th>ステータス</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tsumiagedata as $tmag)
                        @if($tmag->pfolder_id == $tmagf->id)
                        <tr>
                            <td>{{$tmag->name}}</td>
                            <td>
                                @if($tmag->isprivate)
                                    <span class="uk-label uk-label-warning">非公開</span>
                                @else
                                    <span class="uk-label uk-label-danger">未完了</span>
                                @endif
                            </td>
                            <td><a class="uk-button uk-button-primary uk-button-small">完了</a><a class="uk-button uk-button-danger uk-button-small" href="{{route('post.delete',['id'=>$tmag->id])}}">削除</a></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </li>
        @endforeach
        {{-- フォルダー追加 --}}
        <li>
            <h3>フォルダーを追加する</h3>
            <form action="{{route('post.folder')}}" method="POST">
                @csrf
                <input class="input" type="text" name="name" maxlength="16" placeholder="E.g. プログラミング">
                <button class="button">Add</button>
                @error('name')
                    <div uk-alert>
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </form>
        </li>
    </ul>
    
    <a class="button">#今日の積み上げ&nbsp;を宣言</a><a class="button">積み上げ結果&nbsp;を報告</a>

    <script type="text/javascript">
        $('#posttsumiagebutton').click( function (){
            console.log('wedwed');
            const tsname = document.forms.tsumiageform.tsname.value;
            const tsprivate = document.forms.tsumiageform.tsprivate.value;
            const tsfolder = document.forms.tsumiageform.tsfolder.value;
            $.ajax({
                    url: '{{route('post.tsumiages')}}',
                    type:'POST',
                    dataType: 'json',
                    data : {'name' : tsname, 'isprivate[0]': tsprivate, 'folder': tsfolder, '_token': "{{csrf_token()}}" },
                    timeout:3000,
                }).done(function(data) {
                                alert("ok");
                }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                                alert("error");
                })
            });
    </script>
@endsection