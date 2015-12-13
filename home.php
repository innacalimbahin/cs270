<?php
    session_start();
    include_once 'config.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title> The Payroll Project Home</title>
  </head>
  <body>
    <table width="100%" border="0">
      <tr>
        <td colspan="2" bgcolor="#b5dcb3">
          <h1>The Payroll Project</h1>
        </td>
      </tr>
      <tr valign="top">
        <td bgcolor="#aaa">
          <font size="3" face="verdana" color="black"> Manage Employees </font> <br /> <br />
          <b> <a href="add_employee.php">Add Employee</a></b><br />
          <b> <a href="view_employee.php">View Employee</a></b><br />
          <b> <a href="edit_employee.php">Edit Employee</a></b><br /> <br />
          <font size="3" face="verdana" color="black"> Manage Payroll </font> <br /> <br />
          <b> <a href="create_payslip.php">Create Payslip</a></b><br />
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#b5dcb3"> <center> A CS270 Project </center>
        </td>
      </tr>
    </table>
  </body>
</html>
