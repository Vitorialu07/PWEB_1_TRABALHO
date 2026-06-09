<?php
session_start();
session_destroy();
header('Location: /PWEB_1_TRABALHO/site/admin/login.php');
exit;
?>