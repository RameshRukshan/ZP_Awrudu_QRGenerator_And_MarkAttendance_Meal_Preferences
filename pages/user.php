<?php
include_once('../config/config.php'); 

// Check if the decodeText parameter is set in the URL
if (isset($_GET['decodeText'])) {
    // Get the decodeText value
    $decodeText = $_GET['decodeText'];

    // Use the $decodeText in your update queries
    $updateUserQuery = "UPDATE user SET attendance='present' WHERE id = '$decodeText'";
    
    // Get the grade and stuid from the user table
    $getGradeQuery = "SELECT grade, stuid FROM user WHERE id = '$decodeText'";
    $result = $conn->query($getGradeQuery);

    if ($result === false) {
        echo "Error executing grade query: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $grade = $row['grade'];
            $stuid = $row['stuid']; // Add this line to fetch stuid

            // Insert or update into the 'mark' table
            $updateMarkQuery = "INSERT INTO mark (id, stuid, attendance, grade) VALUES ('$decodeText', '$stuid', 'present', '$grade') ON DUPLICATE KEY UPDATE stuid = '$stuid', attendance = 'present', grade = '$grade'";

            // Start a transaction
            $conn->begin_transaction();

            try {
                // Execute the first update query
                if ($conn->query($updateUserQuery) !== TRUE) {
                    throw new Exception("Error updating user attendance: " . $conn->error);
                }

                // Execute the second update query
                if ($conn->query($updateMarkQuery) !== TRUE) {
                    throw new Exception("Error updating mark table: " . $conn->error);
                }

                // Commit the transaction if both queries are successful
                $conn->commit();
                
                echo "Attendance and grade updated successfully";
                header("Location: http://localhost/QR/test/pages/read_qr.php");
                exit();
            } catch (Exception $e) {
                // Rollback the transaction if there's an error
                $conn->rollback();

                echo "Transaction failed: " . $e->getMessage();
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "No rows returned for grade query";
        }
    }
} else {
    // Handle the case when decodeText is not provided in the URL
    echo "Decode text not provided in the URL";
}
?>
