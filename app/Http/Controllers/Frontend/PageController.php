<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home page
    public function home()
    {
        $cars = Car::where('availability', true)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home', compact('cars'));
    }

    // About page
    public function about()
    {
        return view('frontend.about');
    }

    // Contact page
    public function contact()
    {
        return view('frontend.contact');
    }

}
