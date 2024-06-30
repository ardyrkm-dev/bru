@extends('layouts.main2')

@section('content')
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Final Rank</h1>
</div>

<div class="table-responsive col-lg-10">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col" class="text-center">No</th>
        <th scope="col" class="text-center">Created By</th>
        <th scope="col" class="text-center">Created At</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($criteria_analyses->count())
        @foreach ($criteria_analyses as $analysis)
          <tr>
            <td class="text-center clrT">{{ $loop->iteration }}</td>
            <td class="text-center clrT">{{ $analysis->user->name }}</td>
            <td class="text-center clrT">{{ $analysis->created_at->toFormattedDateString() }}</td>
            @if ($isAbleToRank)
              <td class="text-center">
                <a href="/dashboard/matrikAlternatif/{{ $analysis->id }}" class="btn btn-custom text-decoration-none">
                 Lihat Rank
                </a>
              </td>
            @else
              <td class="text-center">
                <span class="badge bg-danger text-decoration-none">
                  Tungg 
                </span>
              </td>
            @endif
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="4" class="text-danger text-center p-4">
            <h4>Tidak ada data perbandingan</h4>
          </td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
@endsection
