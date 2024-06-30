@extends('layouts.main2')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Aktiftias</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <a href="{{route('aktifitas.form')}}" class="btn btnBaru mb-3">Buat</a>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col" class="text-center clrT">No</th>
          <th scope="col" class="text-center clrT">Gambar</th>
          <th scope="col" class="text-center clrT">Nama</th>
          <th scope="col" class="text-center clrT">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($aktifitas->count())
          @foreach ($aktifitas as $a)
            <tr>
              <td class="text-center clrT">{{ $loop->iteration }}</td>
              <td class="text-center clrT"><img style="width: 100px; height:100px;" src="{{asset('fotoAktifitas/' .$a->gambar)}}" alt=""></td>
              <td class="text-center clrT">{{ $a->name }}</td>
              <td class="text-center clrT">
                <a href="{{route('aktifitas.form.edit', $a->id)}}" class="btn btn-custom text-decoration-none">
               Update
                </a>
                <form action="{{route('aktifitas.delete', $a->id)}}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                <button type="submit" class="btn btn-custom text-decoration-none">
                  Hapus
                </button>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>Tidak ada kriteria yang tersedia</h4>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
@endsection
