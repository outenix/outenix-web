<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class AuthsLogoutController extends Controller
{
    /**
     * Proses logout
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        if ($request->isMethod('get')) {
            abort(404);
        }

        $user = Auth::user();
        
        Auth::logout();
        Session::flush();

        cookie()->queue(Cookie::forget('cookie_token'));

        foreach ($request->cookies as $key => $value) {
            cookie()->queue(Cookie::forget($key));
        }

        return redirect()->route('login');
    }
}
