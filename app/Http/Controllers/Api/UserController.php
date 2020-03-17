<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\model\Binary;
use App\model\Ledger;
use App\Model\Order;
use App\Model\Stup;
use App\Model\Tree;
use App\model\Withdraw;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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
        return response()->json($data, 422); //new change 500
      }

      $token = Auth::user()->tokens;
      foreach ($token as $key => $value) {
        $value->delete();
      }
      $user->token = $user->createToken('Android')->accessToken;
      return response()->json(['response' => $user->token], 200);
    }

    $data = [
      'message' => 'The given data was invalid.',
      'errors' => [
        'validation' => ['username atau password tidak valid.'],
      ],
    ];
    return response()->json($data, 422);
  }

  /**
   * @return JsonResponse
   */
  public function show(): JsonResponse
  {
    return response()->json(['response' => Auth::user()], 200);
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

    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->phone = $request->phone;
    $user->id_identity_card = $request->id_identity_card;
    $user->bank = $request->bank;
    $user->pin_bank = $request->pin_bank;
    $user->address = $request->address;
    $user->save();

    $binary = new Binary();
    $binary->sponsor = Auth::user()->id;
    $binary->user = $user->id;
    $binary->save();

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
    return response()->json($data, 422);
  }

  /**
   * @return JsonResponse
   */
  public function balance(): JsonResponse
  {
    $balance = Ledger::where('user', Auth::user()->id)->sum('credit') - Ledger::where('user', Auth::user()->id)->sum('debit');
    $tree = Tree::where('user', Auth::user()->id)->where('status', 0)->get();
    $data = [
      'balance' => 'Rp ' . number_format($balance, 0, ',', '.'),
      'admin' => $this->adminData(),
      'data' => $tree,
      'nominal' => $this->nominal_tree
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
      $user->image = $request->root() . '/images' . '/' . $imageName;
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
      $user->identity_card_image = $request->root() . '/img/ktp' . '/' . $imageName;
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
      $user->identity_card_image_salve = $request->root() . 'img/ktp/user/' . $imageName;
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
    if ($request->description_address) {
      $this->validate($request, [
        'address' => 'required|string|min:10',
      ]);
      if ($user !== null) {
        $user->address = $request->address;
      }
    }
    $user->save();
    return response()->json(['response' => 'Data telah di update'], 200);
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
    $limit = Ledger::where('user', Auth::user()->id)->sum('credit') - Ledger::where('user', Auth::user()->id)->sum('debit');
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
    return response()->json($data, 422);
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
    ]);

    $order = new Order();
    $order->user = Auth::user()->id;
    $order->total = $request->total;
    $order->code = random_int(99, 999);
    $order->status = 0;
    $order->save();

    $data = [
      'response' => 'Stup Anda sedang di proses oleh admin',
      'admin' => $this->adminData(),
      'total' => ($order->total * $this->nominal_tree) + $order->code,
    ];

    return response()->json($data, 200);
  }
}
