<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\User;
use Illuminate\Http\Request;

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
}
