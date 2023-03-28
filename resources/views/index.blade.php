@extends('layouts.default')

@section('content')
<div class="home-body">
    <header>
      <div class="wrap">
        <div class="logo">
          <a href="/"><img src="" alt="Rese"></a>
        </div>
        <div class="search">

        </div>
        <div class="mypage">
          
          <ul>
            <li></li>
            <li></li>
          </ul>
        </div>
      </div>
    </header>
    <main>
      @foreach($restaurants as $restaurant)
      <div class="card">
        <img class="rest_img" src="{{ $restaurant->img }}" alt="">
        <div class="rest_content">
          <p class="rest_name">{{ $restaurant->name }}</p>
          <span class="#">#{{ $restaurant->area->name }}</span>
          <span class="#">#{{ $restaurant->genre->name }}</span>
          <div class="bottom">
            <a href="/detail/{{ $restaurant->id }}">店舗詳細</a>
          </div>
        </div>
      </div>
      @endforeach
    </main>
@endsection