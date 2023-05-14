@extends('layouts.default')

@sction('title')
予約完了
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endpush

@section('content')
<div class="done__box">
  <p>ご予約ありがとうございます。</p>
  <a href="/">戻る</a>
</div>

@endsection