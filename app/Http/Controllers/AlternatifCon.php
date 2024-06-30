<?php

namespace App\Http\Controllers;

use App\Http\Requests\Alternative\AlternativeStoreRequest;
use App\Http\Requests\Alternative\AlternativeUpdateRequest;
use App\Models\Aktifita;
use App\Models\AktifitasModel;
use App\Models\Alternatif;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\TourismObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AlternatifCon extends Controller
{
  public function index()
  {
    $this->authorize('admin');

    $usedIds    = Alternatif::select('aktifitas_object_id')->distinct()->get();
    $usedIdsFix = [];

    foreach ($usedIds as $usedId) {
      array_push($usedIdsFix, $usedId->aktifitas_object_id);
    }

    $alternatives = Aktifita::whereIn('id', $usedIdsFix)
      ->with('alternatives')
      ->get();

    $aktifitas = Aktifita::whereNotIn('id', $usedIdsFix)->get();

    return view('pages.dashboard.alternative.index', [
      'title'           => 'Alternative',
      'alternatives'    => $alternatives,
      'criterias'       => Criteria::all(),
      'aktifitas_object' => $aktifitas
    ]);
  }

  public function store(AlternativeStoreRequest $request)
  {
    $validate = $request->validated();

    foreach ($validate['criteria_id'] as $key => $criteriaId) {
      $data = [
        'aktifitas_object_id' => $validate['aktifitas_object_id'],
        'criteria_id'       => $criteriaId,
        'alternative_value' => $validate['alternative_value'][$key],
      ];

      Alternatif::create($data);
    }

    return redirect('/dashboard/alternatives')
      ->with('success', 'The New Alternative has been added!');
  }

  public function edit(Alternatif $alternative)
  {
    $this->authorize('admin');

    // check if there is any new criteria which the user haven't filled the value
    $selectedCriteria = Alternatif::where('aktifitas_object_id', $alternative->aktifitas_object_id)->pluck('criteria_id');
    $newCriterias     = Criteria::whereNotIn('id', $selectedCriteria)->get();

    $alternative      = Aktifita::where('id', $alternative->tourism_object_id)
      ->with('alternatives', 'alternatives.criteria')->first();

    return view('pages.dashboard.alternative.edit', [
      'title'        => "Edit $alternative->name's Values",
      'alternative'  => $alternative,
      'newCriterias' => $newCriterias
    ]);
  }

  public function update(AlternativeUpdateRequest $request, Alternatif $alternative)
  {
    $this->authorize('admin');

    $validate = $request->validated();

    // insert new alternative values if the new criteria exists
    if ($validate['new_aktifitas_object_id'] ?? false) {
      foreach ($validate['new_criteria_id'] as $key => $newCriteriaId) {
        $data = [
          'aktifitas_object_id' => $validate['new_aktifitas_object_id'],
          'criteria_id'       => $newCriteriaId,
          'alternative_value' => $validate['new_alternative_value'][$key],
        ];

        Alternatif::create($data);
      }
    }

    foreach ($validate['criteria_id'] as $key => $criteriaId) {
      $data = [
        'criteria_id'       => $criteriaId,
        'alternative_value' => $validate['alternative_value'][$key],
      ];

      Alternatif::where('id', $validate['alternative_id'][$key])
        ->update($data);
    }

    return redirect('/dashboard/alternatives')
      ->with('success', 'The selected alternative has been updated!');
  }

  public function destroy(Alternatif $alternative)
  {
    $this->authorize('admin');

    Alternatif::where('aktifitas_object_id', $alternative->aktifitas_object_id)
      ->delete();

    return redirect('/dashboard/alternatives')
      ->with('success', 'The selected alternative has been deleted!');
  }
}
