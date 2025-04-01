<?php
session_start();
session_destroy();
header("../vista/Location: index.php");
exit();
?>
