<?php

namespace App\Http\Controllers;

use App\Model\Code;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return Renderable
   */
  public function index()
  {
    $code = Code::all();
    $code->map(function ($item) {
      if ($item->user) {
        $item->user = User::find($item->user);
      }
      if ($item->send) {
        $item->send = User::find($item->send);
      }
    });

    $data = [
      'code' => $code
    ];

    return view('home', $data);
  }

  /**
   * @return JsonResponse
   */
  public function isOnlineStatus(): JsonResponse
  {
    $count = 0;
    $online = 0;
    $offline = 0;
    $user = User::all();
    foreach ($user as $item) {
      if ($item->isOnline()) {
        $online++;
      } else {
        $offline++;
      }
      $count++;
      foreach ($item->tokens as $subItem) {
        if (!$item->isOnline()) {
          if ($subItem->revoked == 0) {
            $online++;
            $offline--;
          } else {
            $online--;
            $offline++;
          }
        }
      }
    }

    $data = [
      'count' => $count,
      'online' => $online,
      'offline' => $offline,
    ];

    return response()->json($data, 200);
  }

  /**
   * @return JsonResponse
   */
  public function authOnline()
  {
    return response()->json(['response' => Auth::user()->isOnline()], 200);
  }
}
