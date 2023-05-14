@extends('layouts.default')

@section('title')
会員登録完了
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endpush

@section('content')

<div class="thanks__box">
  <p>会員登録ありがとうございます</p>
  <a href="/login">ログインする</a>
</div>

@endsection