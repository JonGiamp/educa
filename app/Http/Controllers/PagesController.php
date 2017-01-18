<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function accueil() {
      return view('pages/accueil');
    }

    public function contact() {
      return view('pages/contact');
    }

    public function connexion() {
      return view('auth/login');
    }

    public function inscription() {
      return view('auth/register');
    }

    public function rank() {
      if(Auth::check()) {
        // ranking Request
        $games_id = \App\Games::all()->sortBy("id_card")->pluck('id_game');
        $games_ranking = array();
        foreach ($games_id as $id) {
          $rank = \App\Ranking::where('id_game', $id)->orderBy('user_score', 'desc')->limit(10)->get();
          if(sizeof($rank) != 0)
            $games_ranking[] = $rank;
        }

        // Cards request
        $cards_id = \App\Users_x_cards::where('id_user', Auth::user()->id)->orderBy('id_card', 'desc')->pluck('id_card');
        $user_cards = array();
        foreach ($cards_id as $id)
            $user_cards[] = \App\Cards::where('id_card', $id)->get();

        return view('pages/scores', ['games_ranking'=>$games_ranking, 'user_cards'=>$user_cards]);
      }
      else
        return redirect()->route('accueil');
    }

    public function mentions() {
      return view('pages/mentions');
    }

    public function settings() {
      if(Auth::check()) {
        $user_comments = \App\Comments::where('id_user', Auth::user()->id)->orderBy('date', 'desc')->get();
        return view('pages/settings', ['user_comments'=>$user_comments]);
      }
      else
        return redirect()->route('accueil');
    }

    public function error() {
      return view('pages/error');
    }

    public function level($level) {
      $level_available = array("cp","ce1","ce2","cm1","cm2");
      if(in_array(strtolower($level), $level_available))
        return view('pages/level', ['level'=>strtoupper($level)] );
      else
        return redirect()->route('error');
    }

    public function games($matieres) {
      $matieres_available = array("francais","sciences","mathematiques");
      if(in_array(strtolower($matieres), $matieres_available)) {
        $games = \App\Games::where('theme', strtolower($matieres))->orderBy('id_game', 'desc')->get();
        return view('pages/games', ['matieres'=>strtoupper($matieres), 'games'=>$games] );
      }
      else
        return redirect()->route('error');
    }

    public function jeu($level, $game) {
      $level_available = array("cp","ce1","ce2","cm1","cm2");
      if(!(in_array(strtolower($level), $level_available)))
        return redirect()->route('accueil');
      return view('pages/jeu', ['level'=>strtoupper($level), 'game'=>$game] );
    }

}
