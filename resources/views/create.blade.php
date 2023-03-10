@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100" style="--bs-gutter-x: initial">
    <div class="card w-100">
        <div class="card-header">新規メモ作成</div>
        <div class="card-body">
            <form method='POST' action="/store">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group" style="margin-bottom:20px;">
                    <label for="tag">題名</label>
                    <textarea name='content_name' class="form-control"rows="1" value="" placeholder="題名を入力してください"required></textarea>
                </div>

                <div class="form-group" style="margin-bottom:20px;">
                    <label for="tag">本文</label>
                    <textarea name='content' class="form-control"rows="10"></textarea>
                </div>

                <div class="form-group" style="margin-bottom:20px;">
                    <label for="tag">タグ</label>
                    <input name='tag' type="text" class="form-control" id="tag" placeholder="タグを入力">
                </div>
                <button type='submit' class="btn btn-primary btn-lg">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection