<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class EmailController extends Controller
{
  protected $nominal_tree = 1500000;

  public function order()
  {
    $order = Order::find(2);
    $order->user = User::find($order->user);
    $order->price = $order->total * $this->nominal_tree + $order->code;
    $order->agenMode = $order->status == 99 ? 300000 : '';
    $data = [
      'order' => $order
    ];

    return view('email.order', $data);
  }

  public function register()
  {
    return view('email.register');
  }

  /**
   * @param $email
   * @param $tokenUsername
   * @return Application|Factory|View
   */
  public function forgotPassword($email, $tokenUsername)
  {
    $user = User::where('email', $email)->get()->first();
    if (decrypt($tokenUsername) == $user->username) {
      $data = [
        'user' => $user,
        'token' => $tokenUsername,
        'validate' => true
      ];
      return view('auth.forgot', $data);
    }

    $data = [
      'validate' => false
    ];
    return view('auth.forgot', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @param $email
   * @param $tokenUsername
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function updatePassword(Request $request, $email, $tokenUsername)
  {
    $this->validate($request, [
      'password' => 'required|min:6',
    ]);

    $user = User::where('email', $email)->get()->first();
    if (decrypt($tokenUsername) == $user->username) {
      $user->password = bcrypt($request->password);
      $user->save();
    } else {
      return redirect()->back()->with(['password' => ['Data tidak valid']]);
    }

    return redirect()->route('index')->with(['massage' => ['Password anda sudah di ubah silahkan login ke aplikasi']]);
  }
}
