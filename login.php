<?php
include 'connect.php';
include 'header.php';


$_SESSION['signed_in'] = true;

header('Location: index.php');
exit();