<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function accueil() {
      $game_spotlight = \App\Games::where('id_game', '>', 0)->orderBy('id_game', 'desc')->first();
      $games_top = \App\Games::where('id_game', '>=', 0)->orderBy('count_play', 'desc')->limit(3)->get();
      return view('pages/accueil', ['game_spotlight'=>$game_spotlight, 'games_top'=>$games_top]);
    }

    public function contact() {
      return view('pages/contact');
    }

    public function post_comments(Request $request)
    {
        return dd($request);
    }

    public function post_contact(Request $request)
    {
        return var_dump($request);
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
      if(in_array(strtolower($level), $level_available)) {
        $level_available = strtoupper($level)."_available";
        $games = \App\Games::where($level_available, 1)->orderBy('id_game', 'desc')->get();
        return view('pages/level', ['level'=>strtoupper($level), 'games'=>$games] );
      }
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

    private function jeu($level, $matieres, $id_game, $game_name, $folder) {
      $level_available = array("cp","ce1","ce2","cm1","cm2");
      if(!(in_array(strtolower($level), $level_available)))
        return redirect()->route('accueil');

      $game_rank = \App\Ranking::where('id_game', $id_game)->orderBy('user_score', 'desc')->limit(10)->get();;

      $game_comments = \App\Comments::where('id_game', $id_game)->orderBy('date', 'asc')->get();

      $game = \App\Games::where('id_game', $id_game)->get();
      if(!($game[0][strtoupper($level).'_available'] == 1))
        return redirect()->route('accueil');
      if(!($game[0]->theme == strtolower($matieres)))
        return redirect()->route('accueil');
      return view('pages/jeu', [
        'level'=>strtoupper($level),
        'game'=>$game[0],
        'game_rank'=>$game_rank,
        'game_comments'=>$game_comments,
        'folder'=>$folder,
        'matieres'=>$matieres
        ] );
    }

     public function jeu_matieres($matieres, $level, $id_game, $game_name) {
      $folder = 'jeux';
      return $this->jeu($level, $matieres, $id_game, $game_name,$folder);
    }

    public function jeu_level($level, $matieres, $id_game, $game_name) {
      $folder = 'niveaux';
      return $this->jeu($level, $matieres, $id_game, $game_name, $folder);
    }

}
