<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Code;
use App\Model\Role;
use App\Model\Binary;
use App\Model\Ledger;
use App\Model\Order;
use App\Model\Stup;
use App\Model\Tree;
use App\Model\Withdraw;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Cast\Object_;

class UserController extends Controller
{
  protected $nominal_tree = 1500000;

  /**
   * @return JsonResponse
   */
  public function verification(): JsonResponse
  {
    return response()->json(['response' => Auth::check()], 200);
  }

  /**
   * @return array
   */
  private function adminData(): array
  {
    $admin = User::find(1);

    return [
      'name' => $admin->name,
      'bank' => $admin->bank,
      'pin_bank' => $admin->pin_bank,
    ];
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function login(Request $request): ?JsonResponse
  {
    $this->validate($request, [
      'username' => 'required|string',
      'password' => 'required|string',
    ]);
    if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
      $user = Auth::user();
      if (($user !== null) && $user->status == 0) {
        $data = [
          'message' => 'The given data was invalid.',
          'errors' => [
            'validation' => ['Akun Anda telah ditangguhkan. silakan hubungi admin.'],
          ],
        ];
        return response()->json($data, 500); //new change 500
      }

      $token = Auth::user()->tokens;
      foreach ($token as $key => $value) {
        $value->delete();
      }
      $user->token = $user->createToken('Android')->accessToken;
      return response()->json([
        'response' => $user->token,
        'username' => $user->username,
        'status' => $user->status,
        'role' => $user->role,
        'img' => $user->image
      ], 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'validation' => ['username atau password tidak valid.'],
      ],
    ];
    return response()->json($data, 500);
  }

  /**
   * @return JsonResponse
   */
  public function show(): JsonResponse
  {
    $user = Auth::user();
    $user->type = Role::find($user->role)->description;
    return response()->json(['response' => $user], 200);
  }

  /**
   * @return JsonResponse
   */
  public function logout(): JsonResponse
  {
    $token = Auth::user()->tokens;
    foreach ($token as $key => $value) {
      $value->delete();
    }
    return response()->json([
      'response' => 'Successfully logged out',
    ], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function register(Request $request): JsonResponse
  {
    $this->validate($request, [
      'name' => 'required|string',
      'username' => 'required|string|min:6|unique:users',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'c_password' => 'required|min:6|same:password',
      'id_identity_card' => 'required|numeric|unique:users',
      'phone' => 'required|unique:users|numeric|digits_between:10,15',
      'bank' => 'required|string',
      'pin_bank' => 'required|string|unique:users',
      'address' => 'required',
    ]);

//    $code = Code::where('user', Auth::user()->id)->get()->count();
//    if (!$code) {
//      $data = [
//        'message' => 'The given data was invalid.',
//        'errors' => [
//          'pin' => ['Tidak memiliki pin yang terseisa'],
//        ],
//      ];
//      return response()->json($data, 500);
//    }

    if (strpos($request->phone, '62') === 0) {
      $phone = substr_replace($request->phone, '0', 0, 2);
    } else if (strpos($request->phone, '+62') === 0) {
      $phone = substr_replace($request->phone, '0', 0, 3);
    } else {
      $phone = $request->phone;
    }

    $user = new User();
    $user->role = 2;
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->phone = $phone;
    $user->id_identity_card = $request->id_identity_card;
    $user->bank = $request->bank;
    $user->pin_bank = $request->pin_bank;
    $user->address = $request->address;
    $user->save();

    $binary = new Binary();
    $binary->sponsor = Auth::user()->id;
    $binary->user = $user->id;
    $binary->save();

    try {
      $dataEmail = [
        'user' => $user->name,
        'sponsor' => Auth::user()->name,
      ];
      Mail::send('email.register', $dataEmail, function ($message) use ($user) {
        $message->to($user->email, 'Mitra Tani Sejahtera')->subject('Pendaftaran');
        $message->from('admin@mts.com', 'MTS');
      });
    } catch (Exception $e) {
    }

    return response()->json(['response' => 'User telah terdaftar mohon login untuk meneruskan'], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function updatePassword(Request $request): JsonResponse
  {
    if (Hash::check($request->password, Auth::user()->password)) {
      $this->validate($request, [
        'password' => 'required',
        'new_password' => 'required|min:6',
        'new_c_password' => 'required|same:new_password',
      ]);

      $user = Auth::user();
      if ($user !== null) {
        $user->password = bcrypt($request->new_password);
      }
      $user->save();

      $data = [
        'response' => 'Password anda saat ini adalah: ' . $request->new_password,
      ];
      return response()->json($data, 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'password' => ['Password lama anda tidak cocok'],
      ],
    ];
    return response()->json($data, 500);
  }

  /**
   * @return JsonResponse
   */
  public function balance(): JsonResponse
  {
    $downLine = Binary::where('sponsor', Auth::user()->id)->get();
    $balanceSponsor = Ledger::where('user', Auth::user()->id)->where('ledger_type', 1)->sum('credit') - Ledger::where('user', Auth::user()->id)->where('ledger_type', 1)->sum('debit');
    $balanceLevel = Ledger::where('user', Auth::user()->id)->where('ledger_type', 2)->sum('credit') - Ledger::where('user', Auth::user()->id)->where('ledger_type', 2)->sum('debit');
    $balanceRoyalty = Ledger::where('user', Auth::user()->id)->where('ledger_type', 3)->sum('credit') - Ledger::where('user', Auth::user()->id)->where('ledger_type', 3)->sum('debit');
    $balanceHarvest = Ledger::where('user', Auth::user()->id)->where('ledger_type', 5)->sum('credit') - Ledger::where('user', Auth::user()->id)->where('ledger_type', 5)->sum('debit');
    $withdraw = Ledger::where('user', Auth::user()->id)->where('ledger_type', 4)->sum('credit') + Ledger::where('user', Auth::user()->id)->where('ledger_type', 4)->sum('debit');
    $order = Order::where('user', Auth::user()->id)->whereIn('status', [0, 99])->get();
    $totalPorang = Tree::where('user', Auth::user()->id)->where('status', 1)->count();
    $code = Code::where('user', Auth::user()->id)->get()->count();

    $title = '';
    $description = '';

    $banner = Banner::find(1);
    if ($banner) {
      $title = $banner->title;
      $description = $banner->description;
    }

    $data = [
      'balance' => 'Rp ' . number_format(($balanceSponsor + $balanceLevel + $balanceRoyalty) - $withdraw, 0, ',', '.'),
      'harvest' => 'Rp ' . number_format($balanceHarvest, 0, ',', '.'),
      'down_line' => $downLine->count(),
      'admin' => $this->adminData(),
      'data' => $order,
      'nominal' => $this->nominal_tree,
      'package' => $totalPorang,
      'code' => $code,
      'bannerTitle' => $title,
      'bannerDescription' => $description
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function updateImage(Request $request): JsonResponse
  {
    $user = Auth::user();
    $localUrl = str_replace('/index.php', '', $request->root());
    if ($request->image) {
      $this->validate($request, [
        'image' => 'required|mimes:jpeg,png,jpg',
      ]);
      if (($user !== null) && $user->image) {
        $fileName = explode('/', $user->image);
        File::delete('dist/img/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->image->extension();

      $request->image->move('images', $imageName);
      $user->image = $localUrl . '/images' . '/' . $imageName;
    }
    if ($request->identity_card_image) {
      $this->validate($request, [
        'identity_card_image' => 'required|mimes:jpeg,png,jpg',
      ]);
      if (($user !== null) && $user->identity_card_image) {
        $fileName = explode('/', $user->identity_card_image);
        File::delete('img/ktp/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->identity_card_image->extension();

      $request->identity_card_image->move('img/ktp/', $imageName);
      $user->identity_card_image = $localUrl . '/img/ktp' . '/' . $imageName;
    }
    if ($request->identity_card_image_salve) {
      $this->validate($request, [
        'identity_card_image_salve' => 'required|mimes:jpeg,png,jpg',
      ]);
      if (($user !== null) && $user->identity_card_image_salve) {
        $fileName = explode('/', $user->identity_card_image_salve);
        File::delete('img/ktp/user/' . $fileName[4]);
      }
      $imageName = time() . '.' . $request->identity_card_image_salve->extension();

      $request->identity_card_image_salve->move('img/ktp/user/', $imageName);
      $user->identity_card_image_salve = $localUrl . '/img/ktp/user/' . $imageName;
    }
    $user->save();
    return response()->json(['response' => $user], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @var Object_ $user
   */
  public function updateData(Request $request): JsonResponse
  {
    $user = Auth::user();
    if ($request->name) {
      $this->validate($request, [
        'name' => 'required|string',
      ]);
      if ($user !== null) {
        $user->name = $request->name;
      }
    }
    if ($request->address) {
      $this->validate($request, [
        'address' => 'required|string|min:10',
      ]);
      if ($user !== null) {
        $user->address = $request->address;
      }
    }
    if ($request->password_lama) {
      $this->validate($request, [
        'password_lama' => 'required|string|min:6',
        'password_baru' => 'required|string|min:6',
        'konfirmasi_password_baru' => 'required|string|min:6|same:password_baru',
      ]);
      if ($user !== null) {
        if (Hash::check($request->password_lama, $user->password)) {
          $user->password = bcrypt($request->password_baru);
        } else {
          $data = [
            'message' => 'The given data was invalid.',
            'errors' => [
              'password' => ['Password lama yang anda inputkan tidak valid'],
            ],
          ];
          return response()->json($data, 500);
        }
      }
    }
    $user->save();
    if ($request->password) {
      return response()->json(['response' => 'Data telah di update', 'password' => true], 200);
    }

    return response()->json(['response' => 'Data telah di update', 'password' => false], 200);
  }

  /**
   * @return JsonResponse
   */
  public function withdrawValidate(): JsonResponse
  {
    $withdraw = Withdraw::where('user', Auth::user()->id)->where('status', 0)->count();
    return response()->json(['response' => $withdraw], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function withdraw(Request $request): JsonResponse
  {
    $limit = Ledger::where('user', Auth::user()->id)->whereBetween('ledger_type', [1, 3])->sum('credit')
      - Ledger::where('user', Auth::user()->id)->whereBetween('ledger_type', [1, 3])->sum('debit');
    $limit -= Ledger::where('user', Auth::user()->id)->where('ledger_type', 4)->sum('credit')
      - Ledger::where('user', Auth::user()->id)->where('ledger_type', 4)->sum('debit');
    if ($limit < 0) {
      $limit = 0;
    }
    $this->validate($request, [
      'nominal' => 'required|numeric|min:100000|max:' . $limit,
    ]);

    $withdraw = new Withdraw();
    $withdraw->user = Auth::user()->id;
    $withdraw->total = $request->nominal;
    $withdraw->status = 0;
    $withdraw->save();

    return response()->json(['response' => 'Withdraw Sedang di proses oleh ADMIN'], 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function checkTree(Request $request): ?JsonResponse
  {
    $this->validate($request, [
      'qr' => 'required|exists:trees,qr',
    ]);

    $tree = Tree::where('qr', $request->qr)->first();
    if ($tree->user == Auth::user()->id) {
      $tree->user = Auth::user()->username;
      return response()->json(['response' => $tree], 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'qr' => ['Barcode ini bukan milik anda'],
      ],
    ];
    return response()->json($data, 500);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   * @throws Exception
   */
  public function requestTree(Request $request): JsonResponse
  {
    $this->validate($request, [
      'total' => 'required|numeric',
      'agentMode' => 'required|numeric',
      'type' => 'required|numeric'
    ]);

    $order = new Order();
    $order->user = Auth::user()->id;
    $order->total = $request->total;
    $order->code = random_int(99, 999);
    if ($request->agentMode) {
      $order->status = 99;
      $totalNominalPayment = ($order->total * $this->nominal_tree) + $order->code + 300000;
    } else {
      $order->status = 0;
      $totalNominalPayment = ($order->total * $this->nominal_tree) + $order->code;
    }
    $order->type = $request->type;
    $order->save();

    try {
      $order->user = User::find($order->user);
      $order->price = $order->total * $this->nominal_tree + $order->code;
      $order->agenMode = $order->status == 99 ? 300000 : '';

      $dataEmail = [
        'order' => $order
      ];
      Mail::send('email.order', $dataEmail, function ($message) use ($order) {
        $message->to($order->user->email, 'Mitra Tani Sejahtera')->subject('Invoice');
        $message->from('admin@mts.com', 'MTS');
      });
      $massaege = 'Order Anda sedang di proses oleh admin, tunggu email invoic yang akan masuk';
    } catch (Exception $e) {
      $massaege = 'Order Anda sedang di proses oleh admin, anda tidak mendapatkan invoce karna email tidak valid';
    }

    $data = [
      'response' => $massaege,
      'admin' => $this->adminData(),
      'total' => $totalNominalPayment,
    ];

    return response()->json($data, 200);
  }


  /**
   * @return JsonResponse
   */
  public function gallery()
  {
    $tree = Tree::where('user', Auth::user()->id)->where('status', 1)->get();
    $tree->map(function ($itme) {
      $itme->yield *= 0.6;
    });

    $data = [
      'response' => $tree,
    ];

    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function transfer(Request $request)
  {
    $this->validate($request, [
      'index' => 'required|numeric',
      'image' => 'required|mimes:jpeg,png,jpg',
    ]);
    $order = Order::find($request->index);
    if (($order !== null) && $order->image) {
      $fileName = explode('/', $order->image);
      File::delete('img/transfer/' . $fileName[4]);
    }
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move('img/transfer/', $imageName);
    $order->image = str_replace('index.php/', '/', $request->root()) . '/img/transfer/' . $imageName;
    $order->save();

    $data = [
      'response' => 'Tunggu validasi oleh admin. ketika anda mengupload ulang anda menggantikan gambar yang lama dengan yang baru',
    ];
    return response()->json($data, 200);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function requestPassword(Request $request) {
    $this->validate($request, [
      'email' => 'required|exists:users,email',
    ]);

    try {
      $user = User::where('email', $request->email)->get()->first();
      $data = [
        'user' => $user
      ];
      Mail::send('email.password', $data, function ($message) use ($user) {
        $message->to($user->email, 'Mitra Tani Sejahtera')->subject('Lupa Kata Sandi');
        $message->from('admin@mts.com', 'MTS');
      });
      $massaege = 'tunggu email pengubahan katasandi';
    } catch (Exception $e) {
      $massaege = 'email anda tidak valid coba hubungi admin untuk prubahan data' . $e;
    }

    $data = [
      'response' => $massaege,
    ];
    return response()->json($data, 200);
  }
}
