<?php

namespace App\Http\Controllers;

use App\Model\Ledger;
use App\Model\Withdraw;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class WithdrawController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    if (Auth::user()->role != 1) {
      $requestWithdraw = Withdraw::where('user', Auth::user()->id)->where('status', 0)->get();
    } else {
      $requestWithdraw = Withdraw::where('status', 0)->get();
    }
    $requestWithdraw->map(function ($item) {
      $item->user = User::find($item->user);

      return $item;
    });

    if (Auth::user()->role != 1) {
      $withdraw = Withdraw::where('user', Auth::user()->id)->where('status', 1)->get();
    } else {
      $withdraw = Withdraw::where('status', 1)->get();
    }
    $withdraw->map(function ($item) {
      $item->user = User::find($item->user);

      return $item;
    });

    $data = [
      'requestWithdraw' => $requestWithdraw,
      'withdraw' => $withdraw,
    ];

    return view('withdraw.index', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $id
   * @param $status
   * @return RedirectResponse
   */
  public function update($id, $status)
  {
    $id = base64_decode($id);
    $status = base64_decode($status);
    if ($status == 1) {
      $withdraw = Withdraw::find($id);
      $withdraw->status = 1;
      $withdraw->save();

      $ledger = new Ledger();
      $ledger->code = 'REG' . date('YmdHis');
      $ledger->credit = $withdraw->total;
      $ledger->description = User::find($withdraw->user)->name . ' telah Withdraw sejumlah : Rp' . number_format($withdraw->total, 0, ',', '.');
      $ledger->user = $withdraw->user;
      $ledger->ledger_type = 4;
      $ledger->save();

      try {
        $user = User::find($withdraw->user);
        $dataEmail = [
          'user' => $user,
          'nominal' => number_format($withdraw->total, 0, ',', '.'),
        ];
        Mail::send('email.withdraw', $dataEmail, function ($message) use ($user) {
          $message->to($user->email, 'Mitra Tani Sejahtera')->subject('Withdraw');
          $message->from('admin@mts.com', 'MTS');
        });
      } catch (Exception $e) {
      }
    } else {
      Withdraw::destroy($id);
    }

    return redirect()->back();
  }
}
