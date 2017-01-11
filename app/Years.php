<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Years extends Model
{
    /*  De base, la classe Post qui extends de Model prends comme acquis que :
          - Le nom de la table est le nom de la classe au pluriel
          - La primaryKey est 'id'
          - Le moteur de base de données attend à trouver deux column : createdAt, deletedAt. 
      
      Si on veut annuler tout ça, on définit nous même les paramètres. Si on a pas les deux column, on annule le timestamps    */
    protected $table = 'educa_years';
    public $timestamps = false; 
    
}
