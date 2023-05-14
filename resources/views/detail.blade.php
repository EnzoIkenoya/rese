@extends('layouts.default')

@section('title')
Rese
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endpush

@section('content')
<main class="detail__main">
  <div class="detail__store">
    <div class="detail__store-name">
      <div>
        <a href="/" class="back__btn">&lt;</a>
        <h2>{{ $restaurant->name }}</h2>
      </div>
      @auth
      @if(!Auth::user()->is_favorite($restaurant->id))
      <form action="{{ route('favorite', ['restaurant_id'=>$restaurant->id ]) }}" method="post">
        @csrf
        <button type="submit" class="favorite__btn">
          <img src="{{ asset('images/heart-border.png') }}" alt="">
        </button>
      </form>
      @else
      <form action="{{ route('favorite.delete', ['restaurant_id' => $restaurant->id]) }}" method="post">
        @csrf
        <button class="favorite__btn">
          <img src="{{ asset('images/heart-red.png') }}" alt="">
        </button>
      </form>
      @endif
      @endauth
    </div>
    <img src="{{ $restaurant->image }}" alt=""  >
    <div class="detail__store-item">
      <p class="detail__store-area">{{ $restaurant->getArea() }}</p>
      <p class="detail__store-genre">{{ $restaurant->getGenre() }}</p>
    </div>
    <p class="detail__store-info">{{ $restaurant->infomation }}</p>
  </div>
  
  @auth
  <div class="detail__reserve">
    <form action="{{ route('reserve', ['restaurant_id' => $restaurant->id ]) }}" method="post">
      @csrf
      <div class="detail__reserve-wrap">
        <p class="reserve__title">予約</p>

        <input type="date" class="reserve__date" name="date">
        @if ($errors->has('date'))
        <p class="validation__error-red">Error:{{$errors->first('date')}}</p>
        @endif
        @if (session()->has('message'))
        <p class="validation__error-red">{{session('message')}}</p>
        @endif

        <select name="start_at">
          <option value="17:00">17:00</option>
          <option value="17:30">17:30</option>
          <option value="18:00">18:00</option>
          <option value="18:30">18:30</option>
          <option value="19:00">19:00</option>
          <option value="19:30">19:30</option>
          <option value="20:00">20:00</option>
          <option value="20:30">20:30</option>
          <option value="21:00">21:00</option>
        </select>
        @if ($errors->has('start_at'))
        <p class="validation__error-red">Error:{{$errors->first('start_at')}}</p>
        @endif

        <select name="number">
          <option value="1">1人</option>
          <option value="2">2人</option>
          <option value="3">3人</option>
          <option value="4">4人</option>
          <option value="5">5人</option>
          <option value="6">6人</option>
          <option value="7">7人</option>
          <option value="8">8人</option>
        </select>
        @if ($errors->has('number'))
        <p class="validation__error-red">Error:{{$errors->first('number')}}</p>
        @endif

        <div class="overflow-scroll">
          @if(Auth::user()->is_reserve($restaurant->id))
          @foreach($reserves as $reserve)
          <div class="detail__reserve-card">
            <table>
              <tr>
                <th>Shop</th>
                <td>{{ $reserve->getRestaurantname() }}</td>
              </tr>
              <tr>
                <th>Date</th>
                <td>{{ \Carbon\Carbon::createFromTimeString($reserve->start_at)->format('Y-m-d') }}</td>
              </tr>
              <tr>
                <th>Time</th>
                <td>{{ \Carbon\Carbon::createFromTimeString($reserve->start_at)->format('H:i') }}</td>
              </tr>
              <tr>
                <th>Number</th>
                <td>{{ $reserve->number }}人</td>
              </tr>
            </table>
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <button class="reserve__submit" type="submit" name="restaurant_id" value="{{ $restaurant->id }}">予約する</button>
    </form>
  </div>
  @endauth
</main>

{{-- レビュー --}}
<div class="detail__store-comment">
  <h2 class="detail__store-comment">レビュー</h2>

  {{-- 評価機能の表示の有無の判定 --}}
  @if ($restaurant->is_reserve($restaurant->id, $user_id) != null && !$restaurant->is_userComment($restaurant->id, $user_id))
  <div class="store-comment__wrap">
    <form action=" {{ route('comment', ['restaurant_id'=> $restaurant->id ])}}" method="post">
      @csrf
      <div class="store-comment__star">
        <input id="star5" type="radio" name="star" value="5">
        <label for="star5">★</label>
        <input id="star4" type="radio" name="star" value="4">
        <label for="star4">★</label>
        <input id="star3" type="radio" name="star" value="3">
        <label for="star3">★</label>
        <input id="star2" type="radio" name="star" value="2">
        <label for="star2">★</label>
        <input id="star1" type="radio" name="star" value="1">
        <label for="star1">★</label>
      </div>
      @if ($errors->has('star'))
      <p class="validation__error-red">Error:{{$errors->first('star')}}</p>
      @endif
      <textarea class="store-comment__comment" name="comment" rows="3"></textarea>
      @if ($errors->has('review'))
      <p class="validation__error-red">Error:{{$errors->first('review')}}</p>
      @endif
      <button type="submit">投稿する</button>
    </form>
  </div>
  @endif

  {{-- レビューの有無の判定 --}}
  @if($restaurant->is_reviews($restaurant->id) != null)
  @foreach($comments as $comment)
  <div class="detail__comment-item">
    <div class="detail__comment-wrap">
      <div class="detail__comment-star">
        @for($i = 1; $i < 6; $i++) @if($i <=$comment->star)
          <span class="detail__comment-star--yellow">★</span>
          @else
          <span class="detail__comment-star--gray">★</span>
          @endif
          @endfor
      </div>
      <p class="detail__comment-date">{{ \Carbon\Carbon::createFromTimeString($comment->created_at)->format('Y-m-d')
        }}</p>
    </div>
    <p class="detail__comment-name">{{ $comment->getUsername() }}</p>
    <p class="detail__comment-comment">{{ $comment->comment }}</p>
  </div>
  @endforeach
  @else
  <p>まだレビューはありません</p>
  @endif
@endsection