<?php

include("data_class.php");
// echo "here <br>";
$addnames=$_POST['addname'];
$addpass= $_POST['addpass'];
$addemail= $_POST['addemail'];
$type= $_POST['type'];

// echo '<script>alert("Password is tewe\nsfdfds\dfsd")</script>';
// header("location: index.php?msg=Invalid Credentials")
$hash = password_hash($addpass,PASSWORD_DEFAULT);
$obj=new data();
$obj->setconnection();
// echo $addnames,$addpass,$addemail,$type;
$obj->addnewuser($addnames,$hash,$addemail,$type);
?>