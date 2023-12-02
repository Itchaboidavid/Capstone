<?php

trait DateHelpers
{
    public function getMonthNumberDays()
    {
        return (int)  $this->format("t");
    }

    public function getCurrentDayNumber()
    {
        return (int) $this->format("j");
    }

    public function getMonthNumber()
    {
        return (int) $this->format("n");
    }

    public function getYear()
    {
        return (int) $this->format("Y");
    }

    public function getMonthName()
    {
        return $this->format("M");
    }
}

class CurrentDate extends DateTimeImmutable
{
    use DateHelpers;
    public function __construct()
    {
        parent::__construct();
    }
}

class CalendarDate extends DateTime
{
    use DateHelpers;
    public function __construct()
    {
        parent::__construct();
        $this->modify('first day of this month');
    }

    public function getMonthStartDayOfWeek()
    {
        return (int) $this->format('N');
    }
}

class Calendar
{
    protected $currentDate;
    protected $calendarDate;

    protected $dayLabels = [
        'M', 'T', 'W', 'TH', 'F', 'M', 'T', 'W', 'TH', 'F', 'M', 'T', 'W', 'TH', 'F', 'M', 'T', 'W', 'TH', 'F', 'M', 'T', 'W', 'TH', 'F',
    ];

    protected $monthLabels = [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December'
    ];

    protected $sundayFirst = true;
    protected $weeks = [];

    public function __construct(CurrentDate $currentDate, CalendarDate $calendarDate)
    {
        $this->currentDate = $currentDate;
        $this->calendarDate = clone $calendarDate;
        $this->calendarDate->modify('first day of this month');
    }

    public function getDayLabels()
    {
        return $this->dayLabels;
    }

    public function getMonthLabel()
    {
        return $this->monthLabels;
    }

    public function setSundayFirst($bool)
    {
        $this->sundayFirst = $bool;
        if (!$this->sundayFirst) {
            array_push($this->dayLabels, array_shift($this->dayLabels));
        }
    }

    public function setMonthYear($year, $month)
    {
        $this->calendarDate->setDate($year, $month, 1);
    }

    public function getCalendarMonth()
    {
        return $this->calendarDate->getMonthName();
    }

    protected function getMonthFirstDay()
    {
        $day = $this->calendarDate->getMonthStartDayOfWeek();

        if ($this->sundayFirst) {
            if ($day > 6) {
                return ($day - 7);
            }
            if ($day >= 6) {
                return ($day - 7);
            }
            if ($day < 6) {
                return ($day);
            }
            if ($day == 6) {
                return ($day);
            }
        }
        return $day;
    }

    public function isCurrentDate($dayNumber)
    {
        if (
            $this->calendarDate->getYear() === $this->currentDate->getYear() &&
            $this->calendarDate->getMonthName() === $this->currentDate->getMonthNumber() &&
            $this->currentDate->getCurrentDayNumber() === $dayNumber
        ) {
            return true;
        }
        return false;
    }

    public function getWeeks()
    {
        return $this->weeks;
    }



    public function create()
    {
        $days = [];

        // Calculate the number of empty cells needed before the first day
        $emptyCellsBeforeFirstDay = $this->getMonthFirstDay() - 1;

        // Calculate the number of days to include in the calendar (excluding weekends)
        $totalCells = 25;
        $currentDayNumber = 1;

        // Calculate the actual number of days in the current month
        $daysInCurrentMonth = $this->calendarDate->getMonthNumberDays();

        // Fill in empty cells before the first day
        for ($x = 0; $x < $emptyCellsBeforeFirstDay; $x++) {
            $days[] = ['currentMonth' => false, 'dayNumber' => ''];
        }

        // Add current month's weekdays, excluding weekends
        while (count($days) < $totalCells && $currentDayNumber <= $daysInCurrentMonth) {
            $currentDay = $this->calendarDate->setDate(
                $this->calendarDate->getYear(),
                $this->calendarDate->getMonthNumber(),
                $currentDayNumber
            );

            $dayOfWeek = (int)$currentDay->format('N'); // 1 (Monday) to 7 (Sunday)

            // Check if the day is not a weekend (Monday to Friday) and add it to the calendar
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                $days[] = ['currentMonth' => true, 'dayNumber' => $currentDayNumber];
            }

            $currentDayNumber++;
        }

        // Fill in any remaining empty cells
        $emptyCellsAfterLastDay = $totalCells - count($days);
        for ($x = 0; $x < $emptyCellsAfterLastDay; $x++) {
            $days[] = ['currentMonth' => false, 'dayNumber' => ''];
        }

        // Create weeks from the days
        $this->weeks = array_chunk($days, 35);
    }
}
