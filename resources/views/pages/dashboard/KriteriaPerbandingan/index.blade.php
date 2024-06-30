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
    <h1 class="h2">Kriteria Perbandingan</h1>
  </div>

  <div class="table-responsive col-lg-10">
    <button type="button" class="btn btnBarubgt mb-3" id="selectAllAndSubmitBtn">
      Mulai Perhitungan
    </button>

    <table class="table table-striped table-hover">
      <thead >
        <tr>
          <th scope="col" class="text-center clrT">No</th>
          <th scope="col" class="text-center clrT">Dibuat</th>
          <th scope="col" class="text-center clrT">Created At</th>
          <th scope="col" class="text-center clrT">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($comparisons->count())
          @foreach ($comparisons as $comparison)
            <tr>
              <td class="text-center clrT">{{ $loop->iteration }}</td>
              <td class="text-center clrT">{{ $comparison->user->name }}</td>
              <td class="text-center clrT">{{ $comparison->created_at->format('d M Y') }}</td>
              <td class="text-center clrT">
                <a href="/dashboard/kriteriaPerbandingan/{{ $comparison->id }}" class="btn btn-custom text-decoration-none">
                  Lihat Hasil
                </a>
                <form action="/dashboard/kriteriaPerbandingan/{{ $comparison->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <span role="button" class="btn btn-custom text-decoration-none" data-object="Comparison Data">
                    Hapus
                  </span>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="4" class="text-danger text-center p-4">
              <h4>Kamu Belum Punya data Perbandingan</h4>
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>

  
  <div class="modal fade" id="modalChoose" tabindex="-1" aria-labelledby="modalChooseLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalChooseLabel">Choose Criteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="criteriaForm" action="/dashboard/kriteriaPerbandingan" method="POST">
          @csrf
          <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center" colspan="2">Name</th>
                  <th scope="col" class="text-center">Attribute</th>
                </tr>
              </thead>
              <tbody>
                @if ($criterias->count())
                  @foreach ($criterias as $criteria)
                    <tr>
                      <th scope="row" class="text-center">
                        <input type="checkbox" value="{{ $criteria->id }}" name="criteria_id[]">
                      </th>
                      <td class="text-center">{{ $criteria->name }}</td>
                      <td class="text-center">{{ Str::ucfirst(Str::lower($criteria->attribute)) }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td class="text-center text-danger" colspan="3">No criteria found</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
          
        </form>
      </div>
    </div>
  </div>


  <script>
    document.getElementById('selectAllAndSubmitBtn').addEventListener('click', function() {
    
      let checkboxes = document.querySelectorAll('#modalChoose input[type="checkbox"]');
      checkboxes.forEach(checkbox => {
        checkbox.checked = true;
      });

    
      document.getElementById('criteriaForm').submit();
    });
  </script>
@endsection
