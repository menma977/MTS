<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Binary
 * @package App\Model
 * @property string id
 * @property string title
 * @property string description
 */
class Banner extends Model
{
  protected $fillable = [
    'id',
    'title',
    'description',
  ];
}
