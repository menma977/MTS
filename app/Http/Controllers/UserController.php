<?php

namespace App\Http\Controllers;

use App\Model\Binary;
use App\Model\Code;
use App\Model\Ledger;
use App\Model\Tree;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
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
    $user = User::where('role', '!=', 3)->get();
    $user->map(function ($item) {
      $binary = Binary::where('user', $item->id)->first();
      if ($item->role == 1) {
        $item->sponsor = User::find(1);
      } else {
        $item->sponsor = User::find($binary->sponsor);
      }

      return $item;
    });

    $data = [
      'users' => $user
    ];

    return view('user.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    return view('user.create');
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
    $user->bank = $request->bank;
    $user->pin_bank = $request->pin_bank;
    $user->phone = $request->phone;
    $user->id_identity_card = $request->id_identity_card;
    $user->identity_card_image = $request->identity_card_image;
    $user->identity_card_image_salve = $request->identity_card_image_salve;
    $user->image = $request->image;
    $user->address = $request->address;
    $user->save();

    $binary = new Binary();
    $binary->sponsor = Auth::user()->id;
    $binary->user = $user->id;
    $binary->save();

    return redirect()->back();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param $id
   * @return Factory|View
   */
  public function editPassword($id)
  {
    $user = User::find($id);

    $data = [
      'user' => $user
    ];

    return view('user.edit', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function updatePassword(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required|string',
      'username' => 'required|string|min:6',
      'email' => 'required|email',
      'password' => 'nullable|min:6',
      'id_identity_card' => 'required|numeric',
      'phone' => 'required|numeric|digits_between:10,15',
      'bank' => 'required|string',
      'pin_bank' => 'required|string',
      'address' => 'required',
    ]);

    $user = User::find($id);
    if ($request->password) {
      $user->password = bcrypt($request->password);
    }
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->bank = $request->bank;
    $user->pin_bank = $request->pin_bank;
    $user->phone = $request->phone;
    $user->id_identity_card = $request->id_identity_card;
    $user->identity_card_image = $request->identity_card_image;
    $user->identity_card_image_salve = $request->identity_card_image_salve;
    $user->image = $request->image;
    $user->address = $request->address;
    $user->save();

    return redirect()->route('user.index');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function show($id)
  {
    $id = base64_decode($id);
    $user = User::find($id);
    $binary = Binary::where('user', $user->id)->first();
    if ($user->role == 1) {
      $sponsor = User::find(1);
    } else {
      $sponsor = User::find($binary->sponsor);
    }
    $ledger = Ledger::where('user', $user->id)->get();
    $tree = Tree::where('user', $user->id)->take(100)->orderBy('start', 'desc')->get()->groupBy(function ($item) {
      return Carbon::parse($item->start)->format('Y-m-d');
    });

    $data = [
      'user' => $user,
      'sponsor' => $sponsor,
      'ledger' => $ledger,
      'tree' => $tree,
    ];

    return view('user.show', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param int $id
   * @param $status
   * @return RedirectResponse
   */
  public function update($id, $status): RedirectResponse
  {
    $id = base64_decode($id);
    $status = base64_decode($status);
    $user = User::find($id);
    $user->status = $status;
    if ($status == 1) {
      if ($user->identity_card_image) {
        File::delete('dist/img/ktp/' . $user->identity_card_image);
      }
      if ($user->identity_card_image_salve) {
        File::delete('dist/img/ktp/user/' . $user->identity_card_image_salve);
      }
      $user->identity_card_image = null;
      $user->identity_card_image_salve = null;
    }
    $user->save();

    return redirect()->back();
  }

  /**
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function roleUpdate(Request $request, $id)
  {
    $this->validate($request, [
      'role' => 'required|integer|between:2,4',
    ]);
    $id = base64_decode($id);
    $user = User::find($id);
    $user->role = $request->role;
    $user->save();

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id): RedirectResponse
  {
    $id = base64_decode($id);
    $user = User::find($id);
    if ($user->status == 0) {
      $user->status = 1;
    } else {
      $user->status = 0;
    }
    $user->save();

    return redirect()->back();
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function sendCode(Request $request)
  {
    $this->validate($request, [
      'user' => 'required|exists:users,id',
      'pin' => 'required|integer',
    ]);

    for ($i = 0; $i < $request->pin; $i++) {
      $code = new Code();
      $code->user = $request->user;
      $code->save();
    }

    return redirect()->back();
  }
}
