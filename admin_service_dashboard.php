<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="image/png" sizes="96x96" rel="icon" href="public/images/bitnami.png">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<style>
    .innerright,
    label {
        /* color: rgb(16, 170, 16); */
        font-weight: bold;
    }

    .container,
    .row,
    .imglogo {
        margin: auto;
    }

    .innerdiv {
        text-align: center;
        /* width: 500px; */
        margin: 100px;
    }

    input,select {
        margin-left: 20px;
    }

    .leftinnerdiv {
        float: left;
        width: 25%;
    }

    .rightinnerdiv {
        float: right;
        width: 75%;
    }

    .innerright {
        background-color: rgb(105, 221, 105);
    }

    .greenbtn {
        background-color: rgb(16, 170, 16);
        color: white;
        width: 95%;
        /* padding: 3%; */
        white-space: nowrap;
        height: 40px;
        margin-top: 8px;
        font-size: 100%;
    }
    .greenbtncl:hover {
        background-color: rgb(16, 256, 16);
    }

    .greenbtn,
    a {
        text-decoration: none;
        color: white;
        font-size: large;
    }

    th {
        background-color: #00ff3d;
        color: black;
    }

    td {
        background-color: #b1feb2;
        color: black;
    }

    td,
    a {
        color: black;
    }
    body {
        background-color: rgb(105, 221, 105);
    }
    .addNewBookTable td, .issueBookTable td, .addPersontTable td, .bookDetailTable td{
        text-align: left;
        background-color: rgb(105, 221, 105);
    }
    .addNewBookTable, .issueBookTable, .addPersontTable, .bookDetailTable{
        margin-top: 10px;
        margin-left: auto;
        margin-right: auto;
    }
    input[type='number']{
    width: 80px;
    }
    label {
        margin-bottom: 0;
    }
    
</style>

<body>

    <?php
    include("data_class.php");

    $msg = "";

    if (!empty($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
    }

    if ($msg == "done") {
        echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
    } elseif ($msg == "fail") {
        echo "<div class='alert alert-danger' role='alert'>Fail</div>";
    }

    ?>



    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="public/images/logo.png" /></div>
            <div class="leftinnerdiv">
                <Button class="greenbtn">Admin</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('addbook')"> Add Book</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('bookreport')"> Book Report</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('bookrequestapprove')"> Book Requests</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('addperson')"> Add Student</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('studentrecord')"> Student Report</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('issuebook')"> Issue Book</Button>
                <Button class="greenbtn greenbtncl" onclick="openpart('issuebookreport')"> Issue Report</Button>
                <a href="index.php"><Button class="greenbtn greenbtncl"> Logout</Button></a>
            </div>

            <div class="rightinnerdiv">
                <div id="bookrequestapprove" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Book Request Approve</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->requestbookdata();
                    $recordset = $u->requestbookdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        "<td>$row[1]</td>";
                        "<td>$row[2]</td>";

                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[4]</td>";
                        $table .= "<td>$row[5]</td>";
                        $table .= "<td>$row[6]</td>";
                        // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                        $table .= "<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                        // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="addbook" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                        echo "display:none";
                                                                    } else {
                                                                        echo "";
                                                                    } ?>">
                    <Button class="greenbtn">Add New Book</Button>
                    <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
                        <table class="addNewBookTable">
                            <tr>
                                <td>Book Name:</td><td><input type="text" name="bookname" /></td>
                            </tr>
                            <tr>
                                <td>Detail:</td><td><input type="text" name="bookdetail" /></td>
                            </tr>
                            <tr>
                                <td>Author:</td><td><input type="text" name="bookaudor" /></td>
                            </tr>
                            <tr>
                                <td>Publication</td><td><input type="text" name="bookpub" /></td>
                            </tr>
                            <tr>
                                <td>Branch:</td><td><input type="radio" name="branch" value="CS" />CS<input type="radio" name="branch" value="EE" />EE<input type="radio" name="branch" value="ME" />ME<input type="radio" name="branch" value="OTHER" />other</td>
                            </tr>
                            <tr>
                                <td>Price:</td><td><input type="number" name="bookprice" /></td>
                            </tr>
                            <tr>
                                <td>Quantity:</td><td><input type="number" name="bookquantity" /></td>
                            </tr>
                            <tr>
                                <td>Book Photo</td><td><input type="file" name="bookphoto" /></td>
                            </tr>
                            <tr>
                                <td><input style="margin-left: 0;" type="submit" value="SUBMIT" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="addperson" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Add Student</Button>
                    <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                        <table class="addPersontTable">
                            <tr>
                                <td><label>Name:</label></td> <td><input type="text" name="addname" /></td>
                            </tr>
                            <tr>
                                <td><label>Pasword:</label></td> <td><input type="pasword" name="addpass" /></td>
                            </tr>
                            <tr>
                                <td><label>Email:</label></td> <td><input type="email" name="addemail" /></td>
                            </tr>
                            <tr>
                                <td><label for="type">Choose type:</label></td>
                                <td>
                                    <select name="type">
                                    <option value="student">student</option>
                                    <option value="teacher">teacher</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input style="margin-left: 0;" type="submit" value="SUBMIT" /></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="studentrecord" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Student Record</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->userdata();
                    $recordset = $u->userdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[1]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[4]</td>";
                        // $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="issuebookreport" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Issue Book Record</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->issuereport();
                    $recordset = $u->issuereport();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[6]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[4]</td>";
                        // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <!--             

issue book -->
            <div class="rightinnerdiv">
                <div id="issuebook" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Issue Book</Button>
                    <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                        <table class="issueBookTable">
                            <tr>
                                <td>
                                    <label for="book">Select Book:&nbsp</label>
                                </td>
                                <td>
                                    <select name="book">
                                    <?php
                                    $u = new data;
                                    $u->setconnection();
                                    $u->getbookissue();
                                    $recordset = $u->getbookissue();
                                    foreach ($recordset as $row) {

                                        echo "<option value='" . $row[2] . "'>" . $row[2] . "</option>";
                                    }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="Select Student">Select Student:&nbsp</label>
                                </td>
                                <td>
                                    <select name="userselect">
                                        <?php
                                    $u = new data;
                                    $u->setconnection();
                                    $u->userdata();
                                    $recordset = $u->userdata();
                                    foreach ($recordset as $row) {
                                        $id = $row[0];
                                        echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                                    }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Days:&nbsp</label>&nbsp
                                </td>
                                <td>
                                    <input  type="number" name="days" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <input style="margin-left: 0;" type="submit" value="SUBMIT" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookdetail" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                            $viewid = $_REQUEST['viewid'];
                                                                        } else {
                                                                            echo "display:none";
                                                                        } ?>">

                    <Button class="greenbtn">Book Details</Button>
                    </br>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbookdetail($viewid);
                    $recordset = $u->getbookdetail($viewid);
                    foreach ($recordset as $row) {

                        $bookid = $row[0];
                        $bookimg = $row[1];
                        $bookname = $row[2];
                        $bookdetail = $row[3];
                        $bookauthour = $row[4];
                        $bookpub = $row[5];
                        $branch = $row[6];
                        $bookprice = $row[7];
                        $bookquantity = $row[8];
                        $bookava = $row[9];
                        $bookrent = $row[10];
                    }
                    ?>

                    <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:30px' src="uploads/<?php echo $bookimg ?> " />
                    <table style="margin-left:250px; margin-top: 0;" class="bookDetailTable">
                        <tr><td>Book Name: &nbsp&nbsp</td> <td><?php echo $bookname ?></td></tr>
                        <tr><td>Book Detail: &nbsp&nbsp</td> <td><?php echo $bookdetail ?></td></tr>
                        <tr><td>Book Authour: &nbsp&nbsp</td> <td><?php echo $bookauthour ?></td></tr>
                        <tr><td>Book Publisher: &nbsp&nbsp</td> <td><?php echo $bookpub ?></td></tr>
                        <tr><td>Book Branch: &nbsp&nbsp</td> <td><?php echo $branch ?></td></tr>
                        <tr><td>Book Price: &nbsp&nbsp</td> <td><?php echo $bookprice ?></td></tr>
                        <tr><td>Book Available: &nbsp&nbsp</td> <td><?php echo $bookava ?></td></tr>
                        <tr><td>Book Rent: &nbsp&nbsp</td> <td><?php echo $bookrent ?></td></tr>
                    </table>
                    <!-- <p style="color:black">Book Name: &nbsp&nbsp<?php echo $bookname ?></p>
                    <p style="color:black">Book Detail: &nbsp&nbsp<?php echo $bookdetail ?></p>
                    <p style="color:black">Book Authour: &nbsp&nbsp<?php echo $bookauthour ?></p>
                    <p style="color:black">Book Publisher: &nbsp&nbsp<?php echo $bookpub ?></p>
                    <p style="color:black">Book Branch: &nbsp&nbsp<?php echo $branch ?></p>
                    <p style="color:black">Book Price: &nbsp&nbsp<?php echo $bookprice ?></p>
                    <p style="color:black">Book Available: &nbsp&nbsp<?php echo $bookava ?></p>
                    <p style="color:black">Book Rent: &nbsp&nbsp<?php echo $bookrent ?></p> -->


                </div>
            </div>



            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Book Record</Button>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbook();
                    $recordset = $u->getbook();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[9]</td>";
                        $table .= "<td>$row[10]</td>";
                        $table .= "<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View BOOK</button></a></td>";
                        // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>



        </div>
    </div>



    <script>
        function openpart(portion) {
            var i;
            var x = document.getElementsByClassName("portion");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(portion).style.display = "block";
        }
    </script>
</body>

</html>