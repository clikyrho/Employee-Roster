<?php 
    class EmployeeRoster {
        private array $roster;
        private int $size;
    
        public function __construct(int $size) {
            $this->size = $size;
            $this->roster = array_fill(0, $size, null);  // Initialize array to hold employee objects
        }
    
        // Add an employee to the roster
        public function add(Employee $employee): void {
            foreach ($this->roster as $index => $existingEmployee) {
                if ($existingEmployee === null) {
                    $this->roster[$index] = $employee;  // Place the new employee in the first available slot
                    echo "Employee added at position " . ($index + 1) . "\n";
                    return;
                }
            }
            echo "Roster is full! Cannot add more employees.\n";
        }
    
        // Remove an employee from the roster
        public function remove(int $employeeNumber): void {
            $index = $employeeNumber - 1;
            if (isset($this->roster[$index]) && $this->roster[$index] !== null) {
                echo "Removing Employee at position " . $employeeNumber . ":\n";
                echo $this->roster[$index] . "\n";  // Automatically calls __toString() method for display
                $this->roster[$index] = null;  // Set the position to null after removal
                echo "Employee removed successfully.\n";
            } else {
                echo "Invalid employee number or employee already removed.\n";
            }
        }
    
        // Count the number of employees in the roster
        public function count(): int {
            return count(array_filter($this->roster, fn($employee) => $employee !== null));  // Filters out null slots
        }
    
        // Count Commission Employees
        public function countCE(): int {
            return count(array_filter($this->roster, fn($employee) => $employee instanceof CommissionEmployee));
        }
    
        // Count Hourly Employees
        public function countHE(): int {
            return count(array_filter($this->roster, fn($employee) => $employee instanceof HourlyEmployee));
        }
    
        // Count Piece Workers
        public function countPE(): int {
            return count(array_filter($this->roster, fn($employee) => $employee instanceof PieceWorker));
        }
    
        // Display all employees in the roster
        public function display(): void {
            echo "*** List of Employees on the Current Roster ***\n";
            foreach ($this->roster as $index => $employee) {
                if ($employee !== null) {
                    echo "Employee #" . ($index + 1) . "\n";
                    echo "Name       : " . $employee->getName() . "\n";  // Use getter
                    echo "Address    : " . $employee->getAddress() . "\n";  // Use getter
                    echo "Age        : " . $employee->getAge() . "\n";  // Use getter
                    echo "Company    : " . $employee->getCompanyName() . "\n";  // Use getter
                    echo "Type       : " . (get_class($employee) === 'CommissionEmployee' ? 'Commission' : (get_class($employee) === 'HourlyEmployee' ? 'Hourly' : 'Piece Worker')) . "\n";
                    echo "------------------------------\n";
                } else {
                    echo "Employee #" . ($index + 1) . ": Empty Slot\n";
                }
            }
        }
    
        // Display only Commission Employees
        public function displayCE(): void {
            echo "*** Commission Employees ***\n";
            foreach ($this->roster as $employee) {
                if ($employee instanceof CommissionEmployee) {
                    echo $employee . "\n";  // Automatically calls __toString()
                }
            }
        }
    
        // Display only Hourly Employees
        public function displayHE(): void {
            echo "*** Hourly Employees ***\n";
            foreach ($this->roster as $employee) {
                if ($employee instanceof HourlyEmployee) {
                    echo $employee . "\n";  // Automatically calls __toString()
                }
            }
        }
    
        // Display only Piece Workers
        public function displayPE(): void {
            echo "*** Piece Workers ***\n";
            foreach ($this->roster as $employee) {
                if ($employee instanceof PieceWorker) {
                    echo $employee . "\n";  // Automatically calls __toString()
                }
            }
        }
    
        // Display payroll information for all employees
        public function payroll(): void {
            echo "*** Payroll for All Employees ***\n";
            foreach ($this->roster as $employee) {
                if ($employee !== null) {
                    echo $employee . " - Earnings: $" . $employee->earnings() . "\n";  // Calls earnings method and __toString()
                }
            }
        }
    }
    
?>