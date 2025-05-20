<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_wisdom = "localhost";
$database_wisdom = "wisdom";
$username_wisdom = "root";
$password_wisdom = "";
$wisdom = mysql_pconnect($hostname_wisdom, $username_wisdom, $password_wisdom) or trigger_error(mysql_error(),E_USER_ERROR); 
?>