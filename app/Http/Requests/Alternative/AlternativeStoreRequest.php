<?php

namespace App\Http\Requests\Alternative;

use Illuminate\Foundation\Http\FormRequest;

class AlternativeStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'aktifitas_object_id' => 'required|exists:aktifitas,id',
      'criteria_id'       => 'required|array',
      'alternative_value' => 'required|array'
    ];
  }
}
