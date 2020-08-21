@extends('layout')
@section('title','ブログ一覧')
@section('content')
<div class="container">
    <div class="card">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>ブログ記事一覧</h2>
                @if(session('err_msg'))
                <p>{{ session('err_msg') }}</p>
                @endif
                <table able class="table table-striped">
                    <tr>
                        <th>記事番号</th>
                        <th>タイトル</th>
                        <th>日付</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
                        <td>{{ $blog->updated_at }}</td>
                        <td><button type="button" class="btn btn-primary"
                                onclick="location.href='/blog/edit/{{ $blog->id }}'">
                                編集
                            </button>
                        </td>
                        <td><button type="button" class="btn btn-primary"
                                onclick="location.href='/blog/delete/{{ $blog->id }}'">
                                削除
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection