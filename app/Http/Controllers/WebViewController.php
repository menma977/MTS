<?php

namespace App\Http\Controllers;

use App\Model\Binary;
use App\Model\Code;
use App\Model\Ledger;
use App\Model\Tree;
use App\Model\TreeImage;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WebViewController extends Controller
{
  /**
   * @param $id
   * @return Factory|View
   */
  public function gallery($id)
  {
    $tree = Tree::find($id);
    $tree->user = User::find($tree->user_id);
    $tree->gallery = TreeImage::where('tree_id', $tree->id)->get();

    $data = [
      'tree' => $tree
    ];

    return view('android.index', $data);
  }

  /**
   * @return Factory|View
   */
  public function binary()
  {
    $binary = Binary::where('sponsor', Auth::user()->id)->get();
    $binary->map(function ($item) {
      $item->userDownLine = User::find($item->user);
    });

    $data = [
      'binary' => $binary
    ];

    return view('android.binary', $data);
  }

  /**
   * @param $id
   * @return mixed
   */
  public function binaryShow($id)
  {
    $binary = Binary::where('sponsor', $id)->get();
    $binary->map(function ($item) {
      $item->userDownLine = User::find($item->user);
    });

    return $binary;
  }

  public function ledger($type)
  {
    if ($type == 1) {
      $ledger = Ledger::where('user', Auth::user()->id)->whereBetween('ledger_type', [1, 4])->orderBy('id', 'desc')->get();
    } else {
      $ledger = Ledger::where('user', Auth::user()->id)->whereIn('ledger_type', [5, 6])->orderBy('id', 'desc')->get();
    }
    $ledger->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $data = [
      'ledger' => $ledger
    ];

    return view('android.ledger', $data);
  }

  public function pin()
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

    return view('android.pin', $data);
  }


  public function generateData($id)
  {
    $code = explode('.', $id)[1];
    $id = ($code - 10) + 5;
    $tree = Tree::find($id);
    $tree->user = User::find($tree->user);
    $QR = QrCode::format('png')->size(1000)->merge('./img/mts_top.png', .2, true)->errorCorrection('H')->generate($tree->qr);

    $data = [
      'tree' => $tree,
      'qr' => $QR,
    ];

    return \view('tree.certificate', $data);
  }
}
