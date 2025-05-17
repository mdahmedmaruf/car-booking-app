<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::with(['user','car'])->paginate(10);
        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only customers listed
        $customers = User::where('role', 'customer')->orderBy('name')->get();
        // Only available cars
        $cars      = Car::where('availability', true)->orderBy('name')->get();

        return view('admin.rentals.create', compact('customers','cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'car_id'     => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'total_cost' => 'required|numeric',
            'status'     => 'required|in:ongoing,completed,canceled',
        ]);

        Rental::create($data);

        return redirect()
            ->route('admin.rentals.index')
            ->with('success', 'Rental created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        return view('admin.rentals.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        return view('admin.rentals.edit', compact('rental'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'total_cost' => 'required|numeric',
            'status'     => [
                'required',
                Rule::in(['ongoing', 'completed', 'cancelled']),
            ]
        ]);

        $rental->update($data);
        return redirect()->route('admin.rentals.index')
            ->with('success','Rental updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('admin.rentals.index')
            ->with('success','Rental canceled.');
    }
}
