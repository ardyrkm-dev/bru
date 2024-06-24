@extends('layouts.main2')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Pengguna</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <a href="/dashboard/users/create" class="btn btnBaru mb-3">
      <span data-feather="plus"></span>
      Buat
    </a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center clrT">No</th>
          <th scope="col" class="text-center clrT">Name</th>
          <th scope="col" class="text-center clrT">Username</th>
          <th scope="col" class="text-center clrT">Level</th>
          <th scope="col" class="text-center clrT">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($users->count())
          @foreach ($users as $user)
            <tr>
              {{-- $loop->iteraion => nomor / urutan loop keberapa nya --}}
              <td class="text-center clrT">{{ $loop->iteration }}</td>
              <td class="text-center clrT">{{ $user->name }}</td>
              <td class="text-center clrT">{{ $user->username }}</td>
              <td class="text-center clrT">{{ $user->level }}</td>
              <td class="text-center clrT">
                <a href="/dashboard/users/{{ $user->id }}/edit" class="text-decoration-none text-success">
                  <span data-feather="edit"></span>
                </a>
                <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf

                  <span role="button" class="text-decoration-none text-danger btnDelete" data-object="user">
                    <span data-feather="x-circle"></span>
                  </span>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>Belum ada data Pengguna</h4>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
@endsection