<?php
ob_start();
include "dbcon.php";
include "T_nav.php";

$sql1 = "SELECT * FROM files ORDER BY up_date DESC";
$result1 = mysqli_query($conn, $sql1);

$files = mysqli_fetch_all($result1, MYSQLI_ASSOC);

?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
#fileshow table{
      border-style: solid;
      border-width: 1px;
      margin: auto;
      width: auto;
}
#fileshow th, td{
      border-style: solid;
      border-width: 1px;
      margin: auto;
      width: auto;
      padding: 10px 10px 10px;
      text-align:center;
}
  </style>
  <body>

  <?php
if (isset($_POST['upload'])) {

    $fname = $_POST['fname'];
    $comment = $_POST['comment'];
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
            $sqlup = "INSERT INTO files (Fname,name,size,comment) VALUES ('$fname','$filename','$size','$comment')";

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

if (isset($_GET['file_id'])) {

    $id = $_GET['file_id'];

    $sqlchk = "SELECT * FROM files WHERE ID = $id";
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

// if (isset($_GET['save_id'])) {
//     $replyid = $_GET['save_id'];
//     echo $replyid;
//     $reply = $_POST['comment'];

//     $sqlrpy = "UPDATE files SET reply = '$reply' WHERE ID = $replyid";

//     $result = mysqli_query($conn, $sqlrpy);

//     if ($result->num_rows > 0) {
//         echo "<script language='javascript'>";
//         echo 'alert("Comment Success");';
//         echo 'window.location.replace("T_upload_R.php");';
//         echo "</script>";
//     } else {
//         echo "Comment fail";
//     }
// }

if (isset($_POST['savereply'])) {
    $id = $_POST['ID'];
    $coment = $_POST['coment'];
    $reply = $_POST['reply'];

    $sqlrpy = "UPDATE files SET comment='$coment' , reply='$reply' WHERE ID ='$id'";
    $sql_run = mysqli_query($conn, $sqlrpy);

    if ($sql_run) {
        echo '<script> alert("Reply Success"); </script>';
        header('refresh:0');
    } else {
        echo '<script> alert("Reply Fail"); </script>';
    }

}

?>

<!-- Modal -->
<div class="modal fade" id="replymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Reply Comment to Student</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<form action="T_upload_R.php" method="POST">
    <div class="modal-body">

    <input type="text" name="ID" id="ID" readonly>

        <div class="input-group">
            <div class="input-group-prepend">
                <h2 class="input-group-text">Student Comment</h2>

            <textarea id="coment" name="coment" rows="10" cols="100" class="form-control" aria-label="With textarea" readonly></textarea>

            <h2 class="input-group-text">Input Reply</h2>

            <textarea id="reply" name="reply" rows="10" cols="100" class="form-control" aria-label="With textarea"></textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="savereply" class="btn btn-secondary">Save Reply </a></button>
    </div>
    </form>
</div>
</div>
</div>


<div name="show" id="fileshow">
<h2 style="text-align:center">STUDENT UPLOADED COURSEWORK</h2><hr>
<table>
<thead>
<th>ID</th>
<th>Uploaded Date & Time</th>
<th>File Name</th>
<th>File</th>
<th>Comment</th>
<th>Reply</th>
<th>File Size</th>
<th>Action</th>
</thead>
<tbody>
<?php foreach ($files as $file): ?>

<tr>
<td  style="text-align:center"><?php echo $file['ID']; ?></td>
<td  style="text-align:center"><?php echo $file['up_date']; ?></td>
<td  style="text-align:center"><?php echo $file['Fname']; ?></td>
<td><?php echo $file['name']; ?></td>
<td><?php echo $file['comment']; ?></td>
<td><?php echo $file['reply']; ?></td>
<td style="text-align:right"><?php echo $file['size'] / 1000 . "KB"; ?></td>
<td><button type="button" class="btn btn-secondary"><a href="T_upload_R.php?file_id=<?php echo $file['ID'] ?>">Download </a></button>
<button type="button" class="btn btn-secondary replybtn" data-toggle="modal" data-target="#replymodal">Reply</button>
</td>

</tr>

<?php endforeach;?>
</tbody>

</table>
</div>

</body>
</html>
<script>

    // function myFunction() {

    //     var x;

    //     var site = prompt("Please enter Comment");

    //     if (site != null) {

    //         x = "Welocme at " + site + "! Have a good day";

    //         document.getElementById("demo").innerHTML = x;

    //     }

    // }

    $(document).ready(function(){
        $('.replybtn').on('click',function(){

            $('#replymodal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#ID').val(data[0]);
            $('#coment').val(data[4]);
            $('#reply').val(data[5]);
        });
    });

</script>