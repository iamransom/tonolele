
<?php
session_start(); 

$host="localhost"; // Host name 
$username="lagram_tono"; // Mysql username 
$password="123qazQAZ"; // Mysql password 
$db_name="lagram_tono"; // Database name 
$tbl_name="cdb_usuarios"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE user='$myusername' and pass='$mypassword'";
$result=mysql_query($sql);


// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
//var_dump($count);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register(session_id());
//session_register("mypassword");
 $_SESSION['logged_in'] = true; 
  $_SESSION['username'] = $myusername; 

setcookie('username', $myusername, time()+10000); 
?>
<script type="text/javascript">window.location = "lista_canciones.php"</script>

<?php

echo "login OK </br>";
}
else {
echo "Wrong Username or Password";
}
ob_end_flush();
?>