@extends('layouts.guest')

@section('title', 'ログイン')

@section('content')

<div class="flex flex-col items-center">

    <p class="py-4 font-bold">TODOリスト</p>
    <h1 class="text-3xl font-bold text-center mb-6">ログイン</h1>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="flex flex-col items-center mb-6">

            <div>
                <x-input-label for="user" :value="__('ユーザー名')" />
                <input type="text" id="user" class="py-3 px-4 bg-gray-100 rounded-xl" type="text" name="user" :value="old('user')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <input type="password" id="password" class="py-3 px-4 bg-gray-100 rounded-xl" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('user')" class="mt-2" />
            </div>

            <div class="mt-4">
                <button type="submit" class="w-28 py-4 px-7 bg-blue-500 font-bold text-white rounded-xl">
                    {{ __('Log in') }}
                </button>
            </div>
        </div>

    </form>
</div>

@endsection