<?php

session_start();

$server = 'localhost';
$database = 'blog';
$username = 'root';
$password = '';

$connection=new mysqli($server, $username, $password, $database);
if($connection->connect_error){
    die($connection->connect_error);
}