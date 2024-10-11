<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CookieController extends Controller
{
  public function acceptCookie(Request $request)
    {
        $request->session()->put('cookie_consent', true);

        return redirect()->back();
    }

}
