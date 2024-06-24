@extends('layouts.guest')

@section('title', 'Home')

@section('content')

<div class="h-full widh-b">
    <div class="mb-4">
        <h1 class="text-center text-3xl txt-sekunder mb-4 mt-4 font-semibold">Profil</h1>
        <div class="flex justify-between items-start">
            <div class="flex">
                <div class="img-profil">
                    <img src="{{asset('assets/lelah.svg')}}" class="object-cover" alt="">
                </div>
                <div class="ml-4">
                    <h1 class="text-1xl font-bold mb-1 txt-sekunder">Arda Yudrik Malana</h1>
                    <h1 class="text-base font-medium txt-sekunder">Arda@gmail.com</h1>
                    <h1 class="text-base font-light  txt-sekunder">08782131314</h1>
                </div>
            </div>
            <button class="text-1xl font-bold mb-1 txt-sekunder">Edit Profil</button>
        </div>
    </div>
    <div class="margin-baru">
        <h1 class="text-center text-3xl txt-sekunder mb-4 mt-4 font-semibold">Riwayat</h1>
        <div class="flex">
            <div class="card-riwayat">
                <div class="rounded-l overflow-hidden img-cr">
                    <img src="{{asset('assets/lelah.svg')}}" alt="" class="w-full h-full object-cover" srcset="">
                </div>
                <div class="s-text">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-sm txt-sekunder font-semibold">Tanggal</h1>
                            <h1 class="text-sm txt-sekunder font-semibold">Full body Workout</h1>
                            <h1 class="text-sm txt-sekunder font-semibold">120 Menit</h1>
                        </div>
                        <h1 class="text-sm txt-sekunder font-semibold">Kalori</h1>
                    </div>
                    <button class="btn-small w-full bg-sekunder">Lihat
                    </button>
                </div>
            </div>
            <div class="card-riwayat">
                <div class="rounded-l overflow-hidden img-cr">
                    <img src="{{asset('assets/lelah.svg')}}" alt="" class="w-full h-full object-cover" srcset="">
                </div>
                <div class="s-text">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-sm txt-sekunder font-semibold">Tanggal</h1>
                            <h1 class="text-sm txt-sekunder font-semibold">Full body Workout</h1>
                            <h1 class="text-sm txt-sekunder font-semibold">120 Menit</h1>
                        </div>
                        <h1 class="text-sm txt-sekunder font-semibold">Kalori</h1>
                    </div>
                    <button class="btn-small w-full bg-sekunder">Lihat
                    </button>
                </div>
            </div>
            <div class="card-riwayat">
                <div class="rounded-l overflow-hidden img-cr">
                    <img src="{{asset('assets/lelah.svg')}}" alt="" class="w-full h-full object-cover" srcset="">
                </div>
                <div class="s-text">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-sm txt-sekunder font-semibold">Tanggal</h1>
                            <h1 class="text-sm txt-sekunder font-semibold">Full body Workout</h1>
                            <h1 class="text-sm txt-sekunder font-semibold">120 Menit</h1>
                        </div>
                        <h1 class="text-sm txt-sekunder font-semibold">Kalori</h1>
                    </div>
                    <button class="btn-small w-full bg-sekunder">Lihat
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection