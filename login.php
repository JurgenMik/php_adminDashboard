<?php

  session_start();

?>

<!doctype html>
<html>
<head>
   <title> Login </title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel='stylesheet' href='login.css'>

   <style>

       .info1{

           font-family: revert;
           font-size: 22px;
           text-align: center;
           margin-top: 36%;
           color: #323232;

       }

   </style>

</head>
<body>

        <div class="row">
           <div class="col-7">
             <div class="info1">
               <p> <strong>Email </strong> 1 = competitor1@skill17.com</p>
               <p> Password 1 = demopass1</p>
               <p> <strong> Email </strong> 2 = competitor2@skill17.com</p>
               <p> Password 2 = demopass2</p>
              </div>
            </div>
            <div class="col-5">
              <div class="vorm">
               <form action="loginAuth.php" method="POST">
                 <label> Email: </label>
                 <input type="email" name="email">
                 <label> Password: </label>
                 <input type="password" name="password">
                 <button style="margin-bottom: 30px;" class="btn btn-dark" type="submit" name="signIn"> SIGN IN </button>
               </form>
            </div>

            <?php

              echo "<div class='alert-danger' style='font-size: 20px; width: 30%; justify-content: center; display: flex; margin: auto;'>" . $_SESSION['error'] . "</div>";
              echo "<div class='alert-danger' style='font-size: 20px; width: 30%; justify-content: center; display: flex; margin: auto;'>" . $_SESSION['error1'] . "</div>";

               session_unset();

            ?>

          </div>
       </div>

</body>
</html>