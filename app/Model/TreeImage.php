<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TreeImage
 * @package App\Model
 * @property int tree_id
 * @property int image
 */
class TreeImage extends Model
{
  protected $fillable = [
    'tree_id',
    'image',
  ];
}
