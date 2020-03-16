<?php

namespace App\View\Components;

use App\Model\Tree;
use App\User;
use Illuminate\View\Component;
use Illuminate\View\View;

class BackEndSidebar extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return View|string
   */
  public function render()
  {
    $tree = Tree::where('status', 0)->count();
    $users = User::where('status', 1)->whereNotNull('identity_card_image')->whereNotNull('identity_card_image_salve')->count();

    $data = [
      'tree' => $tree,
      'users' => $users
    ];
    return view('components.back-end-sidebar', $data);
  }
}
