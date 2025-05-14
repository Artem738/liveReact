@extends('layouts.app')

@section('content')
    <div class="text-center mt-10">
        <h1 class="text-2xl font-bold">Оберіть час прийому</h1>

        @livewire('calendar.calendar-book')
        
    </div>
@endsection
