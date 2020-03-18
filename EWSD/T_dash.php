<?php
	include 'T_nav.php';
?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="dist/simplePagination.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <script
      type="text/javascript"
      src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="dist/jquery.simplePagination.js"></script>
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
    .container {
      border-style: solid;
      border-width: 1px;

      padding: 10;
    }
    /* #left-con {
      border-style: solid;
      border-color: red;
      border-width: 1px;
    }

    #right-con {
      border-style: solid;
      border-color: blue;
      border-width: 1px;
    } */
    /* th {
      font-size: 14px;
    }
    tr {
      font-size: 12px;
    } */
  </style>
  <body>
    <div class="container">
        <table id="tabledata" name="tabledata" class="table table-bordered">
            <thead>
            <tr>
            <th>Student Name</th>
            <th>Course Name</th>
            <th>Coursework Status</th>
            <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            <!-- <?php
    while ($row = mysqli_fetch_assoc($result5)) {
        ?>
                        <tr>
                        <td><?php echo $row["Tname"]; ?></td>
                        <td><?php echo $row["Tloc"]; ?></td>
                        <td><?php echo "<img src='data:image/jpeg;base64," . base64_encode($row["Timg"]) . "' height='90px' width='auto'/>" ?> </td>
                        <td><?php echo $row["Tstatus"]; ?></td>
                        <td><?php echo "<a href='login1.php' >LOGIN TO ACCESS</a> " ?></td>
                        </tr>
            <?php
    }
    ;
    ?> -->
            </tbody>
            </table>
      </div>

      

      <!-- <script>
        $(document).ready(function() {
          $("#example").DataTable({
            pagingType: "full_numbers"
          });
        });
      </script> -->

<script>
    $(document).ready( function () {
        $('#tabledata').DataTable({
             "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]]
    
        });
    } );
    </script>
    </div>
  </body>
</html>
