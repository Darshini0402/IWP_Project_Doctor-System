<?php
session_start();
unset($_SESSION["patid"]);
unset($_SESSION["patname"]);
header("Location: /Doctor-System/Index.html");
?>