<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function accueil() {
      return view('pages/accueil');
    }

    public function contact() {
      return view('pages/contact');
    }

    public function login() {
      return view('pages/login');
    }

    public function rank() {
      return view('pages/scores');
    }

    public function mentions() {
      return view('pages/mentions');
    }

    public function settings() {
      return view('pages/settings');
    }

    public function level($level) {
      $level_available = array("cp","ce1","ce2","cm1","cm2");
      if(in_array(strtolower($level), $level_available))
        return view('pages/level', ['level'=>strtoupper($level)] );
      else
        return redirect()->route('accueil');
    }

    public function games($matieres) {
      $matieres_available = array("francais","sciences","mathematiques");
      if(in_array(strtolower($matieres), $matieres_available))
        return view('pages/games', ['matieres'=>strtoupper($matieres)] );
      else
        return redirect()->route('accueil');
    }

    public function jeu($level, $game) {
      $level_available = array("cp","ce1","ce2","cm1","cm2");
      if(!(in_array(strtolower($level), $level_available)))
        return redirect()->route('accueil');
      return view('pages/jeu', ['level'=>strtoupper($level), 'game'=>$game] );
    }

}
