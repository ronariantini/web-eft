<?php

session_start();
$_SESSION =[];
session_unset();
session_destroy();

setcookie ('u', '', time() -3600);
setcookie ('key', '', time() -3600);

header("Location: index.html");
exit;
?>