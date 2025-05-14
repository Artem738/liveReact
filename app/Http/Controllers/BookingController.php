<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointment;

class BookingController extends Controller
{
    public function form(Request $request)
    {
        $date = $request->query('date');
        $time = $request->query('time');

        return view('booking.form', compact('date', 'time'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'time' => ['required', 'string', 'regex:/^\d{2}:\d{2}$/'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);

        // Проверка, что слот уже занят
        if (Appointment::where('date', $data['date'])->where('time', $data['time'])->exists()) {
            return back()->withErrors(['time' => 'This slot has already been booked.'])->withInput();
        }

        Appointment::create($data);

        return redirect()->route('booking.thankyou')
    ->with('success_message', 'Your appointment was successfully booked.');
    }
}
