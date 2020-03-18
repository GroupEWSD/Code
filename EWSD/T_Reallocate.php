<?php
include "dbcon.php";
include 'T_nav.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:\xampp\composer\vendor\autoload.php';

if (isset($_POST['Save']) && !empty($_POST['S_mail'])) {

    foreach ($_POST['S_mail'] as $Sval) {
        $Smail = $Sval;
        echo $Smail;
		
		$sqlx = "SELECT * FROM user_acc WHERE Uname ='$Smail'";
		$resultx = mysqli_query($conn, $sqlx);
		
		if ($resultx->num_rows > 0){
		
			foreach ($_POST['T_mail'] as $Tval) {
				$Tmail = $Tval;
				echo $Tmail;
				
				$sqly = "SELECT * FROM user_acc WHERE Uname ='$Tmail'";
				$resulty = mysqli_query($conn, $sqly);
				
				if ($resulty->num_rows > 0){
					
					$sql = "UPDATE t_assign SET Sname = '$Smail', Tname = '$Tmail' WHERE Sname = '$Smail'";
					
					if (mysqli_query($conn, $sql)) {
						
						$sql2 = "SELECT * FROM user_acc WHERE Uname ='$Smail'";
						$sql3 = "SELECT * FROM user_acc WHERE Uname ='$Tmail'";
						
						$result2 = mysqli_query($conn, $sql2);
						$result3 = mysqli_query($conn, $sql3);
				
						if ($result2->num_rows > 0){
					
							while($row2 = $result2->fetch_assoc()) {
					
								$semail = $row2['Uemail'];
								$sname = $row2['Uname'];
								
								$mail = new PHPMailer(TRUE);
						
								$mail->isSMTP();
								$mail->SMTPDebug = SMTP::DEBUG_SERVER;
								$mail->Host = 'smtp.gmail.com';
								$mail->Port = 587;
								$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
								$mail->SMTPAuth = true;
								$mail->Username = 'anonyxanta@gmail.com';
								$mail->Password = 'eaxlbvbqflasfrvf';

								$mail->setFrom('Timebank@support.com', 'Time Bank Co');

								$mail->addAddress($semail, $sname);
								$mail->Subject = 'Email Verification';

								$mail->Body = "<html></body><div style='padding-top:8px;'>Tutor ".$Tmail." Has been reassigned to assist you.</div>
												</body></html>";

								$mail->isHTML(true);
												
								if($mail->send()){
											
									$message = "Email Sent";
									echo "<script type='text/javascript'>alert('$message');</script>";
											
									echo "<script type='text/javascript'>window.location = 'T_Reallocate.php';</script>";
											
								}
											
								else {
												
									echo "Error, Email not sent.";
												
								}
								
							}
						}
						
						if ($result3->num_rows > 0){
					
							while($row3 = $result3->fetch_assoc()) {
					
								$temail = $row3['Uemail'];
								$tname = $row3['Uname'];
								
								$mail = new PHPMailer(TRUE);
						
								$mail->isSMTP();
								$mail->SMTPDebug = SMTP::DEBUG_SERVER;
								$mail->Host = 'smtp.gmail.com';
								$mail->Port = 587;
								$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
								$mail->SMTPAuth = true;
								$mail->Username = 'anonyxanta@gmail.com';
								$mail->Password = 'eaxlbvbqflasfrvf';

								$mail->setFrom('Timebank@support.com', 'Time Bank Co');

								$mail->addAddress($temail, $tname);
								$mail->Subject = 'Email Verification';

								$mail->Body = "<html></body><div style='padding-top:8px;'>Student ".$Smail." Has been reassigned under you.</div>
												</body></html>";

								$mail->isHTML(true);
												
								if($mail->send()){
											
									$message = "Email Sent";
									echo "<script type='text/javascript'>alert('$message');</script>";
											
									echo "<script type='text/javascript'>window.location = 'T_Reallocate.php';</script>";
											
								}
											
								else {
												
									echo "Error, Email not sent.";
												
								}
							}
						}
						
						// header("refresh:0; url=T-assign.php");
						echo "<script>alert('Added.');</script>";
					} 
					
					else {
						echo "<script>alert('Fail Upload.');</script>";
					}
				}
			}
		}
    }
}

?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="dist/simplePagination.css" />
<script src="dist/jquery.simplePagination.js"></script>

</head>
<style>

#container{
    text-align:center;
}
#content{
    border: 1px solid red;
    margin: auto;
    text-align:auto;
    width:80%;
}


	#tabledata th,td{
		border: 1px solid grey;
        padding: 1px;
        text-align:center;
        border-radius:10px;

	}

	#tabledata th {
		padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 5px;
        padding-left: 5px;
		text-align: center;
		background-color: black;
        color: white;
    }

    #wrapper
    {
    border: 1px solid black;
    margin: auto;
    text-align:center;
    width:70%;
    height:auto;
    padding: 20px 20px 20px
    }

    input{
        text-align:center;
        border-radius:10px;
    }


</style>
<body>
<div id="container">

<div id="header">
    <h1 style="background-color:BLACK; ">
    <a style="height: 20%; text-align: center; color: white;">REALLOCATE STUDENT</a></h1>
</div>
<br>

<div id="wrapper">
<div id="content">

<?php 
			
				$sql ="SELECT * FROM t_assign";
				
				$result = mysqli_query($conn, $sql);
				
				echo "<p style='text-align:center; font-size:20px;' >Allocated Students</p>";
				echo "<table width='450' style='text-align:center;margin:10px auto;width:50%;'><tr><th>Teacher</th><th>Student</th></tr>";
				
				if (mysqli_num_rows($result) > 0){
					
					
					while($row = $result->fetch_assoc()) {
						
						$sn = $row['Tname'];
						$tn = $row['Sname'];
							
						echo "<tr>";
						echo "<td>$tn</td>";
						echo "<td>$sn</td>";
						echo "</tr>";
						
					}
					
				}
				echo "</table>";
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<p style='text-align:center; font-size:20px;'>Reallocation</p>
<table id="add" style="text-align:center;margin:auto;width:50%;">
<div id="dynamicCheck" >
    <tr>
   <th style="text-align:center;"><input type="button" value="Add Student" onclick="Studentbox();"/></th>
   <th style="text-align:center;"><input type="button" value="Add Tutor" onclick="Tutorbox();"/></th>
   </tr>
   <tr>
   <td style="text-align:center;margin:auto;width:100%;"><div id="StudentBOX">Add Student to input:</div></td>
   <td style="text-align:center;margin:auto;width:100%;"><div id="TutorBOX">Add Tutor to input:</div></td>
   </tr>
</div>

</table>
<button id="Savebtn" name="Save" type="submit" class="btn btn-primary" style="height:5%;width:100px;font-size:20px;margin-bottom:1%;padding: 3px 3px 3px;">Assign</button>

<hr>
      </form>



</div>
</div>


<!-- <div id="footer">
<p></p>
</div> -->
</div>
</body>

</html>

<script>
$(document).ready( function () {
    $('#tabledata').DataTable({
        "dom": 'lrtip', "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]]

    });
} );
</script>
<script type="text/JavaScript">
function Studentbox() {
    // First create a DIV element.
	var txtNewInputBox = document.createElement('div');

    // Then add the content (a new input box) of the element.
	txtNewInputBox.innerHTML = "<input type='text' id='newInputBox' name='S_mail[]'>";

    // Finally put it where it is supposed to appear.
	document.getElementById("StudentBOX").appendChild(txtNewInputBox);
}
</script>
<script type="text/JavaScript">
function Tutorbox() {
    // First create a DIV element.
	var txtNewInputBox = document.createElement('div');

    // Then add the content (a new input box) of the element.
	txtNewInputBox.innerHTML = "<input type='text' id='newInputBox' name='T_mail[]'>";

    // Finally put it where it is supposed to appear.
	document.getElementById("TutorBOX").appendChild(txtNewInputBox);
}
</script>
