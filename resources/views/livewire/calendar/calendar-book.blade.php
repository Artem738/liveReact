<div class="m-4">
    @php
        $times = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
    @endphp
    @if (!$selectedDate)

        @if (session()->has('calendar_limit'))
            <div class="mb-4 p-2 bg-yellow-100 border border-yellow-300 text-yellow-700 text-sm rounded">
                {{ session('calendar_limit') }}
            </div>
        @endif
        {{-- Календарь --}}
        @php
            $today = \Carbon\Carbon::today();
            $currentMonth = \Carbon\Carbon::create($year, $month);
            $startDay = $today->month === $month && $today->year === $year ? $today->day : 1;
        @endphp



        {{-- Навигация --}}
        <div class="flex justify-between items-center mb-4">
            <button wire:click="goToPreviousMonth" class="text-sm text-gray-600 hover:text-black disabled:opacity-30"
                @disabled($month == $today->month && $year == $today->year)>
                ← Previous
            </button>

            <h2 class="text-lg font-semibold">
                {{ $currentMonth->format('F Y') }}
            </h2>

            <button wire:click="goToNextMonth" class="text-sm text-gray-600 hover:text-black">
                Next →
            </button>
        </div>

        {{-- Сетка дней --}}
        <div class="grid grid-cols-3 sm:grid-cols-7 gap-2 text-center">
            {{-- Смещение в начале месяца --}}
            @php
                $offset = \Carbon\Carbon::create($year, $month, $startDay)->startOfMonth()->dayOfWeekIso;
            @endphp

            @for ($i = 1; $i < $offset; $i++)
                <div class="invisible"></div>
            @endfor

            {{-- Дни месяца --}}
            @for ($i = $startDay; $i <= $daysInMonth; $i++)
                @php
                    $carbonDate = \Carbon\Carbon::create($year, $month, $i);
                    $date = $carbonDate->toDateString();
                    $weekdayName = $carbonDate->format('D');
                    $isWeekend = $carbonDate->isSaturday() || $carbonDate->isSunday();
                    $busy = $mockedAppointments[$date] ?? [];
                @endphp

                <div wire:click="selectDay({{ $i }})"
                    class="p-2 border rounded hover:bg-blue-50 cursor-pointer text-left text-xs space-y-1 bg-white shadow-sm">
                    <div class="text-center font-bold text-sm {{ $isWeekend ? 'text-red-500' : 'text-gray-800' }}">
                        {{ $i }}
                        <span class="block text-xs font-normal">{{ $weekdayName }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-1 mt-1">
                        @foreach ($times as $time)
                            <div class="{{ in_array($time, $busy) ? 'text-red-500' : 'text-green-500' }} truncate">
                                • {{ $time }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endfor
        </div>
    @else
        {{-- Выбор часов --}}
        @php $parsedDate = \Carbon\Carbon::parse($selectedDate); @endphp

        <div class="mt-6 p-4 border rounded shadow bg-white">
            <h3 class="text-lg font-bold mb-2">
                {{ $parsedDate->format('l, F j, Y') }}
            </h3>

            <p class="text-sm text-gray-600 mb-2">Pick your time:</p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                @foreach (array_slice($times, 0, 8) as $time)
                    @if (in_array($time, $occupiedTimes))
                        <div class="py-1 px-2 border rounded bg-gray-200 text-gray-400 cursor-not-allowed">
                            {{ $time }}
                        </div>
                    @else
                        <button class="py-1 px-2 border rounded bg-green-100 hover:bg-green-200">
                            {{ $time }}
                        </button>
                    @endif
                @endforeach
            </div>

            <button wire:click="resetSelection" class="mt-4 text-xl underline text-gray-500 hover:text-gray-700">
                ← Return to calendar
            </button>
        </div>
    @endif
</div>
