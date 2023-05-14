@extends('layouts.default')

@section('title')
Rese
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')
<form action="/search" method="get">
  <table class="shop__search">
    <tr>
      <td>
        <div class="select-wrap">
          <select name="area" onchange="submit(this.form)">
          <option value="">ALL&nbsp;area</option>
          @foreach($areas as $area)
          <option value="{{ $area->id }}" @if(isset($input_area)) @if( $area->id == $input_area) selected @endif @endif>{{ $area->name }}</option>
          @endforeach
          </select>
        </div>
      </td>
      <td>
        <div class="select-wrap">
          <select name="genre" onchange="submit(this.form)">
          <option value="">ALL&nbsp;genre</option>
          @foreach($genres as $genre)
          <option value="{{ $genre->id }}" @if(isset($input_genre)) @if( $genre->id == $input_genre) selected @endif @endif>{{ $genre->name }}</option>
          @endforeach
          </select>
        </div>
      </td>
      <td>
        <div class="search_box">
          <input type="text" name="store_name" placeholder="Search..." value="@if (isset($input_content)) {{ $input_content }} @endif">
        </div>
      </td>
    </tr>
  </table>
  <input type="submit" class="search__submit">
</form>

<main class="rest__main">
@foreach ($restaurants as $restaurant)
  <div class="card">
    <div class="card__img">
      <img src="{{ $restaurant->image }}" alt="">
    </div>
    <div class="card__content">
      <h2 class="card__content-name">{{ $restaurant->name }}</h2>
      <p class="card__content-area">{{ $restaurant->getArea() }}</p>
      <p class="card__content-genre">{{ $restaurant->getGenre() }}</p>
      <div class="card__content-item">
        <form action="/detail/" method="get">
          <button class="to-detail__button" name="restaurant_id" value="{{ $restaurant->id }}" type="submit">店舗詳細</button>
        </form>

        @auth
        @if(!Auth::user()->is_favorite($restaurant->id))
        <form action="{{ route('favorite', ['restaurant_id' => $restaurant->id]) }}" method="post">
          @csrf
          <button type="submit" class="favorite__btn">
            <img src="{{ asset('images/heart-gray.png') }}" alt="">
          </button>
        </form>
        @else
        <form action="{{ route('favorite.delete', ['restaurant_id' => $restaurant->id]) }}" method="post">
          @csrf
          <button type="submit" class="favorite__btn">
            <img src="{{ asset('images/heart-red.png') }}" alt="">
          </button>
        </form>
        @endif
        @endauth
      </div>
    </div>
  </div>
@endforeach
</main>
@endsection