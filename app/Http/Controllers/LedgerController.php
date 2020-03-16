<?php

namespace App\Http\Controllers;

use App\model\Ledger;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LedgerController extends Controller
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
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    if (Auth::user()->role == 0) {
      $ledger = Ledger::orderBy('id', 'desc')->get();
    } else {
      $ledger = Ledger::where('user', Auth::user()->id)->orderBy('id', 'desc')->get();
    }
    $ledger->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $data = [
      'ledger' => $ledger
    ];

    return view('ledger.index', $data);
  }
}
