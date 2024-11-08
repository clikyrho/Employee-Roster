<?php
// CommissionEmployee.php
require_once 'Employee.php';

class CommissionEmployee extends Employee {
    private float $regularSalary;
    private int $itemSold;
    private float $commissionRate;

    public function __construct(string $name, string $address, int $age, string $companyName, float $regularSalary, int $itemSold, float $commissionRate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->regularSalary = $regularSalary;
        $this->itemSold = $itemSold;
        $this->commissionRate = $commissionRate/100;
    }
    public function getRegularSalary(): float {
        return $this->regularSalary;
    }
    
    public function getItemSold(): int {
        return $this->itemSold;
    }
    
    public function getCommissionRate(): float {
        return $this->commissionRate;
    }
    

    public function earnings(): float {
        return $this->regularSalary + ($this->itemSold * $this->commissionRate);
    }

    public function __toString(): string {
        return parent::__toString() . ", Regular Salary: $this->regularSalary, Items Sold: $this->itemSold, Commission Rate: $this->commissionRate";
    }
}
?>