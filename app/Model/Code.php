<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Code
 * @package App\Model
 * @property int user
 * @property int send
 */
class Code extends Model
{
  protected $fillable = [
    'user',
    'send',
  ];
}
