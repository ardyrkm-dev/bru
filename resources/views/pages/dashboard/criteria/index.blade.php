@extends('layouts.main2')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kriteria</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <a href="/dashboard/criterias/create" class="btn btnBaru mb-3">
    
      Buat
    </a>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center clrT">No</th>
          <th scope="col" class="text-center clrT">Name</th>
          <th scope="col" class="text-center clrT">Attribute</th>
          <th scope="col" class="text-center clrT">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($criterias->count())
          @foreach ($criterias as $criteria)
            <tr>
             
              <td class="text-center clrT">{{ $loop->iteration }}</td>
              <td class="text-center clrT">{{ $criteria->name }}</td>
              <td class="text-center clrT">{{ Str::ucfirst(Str::lower($criteria->attribute)) }}</td>
              <td class="text-center clrT">
                <a href="/dashboard/criterias/{{ $criteria->id }}/edit" class="btn btn-custom text-decoration-none">
                  Update
                </a>
                <form action="/dashboard/criterias/{{ $criteria->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf

                  <span role="button" class="btn btn-custom text-decoration-none" data-object="criteria">
                  Hapus
                  </span>
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
