@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-16 text-center p-6 bg-white border shadow rounded">
        <h1 class="text-3xl font-bold text-green-600 mb-4">🎉 Thank you!</h1>

        @if (session('success_message'))
            <p class="text-lg text-gray-700 mb-6">
                {{ session('success_message') }}
            </p>
        @endif

        <p class="text-sm text-gray-500">
            We look forward to seeing you. You will be contacted if additional confirmation is needed.
        </p>

        <a href="{{ route('home') }}"
           class="mt-6 inline-block text-blue-600 hover:underline text-sm">
            ← Back to calendar
        </a>
    </div>
@endsection
