<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Binary
 * @package App\Model
 * @property int sponsor
 * @property int user
 */
class Binary extends Model
{
  protected $fillable = [
    'sponsor',
    'user',
  ];
}
