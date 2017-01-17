<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Users extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  use Authenticatable, CanResetPassword;

  protected $fillable = [
    'name', 'password', 'email', 'experience', 'level', 'years', 'avatar', 'date_register', 'last_connexion'
  ];

  protected $hidden = [
    'password', 'remember_token'
  ];

  public $timestamps = false;
}
