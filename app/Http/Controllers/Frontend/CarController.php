<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // List available cars, with optional filters
    public function index(Request $request)
    {
        $query = Car::where('availability', true);

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        if ($request->filled('car_type')) {
            $query->where('car_type', $request->car_type);
        }
        if ($request->filled('min_price')) {
            $query->where('daily_rent_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('daily_rent_price', '<=', $request->max_price);
        }

        $cars = $query->paginate(10)->withQueryString();

        // For the filter dropdowns
        $brands = Car::select('brand')->distinct()->pluck('brand');
        $types  = Car::select('car_type')->distinct()->pluck('car_type');

        return view('frontend.cars.index', compact('cars','brands','types'));
    }

    // Show details for one car
    public function show(Car $car)
    {
        return view('frontend.cars.show', compact('car'));
    }
}
