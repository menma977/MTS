<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BannerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $banner = Banner::find(1);

    $data = [
      'banner' => $banner
    ];
    return view('banner.index', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required'
    ]);

    $banner = Banner::all()->count();
    if ($banner) {
      $banner = Banner::find(1);
      $banner->title = $request->title;
      $banner->description = $request->description;
      $banner->save();
    } else {
      $banner = new Banner();
      $banner->title = $request->title;
      $banner->description = $request->description;
      $banner->save();
    }

    return redirect()->back();
  }

  public function delete()
  {
    $banner = Banner::all()->count();

    if ($banner) {
      $banner = Banner::find(1);
      $banner->title = '';
      $banner->description = '';
      $banner->save();
    }

    return redirect()->back();
  }
}
