<?php
class Main {
    private EmployeeRoster $roster;
    private int $size;
    private bool $repeat;

    public function start() {
        $this->clear();
        $this->repeat = true;

        $this->size = (int)readline("Enter the size of the roster: ");
        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            $this->start();
            return;
        }

        // Initialize the EmployeeRoster
        $this->roster = new EmployeeRoster($this->size);
        echo "Available space in the roster: " . $this->getAvailableSpace() . "\n"; // Display initial available space

        $this->entrance(); // Directly start the menu entrance
    }

    public function entrance() {
        while ($this->repeat) {
            $this->clear();
            $this->menu();

            $choice = (int)readline("Pick from the menu: "); // Updated prompt text

            switch ($choice) {
                case 1:
                    $this->addMenu();
                    break;
                case 2:
                    $this->deleteMenu();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    $this->repeat = false; // Exit the loop
                    echo "Process terminated.\n";
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    break;
            }
        }
    }

    public function menu() {
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";
    }

    public function addMenu() {
        if ($this->roster->count() >= $this->size) {
            echo "Employee roster is full! Cannot add more employees.\n";
            return;
        }

        $name = readline("Enter employee name: ");
        $address = readline("Enter employee address: ");
        $age = (int)readline("Enter employee age: ");
        $companyName = readline("Enter company name: ");

        $this->empType($name, $address, $age, $companyName);
    }

    public function empType($name, $address, $age, $cName) {
        $this->clear();
        
        // Display the options without "Pick from the menu"
        echo "[1] Commission Employee      [2] Hourly Employee      [3] Piece Worker: ";

        // Get input for the employee type
        $type = (int)readline(""); // Read input immediately after the options

        switch ($type) {
            case 1:
                $regularSalary = (float)readline("Enter regular salary: ");
                $itemsSold = (int)readline("Enter items sold: ");
                $commissionRate = (float)readline("Enter commission rate (%): ");
                $employee = new CommissionEmployee($name, $address, $age, $cName, $regularSalary, $itemsSold, $commissionRate);
                $this->roster->add($employee);
                break;
            case 2:
                $hoursWorked = (float)readline("Enter hours worked: ");
                $rate = (float)readline("Enter hourly rate: ");
                $employee = new HourlyEmployee($name, $address, $age, $cName, $hoursWorked, $rate);
                $this->roster->add($employee);
                break;
            case 3:
                $numberItems = (int)readline("Enter number of items: ");
                $wagePerItem = (float)readline("Enter wage per item: ");
                $employee = new PieceWorker($name, $address, $age, $cName, $numberItems, $wagePerItem);
                $this->roster->add($employee);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                $this->empType($name, $address, $age, $cName);
                return;
        }

        $this->checkRosterFull(); // Check if roster is full after adding an employee

        // Add more prompt after employee is added
        $this->addMorePrompt(); // Add the prompt for adding more employees
    }

    public function addMorePrompt() {
        $c = readline("Add more? (y to continue): ");
        
        // Repeat the prompt until the user presses 'y'
        while (strtolower($c) !== 'y') {
            echo "You must press 'y' to continue adding more employees.\n";
            $c = readline("Add more? (y to continue): ");
        }

        // If user presses 'y', return to the Employee Roster Menu
        if ($this->roster->count() < $this->size) {
            echo "Returning to Employee Roster Menu...\n";
            $this->entrance(); // Go back to the main menu to add more employees
        } else {
            echo "Roster is full. Returning to the main menu...\n";
            $this->entrance(); // Return to main menu
        }
    }

    public function deleteMenu() {
        $this->clear();
        echo "*** List of Employees on the Current Roster ***\n";
        $this->roster->display(); // Display current employees
        $employeeNumber = (int)readline("Enter the employee number to delete (0 to cancel): ");

        if ($employeeNumber > 0 && $employeeNumber <= $this->size) {
            $this->roster->remove($employeeNumber);
            echo "Employee removed successfully.\n";
        } else if ($employeeNumber !== 0) {
            echo "Invalid employee number.\n";
        }
    }

    public function otherMenu() {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[3] Payroll\n";
        echo "[0] Return\n";
        
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->displayMenu(); // Call display menu options
                break;
            case 2:
                $this->countMenu(); // Call count menu options
                break;
            case 3:
                $this->roster->payroll(); // Display payroll information
                break;
            case 0:
                return; // Exit to the main menu
            default:
                echo "Invalid input. Please try again.\n";
                break;
        }
    }

    public function displayMenu() {
        echo "[1] Display All Employees\n";
        echo "[2] Display Commission Employees\n";
        echo "[3] Display Hourly Employees\n";
        echo "[4] Display Piece Workers\n";
        echo "[0] Return\n";

        $choice = (int)readline("Select an option: ");

        switch ($choice) {
            case 1:
                $this->roster->display(); // Display all employees
                break;
            case 2:
                $this->roster->displayCE(); // Display commission employees
                break;
            case 3:
                $this->roster->displayHE(); // Display hourly employees
                break;
            case 4:
                $this->roster->displayPE(); // Display piece workers
                break;
            case 0:
                return; // Return to the main menu
            default:
                echo "Invalid input. Please try again.\n";
                break;
        }
    }

    public function countMenu() {
        echo "[1] Count All Employees\n";
        echo "[2] Count Commission Employees\n";
        echo "[3] Count Hourly Employees\n";
        echo "[4] Count Piece Workers\n";
        echo "[0] Return\n";

        $choice = (int)readline("Select an option: ");

        switch ($choice) {
            case 1:
                echo "Total Employees: " . $this->roster->count() . "\n";
                break;
            case 2:
                echo "Commission Employees: " . $this->roster->countCE() . "\n";
                break;
            case 3:
                echo "Hourly Employees: " . $this->roster->countHE() . "\n";
                break;
            case 4:
                echo "Piece Workers: " . $this->roster->countPE() . "\n";
                break;
            case 0:
                return; // Return to the main menu
            default:
                echo "Invalid input. Please try again.\n";
                break;
        }

        // Adding "Press Enter to continue" after the count options
        readline("Press Enter key to continue...");
    }

    public function clear() {
        system('cls'); // Use 'clear' for Unix, 'cls' for Windows
    }

    private function checkRosterFull() {
        if ($this->roster->count() >= $this->size) {
            echo "Roster is full!\n";
        }
    }

    private function getAvailableSpace(): int {
        return $this->size - $this->roster->count();
    }
}

// To start the application
$main = new Main();
$main->start();
?>
