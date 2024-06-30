@extends('layouts.main2')

@section('content')


<div class="form-container">
  <div class="form-header">
    <h1 class="h2">Melakukan Perbandingan Kriteria</h1>
  </div>

  <div class="d-lg-flex justify-content-end gap-2 mb-4">
    <a href="/dashboard/kriteriaPerbandingan" class="btn btn-secondary">
      <span data-feather="arrow-left"></span>
      Kembali Ke perbandingan
    </a>
    @if ($isDoneCounting)
    <a href="/dashboard/kriteriaPerbandingan/result/{{ $criteria_analysis->id }}" class="btn btn-secondary">
      <span data-feather="clipboard"></span>
      Hasil Perbandingan
    </a>
    @endif
  </div>

  @if (count($details))
  <form action="/dashboard/kriteriaPerbandingan/{{ $details[0]->criteria_analysis_id }}" method="POST">
    @method('put')
    @csrf
    <input type="hidden" name="id" value="{{ $details[0]->criteria_analysis_id }}">

    <table class="tablePer">
      <thead>
        <tr>
          <th scope="col" class="clrT">Kriteria Pertama</th>
          <th scope="col" class="clrT">Nilai</th>
          <th scope="col" class="clrT">Kriteria Kedua</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($details as $detail)
        <tr>
          <input type="hidden" name="criteria_analysis_detail_id[]" value="{{ $detail->id }}">
          <td class="clrT">
            {{ $detail->firstCriteria->name }}
          </td>
          <td class="clrT">
            <select class="form-select" name="comparison_values[]" required>
              <option value="" disabled selected>--Pilih Salah Satu--</option>
              <option value="1" {{ $detail->comparison_value == 1 ? 'selected' : '' }}>1 - Sama Penting</option>
              <option value="2" {{ $detail->comparison_value == 2 ? 'selected' : '' }}>2 - Sama Penting / Sedikit Lebih Penting</option>
              <option value="3" {{ $detail->comparison_value == 3 ? 'selected' : '' }}>3 - Sedikit Lebih Penting</option>
              <option value="4" {{ $detail->comparison_value == 4 ? 'selected' : '' }}>4 - Sama Penting / Jelas Lebih Penting</option>
              <option value="5" {{ $detail->comparison_value == 5 ? 'selected' : '' }}>5 - Jelas Lebih Penting</option>
              <option value="6" {{ $detail->comparison_value == 6 ? 'selected' : '' }}>6 - Jelas Lebih Penting / Sangat Jelas Penting</option>
              <option value="7" {{ $detail->comparison_value == 7 ? 'selected' : '' }}>7 - Sangat Jelas Penting</option>
              <option value="8" {{ $detail->comparison_value == 8 ? 'selected' : '' }}>8 - Sangat Jelas Penting / Mutlak Lebih Penting</option>
              <option value="9" {{ $detail->comparison_value == 9 ? 'selected' : '' }}>9 - Mutlak Lebih Penting</option>
            </select>
          </td>
          <td class="clrT">
            {{ $detail->secondCriteria->name }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
    @can('update', $criteria_analysis)
    <div class="d-flex justify-content-end mt-3">
      <button type="submit" class="btn btnBaru mb-3">Simpan</button>
    </div>
    @endcan
  </form>
  @endif
</div>
@endsection