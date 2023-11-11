@extends('layouts.guest')

@section('title', 'TODO編集')

@section('content')

<div class="flex justify-between items-center">
    <h1 class="font-bold text-3xl text-left mb-8 sm:text-5xl">TODO編集</h1>
</div>

<div class="mb-6">
    <form class="flex flex-col space-y-4" method="POST" action="{{ route('todo.updateEdit', $todo->id) }}">
        @csrf
        @method('PUT')
        <input type="text" name="item_name" placeholder="TODO名(25文字以内)" class="py-3 px-4 bg-gray-100 rounded-xl" value="{{ $todo->item_name }}">
        <textarea name="item_description" placeholder="内容(50文字以内)" class="py-3 px-4 bg-gray-100 rounded-xl">{{ $todo->item_description }}</textarea>
        <div class="flex space-x-6">
            <button class="w-28 py-4 px-8 bg-blue-500 font-bold text-white rounded-xl">保存</button>
            <a href="{{ route('todo') }}">
                <button type="button" class="w-28 py-4 px-8 bg-red-500 font-bold text-white rounded-xl" onclick="return confirm('トップページに戻りますか？');">戻る</button>
            </a>
        </div>
    </form>
</div>

<!-- 入力でバリデーションに引っかかったらエラーメッセージが出る。 -->
@if ($errors->has('item_name') || $errors->has('item_description'))
<div class="text-red-500 font-bold text-sm sm:font-normal sm:text-base">
    @foreach ($errors->all() as $error)
    {{ $error }}<br>
    @endforeach
</div>

@endif
@endsection