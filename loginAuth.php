<?php

     if(isset($_POST["signIn"])){

      session_start();

       $conn = mysqli_connect("localhost", "mikkjurgeniktkhk_Matis", "Lollakas123", "mikkjurgeniktkhk_voistlus");

       $email = $_POST['email'];
       $passw = $_POST['password'];

       $sql = "SELECT id FROM USERS WHERE email = '".$email."'";
       $result = $conn->query($sql);

     // If email does not exist
     if($result->num_rows == 0) {

         $_SESSION['error'] = "Failed to log in. Wrong Email.";

         header("location: login.php");

     // If email exists
     } else {
         $sql = "SELECT Password FROM USERS where Email='".$email."'";
         $result1 = $conn->query($sql);
         if ($conn && ($result1->num_rows > 0))
        {
            // output data of each row
            while($row = $result1->fetch_assoc())
            {
                $password = $row['Password'];
            }
        }

        if (password_verify($passw, $password)) {

              // Store data in session variables

             // session_start();

              $sql = "SELECT FirstName, LastName FROM USERS WHERE Email = '".$email."'";
              $result2 = $conn->query($sql);

             // $usname = $result2-> fetch_array()['FirstName'];

             // output data of each row
               while($row = $result2->fetch_assoc())
              {

                $username1 = $row['FirstName'];
                $lastname1 = $row['LastName'];

             }

               $_SESSION['nimi'] = $username1;
               $_SESSION['pnimi'] = $lastname1;


              // session_start();

              // $_SESSION['nimetus'] = $email;

               header("location: index.php");


            //$_SESSION["name"] = $sql;

            // echo '<script type="text/javascript"> window.open("dashboard.php","_self");</script>';



        } else {


            $_SESSION['error1'] = "Failed to log in. Wrong password.";

            header("location: login.php");


        }

    };
 }

?>
