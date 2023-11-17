<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    function index()
    {
        $properties = Property::where('is_available', 1)->where('is_verified', true)->get(); // Fetch all property records
        return view('home.home', ['properties' => $properties]);
    }
    public function redirect()
    {
        if (Auth::id()) {
            # code...
            if (Auth::user()->user_type == 0) {
                # code...
                $properties = Property::where('is_available', 1)->where('is_verified', true)->get(); // Fetch all property records
                return view('home.home', ['properties' => $properties]);
            } else if (Auth::user()->user_type == 1 || Auth::user()->user_type == 2) {
                # code...
                return view('admin.dashboard');
            } else {
                # code...
                abort(404);
            }
        } else {
            # code...
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    function about()
    {
        return view('home.components.about');
    }
    function contact()
    {
        return view('home.components.contacts');
    }
}
