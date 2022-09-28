<?php
//addserver_page.php
include("data_class.php");



$bookname=$_POST['bookname'];
$bookdetail=$_POST['bookdetail'];
$bookaudor=$_POST['bookaudor'];
$bookpub=$_POST['bookpub'];
$branch=$_POST['branch'];
$bookprice=$_POST['bookprice'];
$bookquantity=$_POST['bookquantity'];

// echo  $_FILES["bookphoto"]["name"],"<br>";

// echo  basename($_FILES["bookphoto"]["name"]),"<br>";
if (move_uploaded_file($_FILES["bookphoto"]["tmp_name"],"uploads/" . $_FILES["bookphoto"]["name"])) 
{
  echo "here";
  $bookpic=$_FILES["bookphoto"]["name"];

  $obj=new data();
  $obj->setconnection();
  $obj->addbook($bookpic,$bookname,$bookdetail,$bookaudor,$bookpub,$branch,$bookprice,$bookquantity);
} 
else 
{
  echo "File not uploaded";
}