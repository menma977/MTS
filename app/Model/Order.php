<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Model
 * @property int user
 * @property int image
 * @property int total
 * @property int status
 */
class Order extends Model
{
  protected $fillable = [
    'user',
    'image',
    'total',
    'code',
    'status',
  ];
}
