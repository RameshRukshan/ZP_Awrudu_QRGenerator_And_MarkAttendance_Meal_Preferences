<?php include_once('../inc/header.php'); ?>
<title>Add New</title>
 <?php include_once('../config/config.php'); ?>
 <div class="container-fluid" style="background-color: #8c3a14; padding: 50px; width: 100%; height: 100vh;">
 	<div class="container">
		
 		<div class="row">
 			<div class="col-md-4"></div>
 			<div class="col-md-4 mx-auto" id="myform">

			 	<?php
				if(isset($_POST["submit"])) {
					$del_id = $_POST["del_id"];
					$first_name = $_POST["first_name"];
					$last_name = $_POST["last_name"];
					$whatsapp_no = $_POST["wano"];
					$attendance = $_POST["attendance"];
					$meal = $_POST["meal"];

					$sql = "INSERT INTO users (delegate_id ,first_name, last_name, whatsapp, attended, meal) VALUES ('$del_id','$first_name', '$last_name','$whatsapp_no', '$attendance', '$meal')";
					$conn->query($sql);

					if ($conn->affected_rows > 0) {
						echo "<script>
						alert('User added successfully!');</script>";
						header("Refresh: 1; url=add_new_user.php");
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
 					<div class="form-group">
 						<label>First Name:</label>
 						<input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
 					</div>
 					<div class="form-group">
 						<label>Last Name:</label>
 						<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
 					</div>
					 <div class="form-group">
 						<label>WhatsApp Number:</label>
 						<input type="text" name="wano" class="form-control" value="+94" placeholder="+94716980110">
 					</div>
 					<div class="form-group">
 						<label>Attendance</label>
 						<select name="attendance" class="form-control">
 							<option value="yes">Attended</option>
 							<option value="no">Not Attended</option>
 						</select>
 					</div>
 					<div class="form-group">
 						<label>Meal Preference</label>
 						<select name="meal" class="form-control">
 							<option value="veg">Veg</option>
 							<option value="nonveg">Non-Veg</option>
 							<option value="noneed">Meal Not Needed</option>
 						</select>
 					</div>
					 
 					<input type="submit" name="submit" value="Add Volunteer" style="background-color: #57cb1e; color: white; width: 100%; margin-top:20px; border-radius: 20px; padding: 10px;">
 				</form>
 				
 			</div>
 			<div class="col-md-4"></div>
 		</div>
 	</div>
 </div>
