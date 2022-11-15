<?php
session_start();
unset($_SESSION["docid"]);
unset($_SESSION["docname"]);
header("Location: /Doctor-System/Index.html");
?>