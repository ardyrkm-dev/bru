@extends('layouts.main2')

@section('content')
  <style>
    .badge:hover {
      color: #fff !important;
      text-decoration: none;
    }

    .bg-success:hover {
      background: #2f9164 !important;
    }

    .bg-danger:hover {
      background: #e84a59 !important;
    }
  </style>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Final Rank</h1>
  </div>

  <div class="table-responsive col-lg-10">

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center clrT">No</th>
          <th scope="col" class="text-center clrT">Created By</th>
          <th scope="col" class="text-center clrT">Created At</th>
          <th scope="col" class="text-center clrT">Action</th>
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
                <td class="text-center clrT">
                  <a href="/dashboard/final-ranking/{{ $analysis->id }}" class="badge bg-success text-decoration-none">
                   Lihat Rank
                  </a>
                </td>
              @else
                <td class="text-center">
                  <span role="button" class="badge bg-danger text-decoration-none">
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
