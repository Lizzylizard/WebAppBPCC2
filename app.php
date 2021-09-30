<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test_db";

    // Create connection
    #$con = new mysqli($servername, $username, $password, $database);
    $con = mysqli_connect($servername, $username, $password, $database);
    #$stmt = mysqli_stmt_init($con);
    if (array_key_exists('fname', $_POST)) {
        $fname = $_POST['fname'];
    } else {
        $fname = "";
    }

    // Check connection
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }

    if(!empty($fname)) {
        $nameInDB = mysqli_query($con, "SELECT * FROM test_db.Guests WHERE firstname = '$fname'");
        $rowCount = mysqli_num_rows($nameInDB);
        if(mysqli_num_rows($nameInDB) == 0) {
            #neuer name
            $one = 1;
            $result = mysqli_query($con,"INSERT into test_db.Guests (firstname, count) VALUES ('$fname','$one')");
        } else {
            #inkrementieren
            $result2 = mysqli_query($con,"UPDATE test_db.Guests SET count = count + 1 WHERE firstname = '$fname'");

        }
    }

    $result3 = mysqli_query($con,"SELECT firstname, count FROM test_db.Guests");
        while($row = mysqli_fetch_array($result3)) {
            echo $row['firstname']; // Print a single column data
            echo " :  ";
            echo $row['count'];       // Print the entire row data
            echo nl2br("\n");
}



?>
