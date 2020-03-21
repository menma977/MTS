<?php

namespace App\Http\Controllers;

use App\Model\Binary;
use App\Model\Ledger;
use App\Model\Tree;
use App\Model\Order;
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
      $item->gallery = TreeImage::where('tree_id', $item->id)->get();
    });

    $order = Order::all();
    $order->map(function ($item) {
      $item->user = User::find($item->user);
    });

    $data = [
      'user' => $user,
      'tree' => $tree,
      'order' => $order,
    ];

    return view('tree.index', $data);
  }

  /**
   * @param $username
   * @return Factory|View
   */
  public function show($username)
  {
    $users = User::all();
    if ($username == 'all') {
      $tree = Tree::orderBy('id', 'desc')->get();
      $tree->map(function ($item) {
        $item->user = User::find($item->user);
        $item->gallery = TreeImage::where('tree_id', $item->id)->get();
      });
    } else {
      $tree = Tree::where('user', User::where('username', $username)->get()->first()->id)->orderBy('id', 'desc')->get();
      $tree->map(function ($item) {
        $item->user = User::find($item->user);
        $item->gallery = TreeImage::where('tree_id', $item->id)->get();
      });
    }

    $data = [
      'tree' => $tree,
      'users' => $users,
      'username' => $username
    ];

    return view('tree.show', $data);
  }

  /**
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function harvest(Request $request, $id)
  {
    $this->validate($request, [
      'yiled' => 'required|numeric',
    ]);

    $tree = Tree::find(base64_decode($id));
    $tree->yield = $request->yiled;
    $tree->status = 3;
    $tree->save();

    $user = User::find($tree->user);
    $sponsor = User::find(Binary::where('user', $user->id)->get()->first()->sponsor);

    if ($sponsor->role == 4) {
      $ledger = new Ledger();
      $ledger->code = 'BYBONROYAL' . date('YmdHis');
      $ledger->credit = $tree->yield * 0.05;
      $ledger->description = 'anda mendapatkan bonus royalty 5% dari panen ' . $user->username . ' sebesar : Rp' . number_format($ledger->credit, 0, ',', '.');
      $ledger->user = $sponsor->id;
      $ledger->ledger_type = 3;
      $ledger->save();
    }

    $getSponsor = User::find($sponsor->id);
    $level = 2;
    for ($j = 0; $j < $level; $j++) {
      $user = User::find($getSponsor->id);
      if (Binary::where('user', $user->id)->get()->first()) {
        $sponsor = User::find(Binary::where('user', $user->id)->get()->first()->sponsor);
        if ($sponsor->role == 4) {
          $ledgers = new Ledger();
          $ledgers->code = 'BYBONLEVEL' . date('YmdHis');
          $ledgers->credit = $ledger->credit * 0.033;
          $ledgers->description = 'anda mendapatkan bonus level 3.3% dari panen ' . $user->username . ' sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
          $ledgers->user = $sponsor->id;
          $ledgers->ledger_type = 2;
          $ledgers->save();
        }
        $getSponsor = User::find($sponsor->id);
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

      $ledger_1 = new Ledger();
      $ledger_1->code = 'BUY' . date('YmdHis');
      $ledger_1->credit = $this->nominal_tree * $order->total;
      $ledger_1->description = 'Pembelian Pohon : Rp' . number_format($ledger_1->credit, 0, ',', '.');
      $ledger_1->user = $getUser->id;
      $ledger_1->ledger_type = 0;
      $ledger_1->save();

      if (User::find($getSponsor)->role == 4) {
        $ledgers = new Ledger();
        $ledgers->code = 'BYBONSPON' . date('YmdHis');
        $ledgers->credit = $ledger_1->credit * 0.1;
        $ledgers->description = 'anda mendapatkan bonus 10% dari pembelian sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
        $ledgers->user = $getSponsor;
        $ledgers->ledger_type = 1;
        $ledgers->save();

        $ledgers = new Ledger();
        $ledgers->code = 'BYBONLEVEL' . date('YmdHis');
        $ledgers->credit = $ledger_1->credit * 0.033;
        $ledgers->description = 'anda mendapatkan bonus level 3.3% dari panen ' . $getUser->username . ' sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
        $ledgers->user = $getSponsor;
        $ledgers->ledger_type = 2;
        $ledgers->save();
      }

      $getSponsor = User::find($getSponsor);
      $level = 2;
      for ($j = 0; $j < $level; $j++) {
        $user = User::find($getSponsor->id);
        if (Binary::where('user', $user->id)->get()->first()) {
          $sponsor = User::find(Binary::where('user', $user->id)->get()->first()->sponsor);
          if ($sponsor->role == 4) {
            $ledgers = new Ledger();
            $ledgers->code = 'BYBONLEVEL' . date('YmdHis');
            $ledgers->credit = $ledger_1->credit * 0.033;
            $ledgers->description = 'anda mendapatkan bonus level 3.3% dari panen ' . $user->username . ' sebesar : Rp' . number_format($ledgers->credit, 0, ',', '.');
            $ledgers->user = $sponsor->id;
            $ledgers->ledger_type = 2;
            $ledgers->save();
          }
          $getSponsor = User::find($sponsor->id);
        }
      }

      for ($i = 0; $i < $order->total; $i++) {
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

    $QR = QrCode::format('png')->size(500)->merge('./img/mts_top.png', .2, true)->errorCorrection('H')->generate($tree->qr);

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
      $item->BarCode = QrCode::format('png')->size(250)->merge('./img/mts_top.png', .2, true)->errorCorrection('H')->generate($item->qr);
    });

    $data = [
      'tree' => $tree
    ];

    return view('tree.listQRCode', $data);
  }

  /**
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function uploadToGallery(Request $request, $id)
  {
    $this->validate($request, [
      'img' => 'required|mimes:jpeg,png,jpg|max:2000',
    ]);
    $treeImage = new TreeImage();
    $treeImage->tree_id = base64_decode($id);
    $imageName = time() . '.' . $request->img->extension();
    $request->img->move('gallery', $imageName);
    $treeImage->image = $request->root() . '/gallery' . '/' . $imageName;
    $treeImage->save();

    return redirect()->back();
  }

  public function showMap($id)
  {
    $tree = Tree::find(base64_decode($id));
    $data = [
      'tree' => $tree
    ];

    return \view('tree.map', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @param $idTree
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function storeMap(Request $request, $idTree)
  {
    $this->validate($request, [
      'long' => 'required',
      'lat' => 'required',
    ]);

    $tree = Tree::find($idTree);
    $tree->x_fild = $request->long;
    $tree->y_fild = $request->lat;
    $tree->save();

    return redirect()->route('tree.index');
  }
}
