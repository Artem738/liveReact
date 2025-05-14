@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow border rounded">
        <h2 class="text-2xl font-bold mb-4">Booking form</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 text-sm rounded p-3">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="time" value="{{ $time }}">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Book Appointment
                </button>
            </div>
        </form>
    </div>
@endsection
