<?php

namespace App\Http\Controllers;

use App\model\Binary;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BinaryController extends Controller
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
    $binary = Binary::where('sponsor', Auth::user()->id)->get();
    $binary->map(function ($item) {
      $item->userDownLine = User::find($item->user);
    });

    $data = [
      'binary' => $binary
    ];

    return view('binary.index', $data);
  }

  /**
   * Display the specified resource.
   *
   * @param $id
   * @return JsonResponse
   */
  public function show($id)
  {
    $binary = Binary::where('sponsor', $id)->get();
    $binary->map(function ($item) {
      $item->userDownLine = User::find($item->user);
    });

    return $binary;
  }
}
