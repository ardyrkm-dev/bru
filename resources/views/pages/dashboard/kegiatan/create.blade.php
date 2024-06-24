@extends('layouts.main2')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Buat Baru Aktifitas</h1>
</div>

<form class="col-lg-8" method="POST" action="/dashboard/aktifitas" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control formcss @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" autofocus required>

    @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="deskripsi" class="form-label">Masukan Deskripsi</label>
    <input type="text" class="form-control formcss @error('name') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" autofocus required>

    @error('deskripsi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="gambar" class="form-label">Masukan Gambar</label>
    <input type="file" class="form-control formcss @error('gambar') is-invalid @enderror" id="gambar" name="gambar" value="{{ old('gambar') }}" required>

    @error('gambar')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="manfaat" class="form-label">Masukan Manfaat</label>
    <input type="text" class="form-control formcss @error('manfaat') is-invalid @enderror" id="manfaat" name="manfaat" value="{{ old('manfaat') }}" autofocus required>

    @error('manfaat')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="kalori" class="form-label">Masukan Kalori</label>
    <input type="number" class="form-control formcss @error('kalori') is-invalid @enderror" id="kalori" name="kalori" value="{{ old('kalori') }}" autofocus required>

    @error('kalori')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>


  <button type="submit" class="btn btnBaru mb-3">Save</button>
  <a href="/dashboard/tourism-objects" class="btn btn-danger mb-3">Cancel</a>
</form>
@endsection
