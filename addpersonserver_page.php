<?php

include("data_class.php");
echo "here <br>";
$addnames=$_POST['addname'];
$addpass= $_POST['addpass'];
$addemail= $_POST['addemail'];
$type= $_POST['type'];


$obj=new data();
$obj->setconnection();
echo $addnames,$addpass,$addemail,$type;
$obj->addnewuser($addnames,$addpass,$addemail,$type);
?>