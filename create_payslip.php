<?php
    session_start();

    include_once 'config.php';

    if(isset($_POST['btn-createpayslip']))
    {
        $employee_num = mysql_real_escape_string($_POST['employee_num']);

        $sql = 'SELECT * FROM Employee WHERE employee_number = ' . $employee_num;
        $retval = mysql_query($sql);
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());
        }

        $row = mysql_fetch_assoc($retval);

        $_SESSION['emp_number'] = $row['employee_number'];
        $_SESSION['dep_number'] = $row['department_number'];
        $_SESSION['lname'] = $row['lastname'];
        $_SESSION['fname'] = $row['firstname'];
        $_SESSION['mname'] = $row['middlename'];
        $_SESSION['bday'] = $row['birthdate'];
        $_SESSION['civilstat'] = $row['civilstat'];
        $_SESSION['sal'] = $row['salary'];

        //compute taxable deductions

        //SSS
        $sql = 'SELECT * FROM sssTable WHERE ' . $_SESSION['sal'] . ' <= range_max AND ' . $_SESSION['sal'] . '>= range_min';

        $retval = mysql_query($sql);
        $num_rows = mysql_num_rows($retval);
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());
        }

        $row = mysql_fetch_assoc($retval);

        if ($num_rows == 1) {
            $sss_min = $row['range_min'];
            $sss_max = $row['range_max'];
            $_SESSION['sss'] = $row['employee_share'];

            echo 'SSS: ';
            echo $sss_min. "<br>";
            echo $sss_max. "<br>";
            echo $_SESSION['sss']. "<br>";
        }
        else {
            echo 'Error: Multiple rows obtained. Check SSS Table Values.';
        }

        //PhilHealth
        $sql = 'SELECT * FROM PhilHealthTable WHERE ' . $_SESSION['sal'] . ' <= range_max AND ' . $_SESSION['sal'] . '>= range_min';

        $retval = mysql_query($sql);
        $num_rows = mysql_num_rows($retval);
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());
        }

        $row = mysql_fetch_assoc($retval);

        if ($num_rows == 1) {
            $phealth_min = $row['range_min'];
            $phealth_max = $row['range_max'];
            $_SESSION['philhealth'] = $row['employee_share'];

            echo 'PhilHealth: ';
            echo $phealth_min. "<br>";
            echo $phealth_max. "<br>";
            echo $_SESSION['philhealth']. "<br>";
        }
        else {
            echo 'Error: Multiple rows obtained. Check PhilHealth Table Values.';
        }

        //PagIbig
        if ($_SESSION['sal'] < 5000) {
            $_SESSION['pagibig'] = $_SESSION['sal'] * 0.02;
        }
        else {
            $_SESSION['pagibig'] = 100;
        }

        echo 'PAGIBIG: ' . $_SESSION['pagibig']. "<br>";

        $_SESSION['taxableincome'] = $_SESSION['sal'] - ($_SESSION['sss'] + $_SESSION['philhealth'] + $_SESSION['pagibig']);

        echo 'Taxable Income = ' . $_SESSION['taxableincome'];

        //Tax Deduction
        $sql = 'SELECT * FROM TaxTable WHERE civil_stat ="' . $_SESSION['civilstat'] . '"';

        $retval = mysql_query($sql);
        $num_rows = mysql_num_rows($retval);
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());
        }

        $row = mysql_fetch_assoc($retval);

        echo $row['civil_stat'] . '  ' . $row['range1'] . '  ' . $row['range2'] . '  ' . $row['range3'] . '  ' . $row['range4'] . '  ' . $row['range5'] . '  ' . $row['range6'] . '  ' . $row['range7'] . '  ' . $row['range8'];

        $currRange='range8';

        if  ($_SESSION['taxableincome'] < $row['range8']) {$currRange = 'range7';};
        if  ($_SESSION['taxableincome'] < $row['range7']) {$currRange = 'range6';};
        if  ($_SESSION['taxableincome'] < $row['range6']) {$currRange = 'range5';};
        if  ($_SESSION['taxableincome'] < $row['range5']) {$currRange = 'range4';};
        if  ($_SESSION['taxableincome'] < $row['range4']) {$currRange = 'range3';};
        if  ($_SESSION['taxableincome'] < $row['range3']) {$currRange = 'range2';};
        if  ($_SESSION['taxableincome'] < $row['range2']) {$currRange = 'range1';};
        echo $currRange;

        $taxCeiling=$row[$currRange];
        echo 'taxceiling' . $taxCeiling;


        $sql = 'SELECT * FROM TaxPercentDeduction WHERE rangetype ="' . $currRange . '"';

        $retval = mysql_query($sql);
        $num_rows = mysql_num_rows($retval);
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());
        }

        $row = mysql_fetch_assoc($retval);

        echo $row['rangetype'] . '  ' . $row['taxamount'] . '  ' . $row['additionalpercentage'];

        $_SESSION['tax'] = $row['taxamount'] + (($_SESSION['taxableincome'] - $taxCeiling) * $row['additionalpercentage']);

        echo 'Total tax due is: ' . $_SESSION['tax'];

        header("Location: payslip.php");
        echo "Fetched data successfully\n";

    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Add Employee</title>
      <link rel="stylesheet" href="style.css" type="text/css" />
  </head>
  <body>
    <center>
      <div id="login-form">
      <form method="post">
        <table border="0" cellspacing="0" cellpadding="6" bgcolor="#ffffff" style="padding:25px; border:1px dotted #ccc; ">
          <tr>
            <td><label>Employee Number:</label></td>
            <td><input name="employee_num" type="text" size="25" required /></td>
          </tr>
          <tr>
                <td><button type="submit" name="btn-createpayslip">Submit</button></td>
          </tr>
        </table>
      </form>
      </div>
    </center>
  </body>
</html>
