<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriteriaComparison\UpdateValueRequest;
use App\Models\Alternatif;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\CriteriaAnalysis;
use App\Models\CriteriaAnalysisDetail;
use App\Models\PreventiveValue;
use Illuminate\Http\Request;


class coba1 extends Controller
{
    public function index()
    {
        if (auth()->user()->level === 'USER') {
            $comparisons = CriteriaAnalysis::where('user_id', auth()->user()->id)
                ->with('user')
                ->get();
        }

        if (auth()->user()->level === 'SUPERADMIN' || auth()->user()->level === 'ADMIN') {
            $comparisons = CriteriaAnalysis::with('user')->get();
        }

        return view('pages.dashboard.kriteriaPerbandingan.index1', [
            'title'       => 'Kriteria Perbandingan',
            'comparisons' => $comparisons,
            'criterias'   => Criteria::all(),
        ]);
    }
    public function showCriteriaInput()
    {
        $userId = auth()->user()->id;
        $criteriaAnalysis = CriteriaAnalysis::where('user_id', $userId)->first();

        if (!$criteriaAnalysis) {
            $criteriaAnalysis = $this->generateCriteriaComparisons();
        }

        $criteriaAnalysis->load('details', 'details.firstCriteria', 'details.secondCriteria');

        $details = filterDetailResults($criteriaAnalysis->details);
        $isDoneCounting = PreventiveValue::where('criteria_analysis_id', $criteriaAnalysis->id)->exists();

        $criteriaAnalysis->unsetRelation('details');

        return view('pages.dashboard.kriteriaPerbandingan.masukanP', [
            'title' => 'Input Criteria Comparison',
            'criteria_analysis' => $criteriaAnalysis,
            'details' => $details,
            'isDoneCounting' => $isDoneCounting,
        ]);
    }
    public function store(Request $request)
    {
        $criterias = Criteria::all();

        if ($criterias->isEmpty()) {
            return redirect('/dashboard/kriteriaPerbandingan1')
                ->with('failed', 'No criteria found!');
        }

        // data for criteria analyses table
        $analysisData = [
            'user_id' => auth()->user()->id
        ];

        $analysis = CriteriaAnalysis::create($analysisData);
        $analysisId = $analysis->id;
        $comparisonIds = [];

        foreach ($criterias as $i => $criteria) {
            // first data
            if ($i == 0) {
                $next = 0;
                foreach ($criterias as $firstIndex => $firstCriteria) {
                    $data = [
                        'criteria_id_first'  => $criteria->id,
                        'criteria_id_second' => $firstCriteria->id
                    ];

                    array_push($comparisonIds, $data);
                    $next++;
                }
            } else { // the rest of the data
                // reverse loop
                $current = $i;
                for ($j = 0; $j < $current; $j++) {
                    $data = [
                        'criteria_id_first'  => $criteria->id,
                        'criteria_id_second' => $criterias[$j]->id,
                    ];

                    array_push($comparisonIds, $data);
                }

                // forward loop
                $next = $i;
                foreach ($criterias as $firstIndex => $firstCriteria) {
                    if ($firstIndex < $i) continue;
                    $data = [
                        'criteria_id_first'  => $criteria->id,
                        'criteria_id_second' => $firstCriteria->id
                    ];

                    array_push($comparisonIds, $data);
                    $next++;
                }
            }
        }

        // save data to criteria analysis details table
        foreach ($comparisonIds as $comparison) {
            $detail = [
                'criteria_analysis_id' => $analysisId,
                'criteria_id_first'    => $comparison['criteria_id_first'],
                'criteria_id_second'   => $comparison['criteria_id_second'],
                'comparison_value'     => 1
            ];

            CriteriaAnalysisDetail::create($detail);
        }

        return redirect('/dashboard/kriteriaPerbandingan/' . $analysisId)
            ->with('success', 'The chosen criteria has been added!');
    }

    public function show(CriteriaAnalysis $criteriaAnalysis)
    {
        $this->authorize('view', $criteriaAnalysis);

        $criteriaAnalysis->load('details', 'details.firstCriteria', 'details.secondCriteria');

        $details        = filterDetailResults($criteriaAnalysis->details);
        $isDoneCounting = PreventiveValue::where('criteria_analysis_id', $criteriaAnalysis->id)
            ->exists();

        $criteriaAnalysis->unsetRelation('details');

        return view('pages.dashboard.kriteriaPerbandingan.masukanP', [
            'title'             => 'Perbandingan Kriteria',
            'criteria_analysis' => $criteriaAnalysis,
            'details'           => $details,
            'isDoneCounting'    => $isDoneCounting,
        ]);
    }

    public function updateValue(UpdateValueRequest $request, CriteriaAnalysis $criteriaAnalysis)
    {
        $this->authorize('update', $criteriaAnalysis);

        $validate = $request->validated();

        foreach ($validate['criteria_analysis_detail_id'] as $key => $id) {
            CriteriaAnalysisDetail::where('id', $id)
                ->update([
                    'comparison_value'  => $validate['comparison_values'][$key],
                    'comparison_result' => $validate['comparison_values'][$key],
                ]);
        }

        $this->_countRestDetails($validate['id'], $validate['criteria_analysis_detail_id']);
        $this->_countPreventiveValue($validate['id']);


        return redirect()
            ->back()
            ->with('success', 'The comparison values has been updated!');
    }

    private function _countRestDetails($criteriaAnalysisId, $detailIds)
    {
        $restDetails = CriteriaAnalysisDetail::where('criteria_analysis_id', $criteriaAnalysisId)
            ->whereNotIn('id', $detailIds)
            ->get();


        if ($restDetails->count()) {
            $restDetails->each(function ($value, $key) use ($criteriaAnalysisId) {
                $prevComparison = CriteriaAnalysisDetail::where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_first'    => $value->criteria_id_second,
                    'criteria_id_second'   => $value->criteria_id_first,
                ])->first();

                $comparisonResult = 1 / $prevComparison['comparison_value'];

                CriteriaAnalysisDetail::where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_first'    => $value->criteria_id_first,
                    'criteria_id_second'   => $value->criteria_id_second,
                ])
                    ->update(['comparison_result' => $comparisonResult]);
            });
        }
    }

    private function _countPreventiveValue($criteriaAnalysisId)
    {
        $criterias = CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysisId);

        foreach ($criterias as $criteria) {

            $dataDetails = CriteriaAnalysisDetail::select('criteria_id_second', 'comparison_result')
                ->where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_first'    => $criteria->id
                ])
                ->get();

            // temporary preventive value
            $tempValue = 0;


            foreach ($dataDetails as $detail) {


                $totalPerCriteria = CriteriaAnalysisDetail::where([
                    'criteria_analysis_id' => $criteriaAnalysisId,
                    'criteria_id_second'   => $detail->criteria_id_second
                ])
                    ->sum('comparison_result');


                $res = substr($detail->comparison_result / $totalPerCriteria, 0, 11);

                $tempValue += $res;
            }


            $FinalPrevValue = $tempValue / $criterias->count();

            $data = [
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
                'value'                => floatval($FinalPrevValue)
            ];


            PreventiveValue::updateOrCreate([
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id'          => $criteria->id,
            ], $data);
        }
    }

    public function result(CriteriaAnalysis $criteriaAnalysis)
    {
        $this->authorize('view', $criteriaAnalysis);

        $criteriaAnalysis->load('details', 'details.firstCriteria', 'details.secondCriteria', 'preventiveValues', 'preventiveValues.criteria');

        $totalPerCriteria =  $this->_getTotalSumPerCriteria($criteriaAnalysis->id, CriteriaAnalysisDetail::getSelectedCriterias($criteriaAnalysis->id));

        $ruleRI = [
            1  => 0.0,
            2  => 0.0,
            3  => 0.58,
            4  => 0.90,
            5  => 1.12,
            6  => 1.24,
            7  => 1.32,
            8  => 1.41,
            9  => 1.45,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59,
        ];

        $availableCriterias = Criteria::all()->pluck('id');
        $isAnyAlternative   = Alternatif::checkAlternativeByCriterias($availableCriterias);
        $isAbleToRank       = false;

        if ($isAnyAlternative) {
            $isAbleToRank = true;
        }

        return view('pages.dashboard.kriteriaPerbandingan.result', [
            'title'             => 'gg',
            'criteria_analysis' => $criteriaAnalysis,
            'totalSums'         => $totalPerCriteria,
            'ruleRI'            => $ruleRI,
            'isAbleToRank'      => $isAbleToRank,
        ]);
    }

    private function _getTotalSumPerCriteria($criteriaAnalysisId, $criterias)
    {
        $result = [];

        foreach ($criterias as $criteria) {
            $totalPerCriteria = CriteriaAnalysisDetail::where([
                'criteria_analysis_id' => $criteriaAnalysisId,
                'criteria_id_second'   => $criteria->id
            ])
                ->sum('comparison_result');

            $data = [
                'name'     => $criteria->name,
                'totalSum' => floatval($totalPerCriteria)
            ];

            array_push($result, $data);
        }

        return $result;
    }

    public function destroy(CriteriaAnalysis $criteriaAnalysis)
    {
        $this->authorize('delete', $criteriaAnalysis);

        CriteriaAnalysis::destroy($criteriaAnalysis->id);

        return redirect('/dashboard/kriteriaPerbandingan')
            ->with('success', 'Telah Berhasil');
    }
}
