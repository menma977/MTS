<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ledger
 * @package App\Model
 * @property string code
 * @property float|int credit
 * @property string description
 * @property float debit
 * @property int user
 * @property int ledger_type // 0: buy 1: bonus Sponsor 2: Bonus Level 3: Bonus Royalty
 */
class Ledger extends Model
{
  protected $fillable = [
    'code',
    'description',
    'debit',
    'credit',
    'user',
    'ledger_type',
  ];
}
