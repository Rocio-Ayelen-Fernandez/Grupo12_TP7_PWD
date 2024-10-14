<?php

setcookie("token", "", time() - 3600,  "/", "", false, true);

header('location:login.php');

?>


