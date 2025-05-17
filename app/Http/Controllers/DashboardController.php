<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Car;
//use App\Models\Rental;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class DashboardController extends Controller
//{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
//
//    public function index()
//    {
//        $user = Auth::user();
//
//        if ($user->isAdmin()) {
//            return view('dashboard', [
//                'totalCars' => Car::count(),
//                'availableCars' => Car::where('availability', true)->count(),
//                'totalRentals' => Rental::count(),
//                'totalEarnings' => Rental::sum('total_cost'),
//                'customersCount' => User::where('role', 'customer')->count(),
//                'recentBookings' => Rental::with(['user', 'car'])
//                    ->latest()
//                    ->take(10)
//                    ->get(),
//            ]);
//        }
//        // customer view
//        return view('dashboard', [
//            'myBookings' => $user->rentals()->with('car')->paginate(10),
//        ]);
//    }
//
//
//}


namespace App\Http\Controllers;

// 1. Import the base Controller
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller   // ← extends Controller!
{


    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $totalCars       = Car::count();
            $availableCars   = Car::where('availability', true)->count();
            $totalRentals    = Rental::count();
            $pendingRentals  = Rental::where('status', 'ongoing')->count();              // ← only “ongoing”
            $totalEarnings   = Rental::where('status', 'completed')->sum('total_cost');   // ← only “completed”
            $customersCount  = User::where('role', 'customer')->count();
            $recentBookings  = Rental::with(['user','car'])->latest()->take(10)->get();

            return view('dashboard', compact(
                'totalCars',
                'availableCars',
                'totalRentals',
                'pendingRentals',
                'totalEarnings',
                'customersCount',
                'recentBookings'
            ));
        }

        // customer view
        return view('dashboard', [
            'myBookings' => $user->rentals()->with('car')->paginate(10),
        ]);
    }
}
