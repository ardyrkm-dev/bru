@extends('layouts.main2')

@section('content')
  <div class="h-auto p-6">
    <h1 class="txtDash">Dashboard</h1>
    <div class="bagianPropil">
      <div class="imgPropil">
        <img src="{{asset('assets/il2.jpg')}}" style="object-fit: cover;width:100%; height:100%;" alt="">
      </div>
      <div class="bagianIdentitasP">
        <h1>{{Auth::user()->name;}}</h1>
        <h1>{{Auth::user()->email;}}</h1>
      </div>
    </div>
  </div>
@endsection
