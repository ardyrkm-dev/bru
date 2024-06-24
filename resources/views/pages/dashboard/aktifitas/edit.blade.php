@extends('layouts.main2')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $aktifitas->name }}</h1>
  </div>

  <form class="col-lg-8" method="POST" action="{{route('aktifitas.update', $aktifitas->id)}}"  enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control formcss @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name',$aktifitas->name)   }}" autofocus required>

      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Masukan Deskripsi</label>
      <input type="text" class="form-control formcss @error('name') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $aktifitas->deskripsi) }}" autofocus required>

      @error('deskripsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Masukan Gambar</label>
      <input type="file" class="form-control formcss @error('gambar') is-invalid @enderror" id="gambar" name="gambar" value="{{ old('gambar', $aktifitas->gambar) }}" required>

      @error('gambar')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="durasi" class="form-label">Masukan Durasi</label>
      <input type="number" class="form-control formcss @error('durasi') is-invalid @enderror" id="durasi" name="durasi" value="{{ old('durasi', $aktifitas->manfaat) }}" autofocus required>

      @error('durasi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="kalori" class="form-label">Masukan Kalori</label>
      <input type="number" class="form-control formcss @error('kalori') is-invalid @enderror" id="kalori" name="kalori" value="{{ old('kalori',$aktifitas->kalori) }}" autofocus required>

      @error('kalori')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <button type="submit" class="btn btnBaru mb-3">Save Changes</button>
    <a href="/dashboard/aktifitas" class="btn btn-danger mb-3">Cancel</a>
  </form>
@endsection
