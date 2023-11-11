@extends('layouts.guest')

@section('title', 'TODOリスト')

@section('content')

<div class="flex justify-between items-start">
    <h1 class="font-bold text-3xl text-left mb-8 sm:text-5xl">TODOリスト</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="p-2 bg-red-500 text-white text-xs rounded-xl sm:text-base" onclick="return confirm('ログアウトしますか？');">
            ログアウト
        </button>
    </form>
</div>

<!-- TODOを追加する場所 -->
<div class="mb-6">
    <form class="flex flex-col space-y-4" method="POST" action="{{ route('todo.store') }}">
        @csrf
        <input type="text" name="item_name" placeholder="TODO名(25文字以内)" class="py-3 px-4 bg-gray-100 rounded-xl">
        <textarea name="item_description" placeholder="内容(50文字以内)" class="py-3 px-4 bg-gray-100 rounded-xl"></textarea>
        <button type="submit" class="w-28 py-4 px-8 bg-blue-500 font-bold text-white rounded-xl">追加</button>

        <!-- 入力でバリデーションに引っかかったらエラーメッセージが出る。 -->
        @if ($errors->has('item_name') || $errors->has('item_description'))
        <div class="text-red-500 font-bold text-sm sm:font-normal sm:text-base">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
        </div>
        @endif
    </form>
</div>

<!-- 作成されたTODOとボタンが表示される場所 -->
<div class="mt-2">

    <hr>

    @foreach($todos as $todo)
    <!-- 三項演算子で完了ボタンが押されたら背景色が緑色になる -->
    <div class="py-4 sm:flex item-start border-b border-gray-300 px-3 {{$todo->done==1 ? 'bg-green-200' : ''}}">

        <!-- 各TODOの表示 -->
        <div class="flex-l pr-8">
            <h3 class="font-semibold text-sm sm:text-lg">{{ $todo->item_name }}</h3>
            <p class="text-gray-500 text-sm sm:text-base">{{ $todo->item_description }}</p>
        </div>

        <!-- 各ボタンの表示 -->
        <div class="flex justify-end pt-3 sm:flex items-end space-x-4 ml-auto ml-0 sm:space-x-3">
            <!-- TODOの完了ボタン -->
            <form method="POST" action="{{ route('todo.updateDone', $todo->id) }}">
                @csrf
                @method('PATCH')
                <!-- TODOが完了(doneの値が1)してたらチェックマークになる -->
                @if($todo->done)
                <button class="py-1 px-1 bg-green-500 text-white rounded-xl sm:py-2 px-2">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4" />
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                    </svg>
                </button>
                <!-- TODOが未完了(doneの値が0)なら四角いマークになる -->
                @else
                <button class="py-1 px-1 bg-green-500 text-white rounded-xl sm:py-2 px-2">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                    </svg>
                </button>
                @endif
            </form>
            <!-- TODOの編集ボタン -->
            <a href="{{ route('todo.edit', $todo->id) }}">
                <button class="py-1 px-1 bg-blue-500 text-white rounded-xl sm:py-2 px-2">
                    <svg class="h-6 w-6 text-white" <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                </button>
            </a>
            <!-- TODOの削除ボタン -->
            <form method="POST" action="{{ route('todo.destroy' , $todo->id) }}">
                @csrf
                @method('DELETE')
                <button class="py-1 px-1 bg-red-500 text-white rounded-xl sm:py-2 px-2" onclick="return confirm('TODOを削除しますか？');">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection