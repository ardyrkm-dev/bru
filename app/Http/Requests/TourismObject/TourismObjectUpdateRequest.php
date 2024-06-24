<?php

namespace App\Http\Requests\TourismObject;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TourismObjectUpdateRequest extends FormRequest
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
    $id = $this->route('aktifitas');

    return [
      'name'    => 'required|max:255|unique:aktifitas,name,' . $id,
      'deskripsi' => 'required|max:255|unique:aktifitas,deskripsi,' . $id,
      'gambar' => 'required|max:255|unique:aktifitas,gambar,' . $id,
      'durasi' => 'required|max:255|unique:aktifitas,durasi,' . $id,
      'kalori' => 'required|max:255|unique:aktifitas,kalori,' . $id,

    ];
  }
}
