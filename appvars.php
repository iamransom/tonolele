<?php

//Variables de DB
define('DB_HOST', 'localhost');
define('DB_USER', 'lagram_tono');
define('DB_PASSWORD', '123qazQAZ');
define('DB_NAME', 'lagram_tono');
error_reporting(0);



function check_login_status() { 
              // If $_SESSION['logged_in'] is set, return the status 
              if (isset($_SESSION['logged_in'])) { 
                            return $_SESSION['logged_in']; 
              } 
              return false; 
}


		
		function getcheck($vartocheck){
			global $dataupd;
			$checked = $_GET[$vartocheck];
			$checked = trim($checked);
			$checked = mysql_real_escape_string($checked);
			if ($checked!=null){
				return $checked;
			}
		}
		
			function postcheck($vartocheck){
			global $dataupd;
			$checked = $_POST[$vartocheck];
			$checked = trim($checked);
			$checked = mysql_real_escape_string($checked);
			if ($checked!=null){
				return $checked;
			}
		}


function numero_a_tono ($tono){
	switch ($tono) {
    case 1:
        return 'DO';
        break;
    case 2:
        return 'DO#';
        break;
    case 3:
        return 'RE';
        break;
    case 4:
        return 'RE#';
        break;
    case 5:
        return 'MI';
        break;
    case 6:
        return 'FA';
        break;
    case 7:
        return 'FA#';
        break;
    case 8:
        return 'SOL';
        break;
    case 9:
        return 'SOL#';
        break;
    case 10:
        return 'LA';
        break;
    case 11:
        return 'SIb';
        break;
    case 12:
        return 'SI';
        break;
    default:
        return $tono;
        break;
}
	
}

?>