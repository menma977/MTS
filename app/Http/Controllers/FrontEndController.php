<?php

namespace App\Http\Controllers;

use App\Model\Tree;
use App\User;
use Illuminate\Support\Facades\File;

class FrontEndController extends Controller
{
  public function index()
  {
    $user = User::all();
    $tree = Tree::whereNull('user')->get()->count();
    $online = 0;

    $imageName = array();
    $imagePartner = array();

    $startLimit = 0;
    $limit = 50;
    $files = File::files('gallery');
    foreach ($files as $id => $value) {
      if ($startLimit <= $limit) {
        $file = pathinfo($value);
        $imageName[$id] = $file['basename'];
      }
      $startLimit++;
    }

    foreach ($user as $item) {
      foreach ($item->tokens as $subItem) {
        if ($subItem->revoked == 0) {
          ++$online;
        } else {
          --$online;
        }
      }
      if ($item->isOnline()) {
        ++$online;
      }
    }

    $data = [
      'user' => $user->count(),
      'online' => $online,
      'tree' => $tree,
      'imageName' => $imageName,
      'imagePartner' => $imagePartner,
    ];
    return view('welcome', $data);
  }
}
