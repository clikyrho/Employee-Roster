<?php

class HourlyEmployee extends Employee {
    private $hoursWorked;
    private $hourlyRate;

    public function __construct($hoursWorked, $hourlyRate) {
        $this->hoursWorked = $hoursWorked;
        $this->hourlyRate = $hourlyRate;
    }
}