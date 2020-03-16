<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Withdraw
 * @package App\Model
 * @property int user
 * @property string total
 * @property int status
 */
class Withdraw extends Model
{
  protected $fillable = [
    'user',
    'total',
    'status',
  ];
}
