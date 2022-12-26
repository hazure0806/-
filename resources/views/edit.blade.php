@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100" style="--bs-gutter-x: initial">
    <div class="card w-100">
        <div class="card-header">
            メモ編集
            <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form' style="float: right;">
                 @csrf
                 <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
            </form>  
        </div>
        <div class="card-body">
            <form method='POST' action="{{ route('update', ['id' => $memo['id'] ] ) }}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group" style="margin-bottom:20px;">
                    <label for="tag">題名</label>
                    <textarea name='content_name' class="form-control"rows="1">{{ $memo['content_name'] }}</textarea>
                </div>

                <div class="form-group" style="margin-bottom:20px;">
                    <label for="tag">本文</label>
                    <textarea name='content' class="form-control"rows="10">{{ $memo['content'] }}</textarea>
                </div>
                <div class="form-group" style="margin-bottom:20px;">
                    <label for="tag">タグ</label>
                    <select class='form-control' name='tag_id' >
                @foreach($tags as $tag)
                    <option value="{{ $tag['id'] }}" {{ $tag['id'] == $memo['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection