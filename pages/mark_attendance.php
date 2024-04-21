<?php include_once('../inc/header.php'); ?>
<title>Mark Attendance</title>
 <?php include_once('../config/config.php'); ?>
 <div class="container-fluid" style="background-color: #8c3a14; padding: 50px; width: 100%; height: 100vh;">
 	<div class="container">
		
 		<div class="row">
 			<div class="col-md-4"></div>
 			<div class="col-md-4 mx-auto" id="myform">

			 	<?php
				if(isset($_POST["submit"])) {
					$del_id = $_POST["del_id"];

					$sql = "UPDATE users SET attended = 'yes' WHERE delegate_id ='$del_id'";
					$conn->query($sql);

					if ($conn->affected_rows > 0) {
						echo "<script>
						alert('Attendance Updated');</script>";
						header("Refresh: 1; url=mark_attendance.php");
						exit();
					} else {
						echo "Error: ". $sql. "<br>". $conn->error;
					}
				}
				$conn->close();
				?>

 				<form action="#" method="POST" style="margin: 0 auto; padding: 40px;" enctype="multipart/form-data">
				 <div class="form-group">
 						<label>Delegate ID:</label>
 						<input type="text" name="del_id" class="form-control" placeholder="UOR-001">
 					</div>
 					<input type="submit" name="submit" value="Mark" style="background-color: #57cb1e; color: white; width: 100%; border-radius: 20px; padding: 10px;">
 				</form>
 				
 			</div>
 			<div class="col-md-4"></div>
 		</div>
 	</div>
 </div>
