<?php

define("MYSQL_HOST",'localhost');
define("MYSQL_USERNAME",'root');
define("MYSQL_PASSWORD",'');
define("MYSQL_DB",'ha07');
$INFO='insert successfully';
$conn =mysqli_connect(MYSQL_HOST,MYSQL_USERNAME,MYSQL_PASSWORD,MYSQL_DB);
if (!$conn){
	die("connection failed".mysqli_connect_error);
}
	
	if(empty($_SESSION)){
		
		session_start();
	}
	
if(isset($_POST['save'])){
	$n=$_SESSION['username'];
	$stu=$_POST["student"];
	$t=$n;
	$content=$_POST["message"];
	//$tutor=$row['tutor_name'];
	$sql1="INSERT INTO messages(tutor_name,student,content) VALUES('$t','$stu','$content')";
	$result1= mysqli_query($conn,$sql1);
	echo $INFO;
	
}
	$n=$_SESSION['username'];
	$sql2 ="SELECT * FROM messages WHERE tutor_name='$n'";
	$result2=mysqli_query($conn,$sql2);


	
	//$sql="SELECT * FROM tutor WHERE tutor_name=$tutor AND student='$n'";
?>

<html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
<div style="width:500px; height:200px; border:1px solid; margin-top:50px; margin-left:500px;" align="center">

<?php
	$n=$_SESSION['username'];
	$sql ="SELECT * FROM t_assign WHERE Tname='$n'";
	$result=mysqli_query($conn,$sql);
	
	echo "<select name='Student' style='margin-top:50px;'>";
	echo "<option value='Student Name'>Student Name</option>";

		if(mysqli_num_rows($result)>0){
				echo"<label for='text'>student:</label>";
				
			while($row=mysqli_fetch_array($result)){
				$student=$row['Sname'];
				
				echo "<option value=$student>$student</option>";

				
				
			}
		}else{
			echo"No User !";
		}
	echo"</select>";

?>
<br><textarea class="message-input" name="message" placeholder="write your message"></textarea><br>
<br><button type="submit" name="save">Save</button>
</div>
<div style="width:600px; height:230px; border:1px solid; margin-top:50px; margin-left:450px;" align="center">
<table name="dataTable" id="dataTable" class="table table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th style="text-align:center;">Tutor Name</th>
                        <th style="text-align:center;">Student Name</th>
                        <th style="text-align:center;">Content</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result2)) {
						
                    ?>

                        <tr>
							<td><?php echo $row['tutor_name'] ?></td>
                            <td><?php echo $row['student'] ?></td>
                            <td><?php echo $row['content'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

</div>
</form>

</body>

</html>
<script>
	  $(document).ready(function() {
        $('#dataTable').DataTable({
            "lengthMenu": [
                [3, 5, 10, -1],
                [3, 5, 10, "All"]
            ]

        });
    });
</script>