<?php
ob_start();
include "dbcon.php";
include "S_nav.php";

// download
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
<html>

<head>
    <title></title>
    <style>
        #container {
            text-align: center;
        }

        #content {

            margin: auto;
            text-align: center;
            width: auto;
        }

        #dataTable {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            margin: auto;
            text-align: center;
            border-radius: 10px;
            height: auto;


        }

        #dataTable td {
            border: 1px solid grey;
            padding-top: 10px;
            padding-bottom: 5px;
            padding-right: 5px;
            padding-left: 5px;
            text-align: center;
            border-radius: 0px;

        }

        #dataTable th {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 5px;
            padding-left: 5px;
            text-align: center;
            background-color: black;
            color: white;
            border-radius: 0px;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Hotel Room</title>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>



</head>

<body>

    <!-- search function -->
    <?php

    if (isset($_POST['Search'])) {
        $Tutor = '';
        $Fname = '';

        if (isset($_POST['tutor'])) {
            $Tutor = mysqli_real_escape_string($conn, $_POST['tutor']);
        }

        if (isset($_POST['Fname'])) {
            $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
            // $HRtype = mysqli_real_escape_string($conn, $_POST['HRtype']);
        }


        if (!empty($Fname) || !empty($Tutor)) {
            $sql8 = "SELECT * FROM cwupload WHERE Fname LIKE '%$Fname%' AND Tname LIKE '%$Tutor%'";
            $result5 = mysqli_query($conn, $sql8);
        } else {
            echo "<script type='text/javascript'>alert('Please input Name / Subject');</script>";

            $sql9 = "SELECT * FROM cwupload";
            $result5 = mysqli_query($conn, $sql9);
        }
    } else {

        $sql0 = "SELECT * FROM cwupload";

        $result5 = mysqli_query($conn, $sql0);
    }
    ?>
    <!-- normal view page -->
    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <h2>VIEW COURSEWORK</h2>
            </div>
        </div>
    </div>
    <div id="content" style="margin:auto;">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

            <input style="width:300px; height:30px;" type="text" placeholder="File Name" name="Fname">
            <br><br>

            <select style="width:300px; height:30px;margin:auto;" id="Room-Type" name="tutor" class="form-control">
                <option selected disabled>Select Tutor</option>
                <option value="Ryan">Ryan</option>
                <option value="lim">Lim</option>
            </select> <button style="width:100px; height:auto;" type="submit" name="Search">Search</button>
        </form>
    </div>
    <hr>
    <br>
    <div class="card" style="width:75%;margin:auto;">
        <div class="card-body">

            <table name="dataTable" id="dataTable" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>

                        <th style="text-align:center;">Tutor Name</th>
                        <th style="text-align:center;min-width:160px;">Upload Date</th>
                        <th style="text-align:center;min-width:160px;">Due date</th>
                        <th style="text-align:center;">File Name</th>
                        <th style="text-align:center;">Size</th>

                        <th style="text-align:center;width:200px;">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result5)) {
                    ?>

                        <tr>

                            <td><?php echo $row['Tname'] ?></td>
                            <td><?php echo $row['up_date'] ?></td>
                            <td><?php echo $row['due_date'] ?></td>
                            <td><?php echo $row['Fname'] ?></td>
                            <td><?php echo $row['size'] / 1000 . "KB"; ?></td>

                            <td><a href="S_viewcw.php?file_id=<?php echo $row['cw_ID'] ?>"><button type="button" class="btn btn-secondary">Download </button></a>
                        </tr>
                    <?PHP
                    }
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "lengthMenu": [
                [-1, 3, 5, 10],
                ["All", 3, 5, 10]
            ]

        });
    });
</script>