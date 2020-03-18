<?php

ob_start();
include "dbcon.php";
include "S_nav.php";

$sql1 = "SELECT * FROM cwupload";
$result1 = mysqli_query($conn, $sql1);

$files = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="dist/simplePagination.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="dist/jquery.simplePagination.js"></script>
    <!-- jQuery library -->
    <script src="js/jquery.min.js"></script>




</head>
<style>
    #top-nav a:hover {
        background-color: white;
        font-weight: bold;
        color: black;
    }

    #top-nav-r a:hover {
        background-color: white;
    }

    /* #container {
      border-style: solid;
      border-width: 5px;
      margin: auto;
      max-width: 50%;
      padding: 10px 10px 10px;
    } */
    #upload {
        border-style: none;
        border-width: 1px;
        margin: auto;
        padding: 10px 10px 10px;
        text-align: center;
    }

    #fileshow table {
        border-style: solid;
        border-width: 1px;
        margin: auto;
        width: auto;
    }

    #fileshow th,
    td {
        border-style: solid;
        border-width: 1px;
        margin: auto;
        width: auto;
        padding: 10px 10px 10px;
        text-align: center;
    }
</style>

<body>

    <?php
    if (isset($_POST['upload'])) {

        $fname = $_POST['fname'];
        $duedate = $_POST['duedate'];
        $tutorN = $_POST['tutor'];
        $filename = $_FILES['myfile']['name'];
        $destination = 'documents/' . $filename;
        echo $fname;

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $file = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];

        if (!in_array($extension, ['zip', 'pdf', 'png', 'jpg', 'docx'])) {
            echo "File type error / Select File";
        } else if ($_FILES['myfile']['size'] > 1000000) {
            echo "File too large";
        } else {
            if (move_uploaded_file($file, $destination)) {
                $sqlup = "INSERT INTO cwupload (Fname,name,size,due_date,t_ID) VALUES ('$fname','$filename','$size','$duedate','$tutorN')";

                if (mysqli_query($conn, $sqlup)) {
                    echo "<script language='javascript'>";
                    echo 'alert("Uploaded Success");';
                    echo 'window.location.replace("S_upload.php");';
                    echo "</script>";
                } else {
                    echo "file uploaded fail";
                }
            }
        }
    }

    if (isset($_GET['del_id'])) {
        $delid = $_GET['del_id'];
        $sqldel = "DELETE FROM cwupload WHERE cw_ID = $delid";

        if (mysqli_query($conn, $sqldel)) {
            $INFO = "Delete SUCESSFULLY";
            echo "<script type='text/javascript'>alert('$INFO');</script>";
            header("refresh:0 ; url = T_courseup.php");
        } else {
            echo "Not Deleted";
        }
    }


    if (isset($_GET['file_id'])) {

        $id = $_GET['file_id'];

        $sqlchk = "SELECT * FROM cwupload WHERE cw_ID = $id";
        $result = mysqli_query($conn, $sqlchk);

        $file = mysqli_fetch_assoc($result);

        $filepath = 'documents/' . $file['name'];

        if (file_exists($filepath)) {

            header('Content-Type: application/octet-stream');

            header('Content-Description: File Transfer');

            header('Content-Disposition: attachment; filename=' . basename($filepath));

            header('Expires:0');

            header('Cache-Control: must-revalidate');
            header('Pragma:public');

            header('Content-Length:' . filesize('documents/' . $file['name']));

            readfile('documents/' . $file['name']);

            mysqli_query($conn, $updateDL);

            //ob_end_flush();

            exit;
        }
    }
    ?>

    <div id="container" class="container">

        <div id=" upload" class="upload form">
            <form id="upload" action="S_upload.php" method="post" enctype="multipart/form-data">
                <table style="margin:auto;border-style:none">
                    <th style="width:150px;text-align:center;border:1px solid lightgrey;">File Name:
                    <th>
                    <td style="border:1px solid lightgrey"><input style="width:420px;" type="text" name="fname" required></td>
                    <tr>
                        <th style="width:150px;text-align:center;border:1px solid lightgrey;">Upload file:
                        <th>
                        <td style="width:auto;border:1px solid lightgrey">
                            <input style="margin-top:20px" type="file" id="myFile" name="myfile" /><br>
                    </tr>
                    </td>
                    <tr>
                        <th style="width:150px;text-align:center;border:1px solid lightgrey;">Due date:
                        <th>
                        <td style="width:400px;border:1px solid lightgrey">
                            <input type="datetime-local" name="chkoutD" class="form-control">
                    </tr>

                </table>
                <br>
                <button name="upload" type="submit" class="btn btn-primary">Upload</button>

            </form>
        </div>

    </div>
    <hr>

    <div name="show" id="fileshow">
        <table>
            <thead>
                <th>Uploaded Date & Time</th>
                <th>Due date</th>
                <th>File Name</th>
                <th>File</th>
                <th>File Size</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($files as $file) : ?>

                    <tr>
                        <td style="text-align:center"><?php echo $file['up_date']; ?></td>
                        <td style="text-align:center"><?php echo $file['Fname']; ?></td>
                        <td><?php echo $file['name']; ?></td>
                        <td><?php echo $file['due_date']; ?></td>
                        <td style="text-align:right"><?php echo $file['size'] / 1000 . "KB"; ?></td>
                        <td><a href="T_courseup.php?file_id=<?php echo $file['cw_ID'] ?>"><button type="button" class="btn btn-secondary">Download </button></a>

                            <a href="T_courseup.php?del_id=<?php echo $file['cw_ID'] ?>"><button type="button" class="btn btn-secondary">Delete </button></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>
        <br>
    </div>

</body>

</html>