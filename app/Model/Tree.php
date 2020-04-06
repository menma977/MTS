<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tree
 * @package App\Model
 * @property int user
 * @property int type
 * @property string qr
 * @property string code
 * @property string start
 * @property string end
 * @property int yield
 * @property string x_fild
 * @property string y_fild
 * @property int status // 1 : Active 2 : Herviset
 */
class Tree extends Model
{
  protected $fillable = [
    'user',
    'type',
    'qr',
    'code',
    'start',
    'end',
    'yield',
    'x_fild',
    'y_fild',
    'status',
  ];
}
