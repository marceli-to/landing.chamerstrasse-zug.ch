<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{

  public function landing($state = NULL)
  { 
    return view('frontend.pages.landing', ['state' => $state]);
  }

  public function privacy()
  {
    return view('frontend.pages.privacy');
  }

  public function imprint()
  {
    return view('frontend.pages.imprint');
  }
}
