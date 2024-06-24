@extends('layouts.guest')

@section('title', 'Home')

@section('content')
<div class="h-auto w-auto container p-6 ">
    <div>
        <div class="aH">
            <h1>Aktifitas List</h1>
        </div>
        <div class="bagianH">
            <h1>Memberikan terbaik untuk<br> olahraga yang anda mau</h1>
        </div>
        <div class="bagianCard">
            @foreach ($aktifitas as $item)
            <div class="cardA">
                
                <div class="imgC">
                    <img src="{{asset('fotoAktifitas/' .$item->gambar)}}" alt="">
                    <a href="{{route('detailAktifitas', $item->id)}}">
                    <div class="btnImg">
                       <h1>Lihat</h1>
                    </div></a>
                </div>
                <div class="textC">
                    <div class="flex justify-between">
                        <h1>{{$item->name}}</h1>
                        <div class="flex a">
                            <img style="width: 20px; height:20px; margin-right:4px;" src="{{asset('assets/fire.png')}}" alt="">
                            <p>{{$item->kalori}}Kalori</p>
                        </div>
                    </div>
                    <p class="m">{{$item->durasi}} Menit</p>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>


</div>


@endsection