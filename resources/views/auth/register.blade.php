@extends('layouts.default')

@section('title')
会員登録
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/auth/common.css') }}">
@endpush

@section('content')

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo" class="logo"></x-slot>

        <div class="auth-common__form">
            <p class="auth-common__form-title">Registration</p>
            <div class="auth-common__form-item">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="auth-common__name-wrap">
                        <input type="text" id="name" class="auth-common__name" name="name" placeholder="Username" value="{{ old('name') }}" required />
                    </div>
                    @error('name')
                    <div class="validation__error-red">
                        <p>Error:{{$message}}</p>
                    </div>
                    @enderror

                    <!-- Email Address -->
                    <div class="auth-common__email-wrap">
                        <input id="email" class="auth-common__address" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                    </div>
                    @error('email')
                    <div class="validation__error-red">
                        <p>Error:{{ $maesage }}</p>
                    </div>
                    @enderror

                    <!-- Password -->
                    <div class="auth-common__pass-wrap">
                        <input id="password" class="auth-common__password" type="password" name="password" required autocomplete="new-password" placeholder="password" />
                    </div>
                    @error('password')
                    <div class="validation__error-red">
                        <p>Error:{{ $message }}</p>
                    </div>
                    @enderror

                    <div class="auth-common__submit-wrap">
                        <button class="auth-common__submit">登録</button>
                    </div>

                </form>

            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
@endsection