<?php 

// mulai session
session_start();

// hancurkan session yang ada
session_destroy();

// alihkan ke halaman login
header("Location: login.php");

?>