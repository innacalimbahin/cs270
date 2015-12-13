<?php
    $hostname='localhost:3036';
    $username='root';
    $password='@gAt0nton';
    $dbname='cs270';

    mysql_connect($hostname, $username, $password) OR DIE('Unable to connect to database! Please try again later.');
    mysql_select_db($dbname);
?>
