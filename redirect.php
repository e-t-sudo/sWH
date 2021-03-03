<?php 
session_start(); 
echo "SESSION Global Variable<br>";
print_r($_SESSION); 
echo "<br>";
echo "REQUEST Global Variable<br>";
print_r($_REQUEST); 