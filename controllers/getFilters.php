<?php
session_start();
$output = '';
if (isset($_SESSION['sorting'])) {
    $output = $_SESSION['sorting'];
}
echo $output;
