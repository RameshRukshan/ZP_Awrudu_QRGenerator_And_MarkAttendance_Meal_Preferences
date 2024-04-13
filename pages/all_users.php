 <?php include_once('inc/header.php'); ?>
 <?php include_once('config/config.php'); ?>
 <div class="conatainer-fluid" >
    <div class="container"><br>
 <h3 class="text-center text-white">All Volunteers</h3>
  <a href="pages/add_new_user.php" class="btn btn-info mb-2 pull-right" style="background-color: #57cb1e; color: white; margin-top:20px; border-radius: 20px; padding-right: 50px; padding-left: 50px;">Add New Volunteer</a>
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Sno<?php $sno='1'; ?></th>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Attended</th>
        <th>Meal</th>
        <th>Action</th>
        <th>G-QR</th>
      </tr>
    </thead>
   
      
  <tbody>
    <?php 
$get_all_users = "SELECT * FROM users";
$res = mysqli_query($conn,$get_all_users);
if(mysqli_num_rows($res)>0){
  while($rs = mysqli_fetch_assoc($res)){
    //echo $rs['id'];
    ?>
    <tr>
        <td><?php echo $sno++;?></td>
        <td><?php echo $rs['id']; ?></td>
        <td><?php echo $rs['first_name']; ?></td>
        <td><?php echo $rs['last_name'];?></td>
        <td> <?php echo $rs['attended'];?></td>
        <td> <?php echo $rs['meal'];?></td>
        <td><a href="https://wa.me/<?php echo $rs['whatsapp'];?>" target="_blank">WhatsApp</a></td>
        <td>
          <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $rs['id'];?>" target="_blank" onclick="createQR(<?php echo $rs['id'];?>)">Generate</a>
        </td>
      </tr>

    <?php

  }

}
else{
  ?>
  <tr>
    <td colspan="6" style="text-align: center;">No Data Found</td>
  </tr>
<?php
}


    ?>
      
     
    </tbody>
  </table>
   <?php include_once('inc/footer.php'); ?>

   <script>

    fun createQR(qrValue){
      qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${0011}`;
    qrImg.addEventListener("load", () => {
        wrapper.classList.add("active");
        generateBtn.innerText = "Generate QR Code";
    });
    }

    qrInput.addEventListener("keyup", () => {
    if(!qrInput.value.trim()) {
        wrapper.classList.remove("active");
        preValue = "";
    }
});

  </script>