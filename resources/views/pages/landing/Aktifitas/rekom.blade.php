<!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
    <head>
    @include('includes.landing.meta')
    <title>Rekomendasi | FitSolusi</title>
    
        @stack('before-style')
        @include('includes.landing.style')
        @stack('after-style')
    </head>
    <body class="h-auto w-auto flex items-center ">
        <div class="flex-1">
            <img src="{{asset('assets/lelah.svg')}}"   alt="">
        </div>
        <div class="flex-1 w-auto text-center justify-items-center items-center flex flex-col">
            <h1 class="font-semibold text-2xl">
            Form Rekomendasi    
            </h1>
            <p class="mb-2">Diisi dahulu ya</p>

            <form action="" class="w-form">
                <div class="flex mb-4 justify-between">
                    <input style="" class="input-small mr-1" type="text" value="Berat badan">
                    <input style="" class="input-small" type="text" value="Tinggi badan">
                </div>
                <div class="flex mb-4 justify-between">
                    <input style="" class="input-small mr-1" type="text" value="Umur">
                    <input style="" class="input-small" type="text" value="Jenis Kelamin">
                </div>
                <input style="" class="input-big mb-4" type="text" value="Tujuan Olahraga">
                <input style="" class="input-big mb-4" type="text" value="Waktu Tersedia">
                <input style="" class="input-big mb-4" type="text" value="Kondisi">
                <input style="" class="input-big mb-4" type="text" value="Jenis Kelamin">

                <button class="bg-sekunder btn-new1 mt-3 txt-sekunder font-semibold">
                    Selanjutnya
                    </button>
            </form>
        </div>
    </body>

</html>