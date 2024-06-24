<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourismObject\TourismObjectStoreRequest;
use App\Http\Requests\TourismObject\TourismObjectUpdateRequest;
use App\Models\Aktifita;
use App\Models\AktifitasModel;
use App\Models\TourismObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminAktifitasController extends Controller
{
  public function index()
  {

    $aktifitas = Aktifita::all();

    return view('pages.dashboard.aktifitas.home', [
      'title' => 'Aktifitas Objects',
      'aktifitas' => $aktifitas
    ]);
  }

  public function create()
  {


    return view('pages.dashboard.aktifitas.create', [
      'title' => 'Buat Aktifitas',
    ]);
  }

  public function store(TourismObjectStoreRequest $request)
  {

    try {
      $validate = $request->all();

      $aktifitas = Aktifita::create($validate);

      if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $gambarName = $gambar->getClientOriginalName();
        $gambar->move('fotoAktifitas/', $gambarName);
        $aktifitas->gambar = $gambarName;
        $aktifitas->save();
      }

      return redirect()->route('aktifitas')
        ->with('success', 'Data Aktifitas Telah di tambahkan');
    } catch (\Throwable $th) {
      Log::error('Error creating Aktifita: ', [
        'message' => $th->getMessage(),
        'file' => $th->getFile(),
        'line' => $th->getLine(),
        'trace' => $th->getTraceAsString(),
      ]);

      return redirect()->route('aktifitas')
        ->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
  }

  public function edit($id)
  {
    $aktifitas = Aktifita::findOrFail($id);

    return view('pages.dashboard.aktifitas.edit', [
      'title'  => "Edit $aktifitas->name",
      'aktifitas' => $aktifitas
    ]);
  }

  public function update(TourismObjectUpdateRequest $request, $id)
  {


    $validate = $request->validate([
      'name' => 'required|max:255|unique:aktifitas,name,' . $id,
      'deskripsi' => 'required|max:255|unique:aktifitas,deskripsi,' . $id,
      'gambar' => 'nullable|image|max:2048', // assuming 'gambar' is an image file
      'durasi' => 'required|max:255|unique:aktifitas,manfaat,' . $id,
      'kalori' => 'required|max:255|unique:aktifitas,kalori,' . $id,
    ]);
    $aktifitas = Aktifita::findOrFail($id);
    $aktifitas->update($validate);
    if ($request->hasFile('gambar')) {
      $gambar = $request->file('gambar');
      $gambarName = $gambar->getClientOriginalName();

      // Move the uploaded file to 'fotoAktifitas' directory
      $gambar->move('fotoAktifitas/', $gambarName);

      // Update the 'gambar' field in Aktifita with the new file name
      $aktifitas->gambar = $gambarName;
      $aktifitas->save();
    }

    return redirect()->route('aktifitas')
      ->with('success', 'The selected tourism object has been updated!');
  }

  public function destroy($id)
  {
    $aktifita = Aktifita::findOrFail($id); // Find the Aktifita instance by its ID
    $aktifita->delete();



    return redirect()->route('aktifitas')
      ->with('success', 'The selected tourism object has been deleted!');
  }
}
