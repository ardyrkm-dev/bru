@extends('layouts.guest')

@section('title', 'Home')

@section('content')
<div class="h-auto">

    <div class="color-primary jumbroton  w-full flex content-center p-6 relative mb-20" >
    <div class="grow-0">
    <h1 class="txt-jumbroton text-white font-semibold">Ayo <span class="txt-primary">olahraga</span>,<br/> Agar selalu <span class="txt-primary">Sehat</span></h1>
    <p class="text-white text-xl">Kami membantu kamu dalam berolahraga yang baik</p>
    <a href="{{route('aktifitas')}}">
    <button class="bg-sekunder btn-new1 mt-3 txt-sekunder font-semibold">
        Ayo Jelajah
        </button>
    </a>

    </div>
    <div class="grow-1 flex  justify-end ">
    <img src="{{asset('assets/il_1.svg')}}" style="width: 400px; position: relative; top: -140px; z-index: 0; right: -290px; " alt="">
    <div class="il-jumbroton color-primary absolute ">
    <img src="{{asset('assets/run.png')}}" style="width: 800px; position: relative; top: 40px" alt="">
    </div>
    <img src="{{asset('assets/il_2.svg')}}" style="width: 60px; position: relative; top: 100px; right: 160px; z-index: 0;" alt="">
    </div>
    </div>
    <div class="h-20">

    </div>
    <div class=" p-6 mt-20 h-auto bagianBene">
    
    <div class="flex">
        <div class="imgBene">
        <img src="{{asset('assets/il1.jpg')}}" style="object-fit: cover; width:100%; height:100%;" alt="">
        </div>
        <div>
            <h1 class="ml-6"> Aktifitas Apa saja <br/> yang di dapatkan?</h1>
        <div class="flex w-full p-6 mt-20 h-auto items-center">
        
            <div class="cardBened">
                 <h2>Fitnes Training</h2>
                 <p>serangkaian aktivitas fisik yang dirancang untuk meningkatkan kebugaran tubuh</p>
            </div>
            <div class="cardBened">
             <h2>Stamina Training</h2>
             <p>latihan yang berfokus pada meningkatkan daya tahan fisik seseorang</p>
             </div>
             <div class="cardBened">
                 <h2>BodyBuilding Training</h2>
                 <p>latihan fisik yang berfokus pada pengembangan dan pembentukan otot tubuh</p>
             </div>
        </div>
        </div>
    </div>
   
    </div>
    <div class="bagianAbout">
         <div class="bagianAT">
            <h1>About</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae suscipit, accusantium dolore voluptas repellendus aperiam hic doloribus! Laborum eveniet minus delectus similique temporibus praesentium, nesciunt dolor, dolorem dolorum perferendis numquam!</p>
        </div>
        <div class="bagianImgA">
            <img src="{{asset('assets/il2.jpg')}}" style="object-fit: cover;width:100%; height:100%;" alt="">
        </div>
    </div>
</div>

@endsection