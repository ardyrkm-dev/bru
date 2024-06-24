<?php

namespace App\Http\Controllers;

use App\Models\Aktifita;
use Illuminate\Http\Request;

class LandingPagesController extends Controller
{
   public function index()
   {

      return view('pages.landing.index');
   }

   public function aktifitasPage()
   {
      $aktifitas = Aktifita::all();
      return view('pages.landing.Aktifitas.aktifitas', compact('aktifitas'));
   }

   public function detailAktifitasPage($id)
   {
      $aktifitas = Aktifita::findOrFail($id);
      return view('pages.landing.Aktifitas.detailAktifitas', compact('aktifitas'));
   }
}
