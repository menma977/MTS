<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Model
 * @property int id
 * @property string description
 */
class Role extends Model
{
  protected $fillable = [
    'id',
    'description',
  ];
}
