<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tree
 * @package App\Model
 * @property int user_id
 * @property string qr
 * @property string code
 * @property string start
 * @property string end
 * @property int status
 */
class Tree extends Model
{
  protected $fillable = [
    'user_id',
    'qr',
    'code',
    'start',
    'end',
    'status',
  ];
}
