<?php

//initialize variables
$first_name = "";
$last_name  = "";
$username   = "";
$verify_username = "";
$password = "";
$verify_password = "";

// get posted form data
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$username = $_REQUEST['username'];
$verify_username = $_REQUEST['verify_username'];
$password = $_REQUEST['password'];
$verify_password = $_REQUEST['verify_password'];
//$whatever = $_REQUEST['whatever'];

// ensure if all fields are entered
if (($first_name == "")
    || ($last_name ==  "")
    || ($username == "")
    || ($verify_username == "")
    || ($password == "")
    || ($verify_password == "")) {
    header("Location: /register.php");
    exit();
}

if (strlen($first_name) <= 3) {
    $Okay = false;
}

if ($first_name!= $last_name) {
    $Okay = false;
}

if (strlen($username) <= 3) {
    $Okay = false;
}

if ($username != $verify_username) {
    $Okay = false;
}

if ($password <= 5) {
    $Okay = false;
}

if ($password != $verify_password) {
    $Okay = false;
}

if ($Okay == false) {
    $msg = "You have error in <b>First Name</b> field";
    $_SESSION['msg'] = $msg;
    header("Location: /register.php");
    exit();
}
foreach ($_REQUEST as $name => $value) {
    echo $name . " - " . $value . "<br>";
}
