<?php

namespace App\Http\Controllers;

use App\model\Binary;
use App\model\Ledger;
use App\model\Tree;
use App\model\Order;
use App\Model\TreeImage;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TreeController extends Controller
{
  protected $nominal_tree = 1500000;

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
    $user = User::where('role', 1)->get();
    $tree = Tree::orderBy('id', 'desc')->get();
    $tree->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $order = Order::all();
    $order->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $data = [
      'user' => $user,
      'trees' => $tree,
      'stup' => $order,
    ];

    return view('tree.index', $data);
  }

  /**
   * @param $id
   * @return Factory|View
   */
  public function show($id)
  {
    $tree = Tree::find($id);
    $treeImage = TreeImage::where('tree_id', $tree->id)->get();

    $data = [
      'tree' => $tree,
      'treeImage' => $treeImage
    ];
    return \view('', $data);
  }

  /**
   * @param $id
   * @return RedirectResponse
   */
  public function harvest($id)
  {
    $tree = Tree::find(base64_decode($id));
    $tree->status = 3;
    $tree->save();

    $user = User::find($tree->user_id);
    $sponsor = User::find(Binary::where('user', $user->id)->get()->first()->sponsor);

    $ledgers = new Ledger();
    $ledgers->code = 'BYBONROYAL' . date('YmdHis');
    $ledgers->credit = (1 * 600 * 2 * 1000) * 0.05;
    $ledgers->description = 'anda mendapatkan bonus royalty 5% dari panen ' . $user->username . ' sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
    $ledgers->user = $sponsor->id;
    $ledgers->ledger_type = 3;
    $ledgers->save();

    $ledgers = new Ledger();
    $ledgers->code = 'BYBONLEVEL' . date('YmdHis');
    $ledgers->credit = (1 * 600 * 2 * 1000) * 0.033;
    $ledgers->description = 'anda mendapatkan bonus level 3.3% dari panen ' . $user->username . ' sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
    $ledgers->user = $sponsor->id;
    $ledgers->ledger_type = 2;
    $ledgers->save();

    $level = 2;
    for ($i = 0; $i < $level; $i++) {
      $user = User::find($sponsor->id);
      $sponsor = User::find(Binary::where('user', $user->id)->get()->first()->sponsor);
      if ($sponsor->role == 4) {
        $ledgers = new Ledger();
        $ledgers->code = 'BYBONLEVEL' . date('YmdHis');
        $ledgers->credit = (1 * 600 * 2 * 1000) * 0.033;
        $ledgers->description = 'anda mendapatkan bonus level 3.3% dari panen ' . $user->username . ' sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
        $ledgers->user = $sponsor->id;
        $ledgers->ledger_type = 2;
        $ledgers->save();
      }
    }

    return redirect()->back();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $this->validate($request, [
      'count' => 'required|numeric|max:1000',
    ]);

    for ($i = 0; $i < $request->count; $i++) {
      $lastId = Tree::count();

      $tree = new Tree();
      $tree->qr = $lastId;
      $tree->code = 'QR' . date('YmdHis') . $lastId;
      $tree->save();
    }

    return redirect()->back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $order
   * @param $status
   * @return RedirectResponse
   */
  public function update($order, $status): RedirectResponse
  {
    $order = base64_decode($order);
    $status = base64_decode($status);
    if ($status == 1) {
      $order = Order::find($order);
      $order->status = 1;

      $countTree = Tree::whereNull('user')->count();
      if ($countTree < $order->total) {
        return back()->withErrors(['count' => ['Jumlah Pohon yang ada kurang dari permintaan']]);
      }

      $order->save();

      $getUser = User::find($order->user);
      if (Binary::where('user', $getUser->id)->first()) {
        $getSponsor = Binary::where('user', $getUser->id)->first()->sponsor;
      } else {
        $getSponsor = $getUser->id;
      }

      for ($i = 0; $i < $order->total; $i++) {
        $ledgerAdmin = new Ledger();
        $ledgerAdmin->code = 'BUY' . date('YmdHis');
        $ledgerAdmin->credit = 2000000;
        $ledgerAdmin->description = 'Pembelian Pohon : Rp' . number_format($ledgerAdmin->credit, 0, ',', '.');
        $ledgerAdmin->ledger_type = 0;
        $ledgerAdmin->save();

        if (User::find($getSponsor)->role == 4) {
          $ledgers = new Ledger();
          $ledgers->code = 'BYBONSPON' . date('YmdHis');
          $ledgers->credit = (10 / 100) * $ledgerAdmin->credit;
          $ledgers->description = 'anda mendapatkan bonus 10% dari pembelian sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
          $ledgers->user = $getSponsor;
          $ledgers->ledger_type = 1;
          $ledgers->save();
        }

        $tree = Tree::whereNull('user')->first();
        $tree->user = $getUser->id;
        $tree->start = Carbon::now()->format('Y-m-d');
        $tree->end = Carbon::now()->addMonth(6)->format('Y-m-d');
        $tree->save();
      }
    } else {
      Order::destroy($order);
    }

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $id
   * @return Factory|View
   */
  public function QRCode($id)
  {
    $id = base64_decode($id);
    $tree = Tree::find($id);

    $QR = QrCode::format('png')->size(500)->merge('img/logo.png', .2, true)->errorCorrection('H')->generate($tree->qr);

    $data = [
      'qr' => $QR,
      'code' => $tree->code,
    ];

    return view('tree.qrCode', $data);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Request $request
   * @return Factory|View
   * @throws ValidationException
   */
  public function QRCodeList(Request $request)
  {
    $this->validate($request, [
      'count' => 'required|numeric|max:1000',
    ]);
    $tree = Tree::whereNull('user')->whereNull('user')->take($request->count)->get();
    $tree->map(function ($item) {
      $item->BarCode = QrCode::format('png')->size(250)->merge('img/logo.png', .2, true)->errorCorrection('H')->generate($item->qr);
    });

    $data = [
      'tree' => $tree
    ];

    return view('tree.listQRCode', $data);
  }
}
