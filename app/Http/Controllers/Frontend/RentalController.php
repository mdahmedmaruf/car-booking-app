<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
//    public function __construct()
//    {
//        // Only logged-in customers may book or view their rentals
//        $this->middleware('auth');
//    }

    // Show current & past bookings
    public function index()
    {
        $rentals = Auth::user()
            ->rentals()
            ->with('car')
            ->paginate(10);

        return view('frontend.rentals.index', compact('rentals'));
    }

    // Handle a new booking request
    public function store(Request $request)
    {
        $data = $request->validate([
            'car_id'     => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        // Check for overlapping rentals
        $overlap = Rental::where('car_id', $data['car_id'])
            ->where(function($q) use ($data) {
                $q->whereBetween('start_date', [$data['start_date'], $data['end_date']])
                    ->orWhereBetween('end_date',   [$data['start_date'], $data['end_date']])
                    ->orWhere(function($q2) use ($data) {
                        $q2->where('start_date', '<=', $data['start_date'])
                            ->where('end_date',   '>=', $data['end_date']);
                    });
            })->exists();

        if ($overlap) {
            return back()->withErrors('This car is not available for the selected dates.');
        }

        $car = Car::findOrFail($data['car_id']);

        // Calculate number of days inclusive
        $days = Carbon::parse($data['start_date'])
                ->diffInDays(Carbon::parse($data['end_date'])) + 1;

        $totalCost = $car->daily_rent_price * $days;

        Rental::create([
            'user_id'    => Auth::id(),
            'car_id'     => $data['car_id'],
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'],
            'total_cost' => $totalCost,
        ]);

        return redirect()->route('rentals.index')
            ->with('success', 'Your booking has been confirmed!');
    }

    // Cancel a booking (only before it starts)
    public function destroy(Rental $rental)
    {
        if ($rental->user_id !== Auth::id()) {
            abort(403);
        }

        if (Carbon::parse($rental->start_date)->lte(now())) {
            return back()->withErrors('You cannot cancel a booking that has already started.');
        }

        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Your booking has been canceled.');
    }
}
