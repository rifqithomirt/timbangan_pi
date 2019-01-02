<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cnPenimbangan = "localhost";
$database_cnPenimbangan = "dbpenimbangan";
$username_cnPenimbangan = "pi";
$password_cnPenimbangan = "123456";
$cnPenimbangan = mysqli_connect($hostname_cnPenimbangan, $username_cnPenimbangan, $password_cnPenimbangan, $database_cnPenimbangan) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
