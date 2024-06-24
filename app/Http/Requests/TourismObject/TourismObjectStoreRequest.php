<?php

namespace App\Http\Requests\TourismObject;

use Illuminate\Foundation\Http\FormRequest;

class TourismObjectStoreRequest extends FormRequest
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

      'name'    => 'required|unique:aktifitas|max:255',
      'deskripsi' => 'required|unique:aktifitas|max:255',
      'gambar' => 'required|unique:aktifitas|max:255',
      'durasi' => 'required|unique:aktifitas|max:255',
      'kalori' => 'required|unique:aktifitas|max:255'
    ];
  }
}
