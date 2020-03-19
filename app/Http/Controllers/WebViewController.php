<?php

namespace App\Http\Controllers;

use App\Model\Tree;
use App\Model\TreeImage;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class WebViewController extends Controller
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
}
