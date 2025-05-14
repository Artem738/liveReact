<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Appointment;

class CalendarBook extends Component
{
    public int $month;
    public int $year;

    public ?string $selectedDate = null;
    public array $occupiedTimes = [];

    protected int $maxMonthsAhead = 3;

    public function selectDay(int $day): void
    {
        $this->selectedDate = Carbon::create($this->year, $this->month, $day)->toDateString();

        $this->occupiedTimes = Appointment::where('date', $this->selectedDate)
            ->pluck('time')
            ->toArray();
    }

    public function mount(): void
    {
        $now = now();
        $this->month = $now->month;
        $this->year = $now->year;

        // защита, если компонент вызывается с сохранённым состоянием
        if (
            $this->year > $now->copy()->addMonths($this->maxMonthsAhead)->year ||
            ($this->year === $now->copy()->addMonths($this->maxMonthsAhead)->year &&
                $this->month > $now->copy()->addMonths($this->maxMonthsAhead)->month)
        ) {
            $this->month = $now->month;
            $this->year = $now->year;

            session()->flash('calendar_limit', 'The selected month is too far in the future.');
        }
    }


    public function goToNextMonth(): void
    {
        $max = now()->copy()->addMonths($this->maxMonthsAhead);

        $nextMonth = $this->month === 12 ? 1 : $this->month + 1;
        $nextYear = $this->month === 12 ? $this->year + 1 : $this->year;

        // не пускаем, если превышает лимит
        if ($nextYear > $max->year || ($nextYear === $max->year && $nextMonth > $max->month)) {
            session()->flash('calendar_limit', 'You can only book up to 3 months ahead.');
            return;
        }

        $this->month = $nextMonth;
        $this->year = $nextYear;
    }


    public function goToPreviousMonth(): void
    {
        // Запрещаем уход в прошлое
        $now = now();
        if ($this->year > $now->year || ($this->year === $now->year && $this->month > $now->month)) {
            if ($this->month === 1) {
                $this->month = 12;
                $this->year--;
            } else {
                $this->month--;
            }
        }
    }




    public function resetSelection(): void
    {
        $this->selectedDate = null;
        $this->occupiedTimes = [];
    }

    public function render()
    {
        $carbon = Carbon::create($this->year, $this->month, 1);
        $daysInMonth = $carbon->daysInMonth;
        $startOfMonth = $carbon->startOfMonth()->dayOfWeekIso;

        $appointments = Appointment::whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->get()
            ->groupBy('date')
            ->map(fn($group) => $group->pluck('time')->toArray())
            ->toArray();

        return view('livewire.calendar.calendar-book', [
            'daysInMonth' => $daysInMonth,
            'startOfMonth' => $startOfMonth,
            'mockedAppointments' => $appointments,
        ]);
    }
}
