<?php 
session_start();
              // Kill session variables 
 unset($_SESSION['logged_in']); 
 unset($_SESSION['username']); 
  
session_destroy();
?>
<script type="text/javascript">window.location = "index.php"</script>
