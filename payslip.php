<?php
    session_start();
    echo $_SESSION['emp_number']. "<br>";
    echo $_SESSION['dep_number']. "<br>";
    echo $_SESSION['lname']. "<br>";
    echo $_SESSION['fname']. "<br>";
    echo $_SESSION['mname']. "<br>";
    echo $_SESSION['bday']. "<br>";
    echo $_SESSION['civilstat']. "<br>";
    echo $_SESSION['sal']. "<br>";
    echo "<br> <br>";

    echo 'Deductions: ' . "<br>";
    echo 'philhealth: ' . $_SESSION['philhealth'] . "<br>";
    echo 'sss: ' . $_SESSION['sss']. "<br>";
    echo 'pagibig: ' . $_SESSION['pagibig']. "<br>";
    echo 'tax: ' . $_SESSION['tax']. "<br>";
?>
