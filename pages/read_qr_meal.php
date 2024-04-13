<?php
include_once('../config/config.php');

if (isset($_GET["decodeText"])) {
    $decodeText = $_GET["decodeText"];
    $sql = "SELECT * FROM users WHERE id=$decodeText";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["meal"] == "veg" || $row["meal"] == "nonveg") {

            $meal_preference = $row["meal"];
            if ($meal_preference == "veg") {
                $meal_message = "Preference: Vegetarian";
            } else if ($meal_preference == "nonveg") {
                $meal_message = "Preference: Non-Vegetarian";
            }

            $sql = "UPDATE users SET meal='taken' WHERE id=$decodeText";
            $conn->query($sql);
        }else if($row["meal"] == "noneed"){
            $meal_message = "Meal not included";
        }else if($row["meal"] == "taken"){
            $meal_message = "Already taken meal";
        } else {
            $meal_message = "Invalid meal status";
        }
        echo "<script>alert('$meal_message');</script>";
		header("Refresh: 1; url=read_qr_meal.php");
        exit();  

    } else {
        echo "<script>alert('Invalid QR code');</script>";
		header("Refresh: 1; url=read_qr_meal.php");
        exit();
    }
}

$conn->close();
?>

<!-- Index.html file -->
<!DOCTYPE html> 
<html lang="en"> 

<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="styleread.css"> 
    <title>Meal - QR Code Reader 
    </title> 
</head> 

<body> 
    <div class="container"> 
        <img src="../img/logo.png" style="margin: 10px; height: 20%;">
        <div class="section"> 
            <div id="my-qr-reader"> 
            </div> 
        </div> 
    </div> 
    <script
        src="https://unpkg.com/html5-qrcode"> 
    </script> 

    <script>       
    function domReady(fn) { 
        if ( 
            document.readyState === "complete" || 
            document.readyState === "interactive"
        ) { 
            setTimeout(fn, 1000); 
        } else { 
            document.addEventListener("DOMContentLoaded", fn); 
        } 
    } 

    domReady(function () { 

        // If found you qr code 
        function onScanSuccess(decodeText, decodeResult) { 
            var url= "read_qr_meal.php?decodeText="+decodeText; 
            window.location = url;
        } 

        let htmlscanner = new Html5QrcodeScanner( 
            "my-qr-reader", 
            { fps: 10, qrbos: 250 } 
        ); 
        htmlscanner.render(onScanSuccess); 
    });

    </script> 
</body> 
  
</html>