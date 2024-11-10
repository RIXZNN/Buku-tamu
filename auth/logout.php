<?php
//memulai session
session_start();

//hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

//redirect ke halaman login
header('location: login.php');
exit;