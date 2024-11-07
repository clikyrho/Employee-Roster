<?php

require_once 'app/Person.php';
require_once 'app/Employee.php';
require_once 'app/CommissionEmployee.php';
require_once 'app/HourlyEmployee.php';
require_once 'app/PieceWorker.php';
require_once 'app/EmployeeRoster.php';
require_once 'app/Main.php';

$main = new Main();
$main->main();