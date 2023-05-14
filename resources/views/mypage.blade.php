@extends('layouts.default')

@section('title')
マイページ
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endpush

@section('content')
<main class="mypage__main">
  <p class="mypage__user-name">{{ $user->name }}さん</p>

  <div class="mypage__reserve">
    <h2>予約状況</h2>
    @foreach( $reserves as $key => $reserve)
    <div class="mypage__reserve-card">
      <div class="reserve-card__title">
        <p>予約&nbsp;{{ $key+1 }}</p>
        <form action="{{ route('reserve.delete', ['reserve_id' =>$reserve->id]) }}" method="post">
          @csrf
          <button type="submit" onclick='returnconfirm("予約を取り消しますか？")'><img src="{{ asset('images/batu.png') }}" alt=""></button>
        </form>
      </div>
      <form action="{{ route('reserve.update',['reserve_id' => $reserve->id]) }}" method="post">
        @csrf
        <table>
          <tr>
            <th>Shop</th>
            <td>{{ $reserve->getRestaurantname() }}</td>
          </tr>
          <tr>
            <th>Date</th>
            <td>{{ \Carbon\Carbon::createFromTimeString($reserve->start_at)->format('Y-m-d') }}</td>
            <td class="reserve-date" id="reserve-date__change">→&nbsp;
              <input type="date" class="reserve__date" name="date" value="{{ \Carbon\Carbon::createFromTimeString($reserve->start_at)->format('Y-m-d') }}">
            </td>
          </tr>
          <tr>
            <th>Time</th>
            <td id="reserve-time">{{ \Carbon\Carbon::createFromTimeString( $reserve->start_at)->format('H:i') }}</td>
            <td>→&nbsp;
              <select name="start_at">
                <option value="{{ \Carbon\Carbon::createFromTimeString($reserve->start_at)->format('H:i') }}" selected>
                  {{ \Carbon\Carbon::createFromTimeString($reserve->start_at)->format('H:i') }}
                </option>
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
            </td>
          </tr>
          <tr>
            <th>Number</th>
            <td>{{ $reserve->number }}</td>
            <td>→&nbsp;
              <select name="number">
                <option value="{{ $reserve->number }}">{{ $reserve->number }}</option>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
                <option value="5">5人</option>
                <option value="6">6人</option>
                <option value="7">7人</option>
                <option value="8">8人</option>
              </select>
            </td>
          </tr>
        </table>
        <div class="reserve-card__change" id="reserve-card__change">
          <button type="submit" onclick='return confirm("予約を変更しますか？")'>予約内容を変更</button>
        </div>
      </form>
    </div>
    @endforeach
  </div>

  <div class="mypage__favorite">
    <h2>お気に入り店舗</h2>
    @foreach($restaurants as $restaurant)
    <div class="restaurant__card">
      <div class="restaurant__card-img">
        <img src="{{ $restaurant->image }}" alt="">
      </div>
      <div class="restaurant__card-content">
        <h3 class="card-content__name">{{ $restaurant->name }}</h3>
        <p class="card-content__area">{{ $restaurant->getArea() }}</p>
        <p class="card-content__genre">{{ $restaurant->getGenre() }}</p>
        <div class="card-content__item">
          <form action="/detail/" method="get">
            <button class="to-detail__button" name="restaurant_id" value="{{ $restaurant->id }}" type="submit">詳しく見る</button>
          </form>

          <form action="{{ route('favorite.delete', ['restaurant_id' => $restaurant->id]) }}"  method="post" onclick='return confirm("お気に入りを削除しますか？")'>
          @csrf
          <button type="submit" class="favorite__btn">
          <img src="{{ asset('images/heart-red.png') }}" alt="">
          </button>
          </form>

        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="mypage__pastreserve">
    @if($pastreserves != [0])
    <h2>予約履歴</h2>
    <table>
      @foreach($pastreserves as $pastreserve)
      <tr>
        <td>{{ \Carbon\Carbon::createFromTimeString($pastreserve->start_at)->format('Y-m-d') }}</td>
        <td>{{ $pastreserve->getStorename() }}</td>
        <td class="pastreserve-button">
          <form action="/detail/" method="get">
            <button class="to-detail__button" name="store_id" value="{{ $pastreserve->store_id }}"
              type="submit">店舗詳細</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    @endif
    
  </div>
</main>
@endsection