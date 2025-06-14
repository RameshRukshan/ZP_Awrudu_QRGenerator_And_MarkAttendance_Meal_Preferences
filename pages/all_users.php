<?php include_once('inc/header.php');?>
<?php include_once('config/config.php');?>
<div class="container-fluid" style="background-color: #8c3a14; padding: 50px; width: 100%; height: 100vh;">
    <div class="container">

    <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">

                    <?php
                      $sql1 = "SELECT COUNT(*) FROM users WHERE attended = 'yes'";
                      $result1 = $conn->query($sql1);
                      
                      if ($result1 === false) {
                          // handle error
                          echo "Error: ". $conn->error;
                      } else {
                          $row = $result1->fetch_array();
                          $attended_count = $row[0];
                      }

                      $sql2 = "SELECT COUNT(*) FROM users";
                      $result2 = $conn->query($sql2);
                      
                      if ($result2 === false) {
                          // handle error
                          echo "Error: ". $conn->error;
                      } else {
                          $row = $result2->fetch_array();
                          $total_count = $row[0];
                      }

                      $sql3 = "SELECT COUNT(*) FROM users where meal = 'nonveg'";
                      $result3 = $conn->query($sql3);
                      
                      if ($result3 === false) {
                          // handle error
                          echo "Error: ". $conn->error;
                      } else {
                          $row = $result3->fetch_array();
                          $remaining_nonveg = $row[0];
                      }

                      $sql4 = "SELECT COUNT(*) FROM users where meal = 'veg'";
                      $result4 = $conn->query($sql4);
                      
                      if ($result4 === false) {
                          // handle error
                          echo "Error: ". $conn->error;
                      } else {
                          $row = $result4->fetch_array();
                          $remaining_veg = $row[0];
                      }

                      ?>

                        <h4 style="color: white; padding: 20px;">Attendance : <?php echo $attended_count ?>/<?php echo $total_count?></h4>
                    </div>
                    <div class="col-md-4">
                        <h4 style="color: white; padding: 20px;">Remaining Non-Veg : <?php echo $remaining_nonveg ?></h4>
                    </div>
                    <div class="col-md-4">
                        <h4 style="color: white; padding: 20px;">Remaining Veg : <?php echo $remaining_veg ?></h4>
                    </div>
                </div>
            </div>

        <div class="row" style="margin: 0 auto; padding: 40px;" id="myform">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <a href="pages/add_new_user.php" target="_blank" class="btn btn-info mb-2" style="width: 100%; background-color: #57cb1e; color: white; border-radius: 10px; padding-right: 50px; padding-left: 50px;">Add New Volunteer</a>
                    </div>
                    <div class="col-md-4">
                        <a href="pages/read_qr.php" target="_blank" class="btn btn-info mb-2" style="width: 100%; background-color: #57cb1e; color: white; border-radius: 10px; padding-right: 50px; padding-left: 50px;">Mark Attendance</a>
                    </div>
                    <div class="col-md-4">
                        <a href="pages/read_qr_meal.php" target="_blank" class="btn btn-info mb-2" style="width: 100%; background-color: #57cb1e; color: white; border-radius: 10px; padding-right: 50px; padding-left: 50px;">Mark Meal Preference</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-hover" style="background-color: white; margin-top: 20px; @media (max-width: 600px) { display: none; }">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Delegate ID</th>
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
                        $res = mysqli_query($conn, $get_all_users);
                        if (mysqli_num_rows($res) > 0) {
                            while ($rs = mysqli_fetch_assoc($res)) {
                                //echo $rs['id'];
                               ?>
                                <tr>
                                    <td><?php echo $rs['id'];?></td>
                                    <td><?php echo $rs['delegate_id'];?></td>
                                    <td><?php echo $rs['first_name'];?></td>
                                    <td><?php echo $rs['last_name'];?></td>
                                    <td><?php echo $rs['attended'];?></td>
                                    <td><?php echo $rs['meal'];?></td>
                                    <td><a href="https://web.whatsapp.com/send/?phone=<?php echo $rs['whatsapp'];?>&text=" target="_blank">WhatsApp</a></td>
                                    <td>
                                        <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $rs['id'];?>" target="_blank" onclick="createQR(<?php echo $rs['id'];?>)">Generate</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                           ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No Data Found</td>
                            </tr>
                            <?php
                        }
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

</div>
<?php include_once('inc/footer.php');?>

<script>
    const qrInput = document.getElementById("qrInput");
    const wrapper = document.querySelector(".wrapper");
    const qrImg = document.createElement("img");
    qrImg.classList.add("qr-img");
    wrapper.appendChild(qrImg);

    function createQR(qrValue) {
        qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
        qrImg.addEventListener("load", () => {
            wrapper.classList.add("active");
            generateBtn.innerText = "Generate QR Code";
        });
    }

    qrInput.addEventListener("keyup", () => {
        if (!qrInput.value.trim()) {
            wrapper.classList.remove("active");
            preValue = "";
        }
    });
</script>