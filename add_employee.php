<?php
    session_start();

    include_once 'config.php';

    if(isset($_POST['btn-add']))
    {
        $emp_num = mysql_real_escape_string($_POST['emp_num']);
        $dep_num = mysql_real_escape_string($_POST['dep_num']);
        $lname = mysql_real_escape_string($_POST['lname']);
        $fname = mysql_real_escape_string($_POST['fname']);
        $mname = mysql_real_escape_string($_POST['mname']);
        $bday = mysql_real_escape_string($_POST['bday']);
        $sal = mysql_real_escape_string($_POST['sal']);
        $civilstat = mysql_real_escape_string($_POST['civil_stat']) . mysql_real_escape_string($_POST['numDependencies']);
 
        if(mysql_query("INSERT INTO Employee(employee_number,department_number,lastname,firstname,middlename,birthdate,salary,civilstat) VALUES('$emp_num','$dep_num','$lname','$fname','$mname','$bday','$sal','$civilstat')"))
        {
            ?>
            <script>alert('Employee successfully registered ');</script>
            <?php
            header("Location: home.php");
        }
        else
        {
            ?>
            <script>alert('Error while registering employee ');</script>
            <?php
        }
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
            <td><input name="emp_num" type="text" size="25" required /></td>
          </tr>
          <tr>
            <td><label>Department Number:</label></td>
            <td><input name="dep_num" type="text" size="25" required /></td>
          </tr>
          <tr>
            <td><label>Last Name:</label></td>
            <td><input name="lname" type="text" size="25" required /></td>
          </tr>
          <tr>
            <td><label>First Name:</label></td>
            <td><input name="fname" type="text" size="25" required /></td>
          </tr>
          <tr>
            <td><label>Middle Name:</label></td>
            <td><input name="mname" type="text" size="25" required/></td>
          </tr>
          <tr>
            <td><label> Birthday (YYYY-MM-DD):</label></td>
            <td><input name="bday" type="text" size="25" required/></td>
          </tr>
          <tr>
            <td><label> Basic Salary (in Pesos):</label></td>
            <td><input name="sal" type="text" size="25" required/></td>
          </tr>
          <tr>
            <td><label>Civil Status:</label></td>
            <td><select name="civil_stat">
              <option value="single"> single</option>
              <option value="married"> married</option>
              </select></td>
          </tr>
          <tr>
            <td><label>Number of Dependencies :</label></td>
            <td><select name="numDependencies">
              <option value="0"> 0</option>
              <option value="1"> 1</option>
              <option value="2"> 2 </option>
              <option value="3"> 3 </option>
              <option value="4"> 4 </option>
              </select></td>
          </tr>
          <tr>
                <td><button type="submit" name="btn-add">Submit</button></td>
          </tr>
        </table>
      </form>
      </div>
    </center>
  </body>
</html>
