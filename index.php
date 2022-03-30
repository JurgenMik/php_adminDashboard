<?php

  session_start();

?>
<!doctype html>
<html>
<head>
  <title> Dashboard </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel='stylesheet' href='index.css'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

  <style>

   body {

       overflow-x: hidden;

   }

   .sideMenu{

       transition: 0.3s;

   }

   #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    margin-right: 50px;
    margin-top: 50px;
    width: 92%;
  }

  #customers td, th {
    padding: 4px;
    padding-left: 10px;
  }


  #customers tr {
    background-color: #D3D3D3;
    line-height: 45px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
  }

  col-8{

      height: 100%;
  }

  #lisa{
      margin-left: 250px;
  }

  </style>

</head>
<header>

    <!-- -->

    <div id="side-menu" class="sideMenu">
       <a href="javascript:void(0)" style="color:red;" class="closebtn" onclick="closeNav()" name="kinni"> &times;</a>
       <div class="main-menu">
            <h3 style="font-family: inherit;"> Add New Entry</h3>

            <form action="" method="POST" id="data">

                <label> Date * </label>
                <input name="date">

                <label> Type * </label>
                <input name="type">

                <label> Category * </label>
                <input name="category">

                <label> Time * </label>
                <input name="time">

                <label> Notes </label>
                <input name="notes">

                <label> Tags * </label>
                <input name="tags">

                <button id="lisa" class="btn btn-primary" type='submit' name="addE"> ADD ENTRY </button>

            </form>

        </div>
     </div>


</header>
<body>

<?php

    require_once "phpmysql.php";

    if (isset($_POST["addE"])){

      $_SESSION['alert'] = "Entry Added";
      $User_FK = $_SESSION['nimi'];

       $date = $_POST["date"];
       $type = $_POST["type"];
       $category = $_POST["category"];
       $time = $_POST["time"];
       $notes = $_POST["notes"];
       $tags = $_POST["tags"];

       $insert_query = "INSERT INTO ENTRIES(User_FK, Date , Type , Category , Spent_time , Notes , Tags)VALUES('".$User_FK."', '".$date."', '".$type."', '".$category."', '".$time."' , '".$notes."', '".$tags."')";
       $i = $conn->query($insert_query);


    }

    ?>

  <section>

        <div class="row navrida">
          <div class="col-2 text-center">
            <button onclick="openNav();" class="btn btn-primary"> + ADD NEW </button>
          </div>
           <div class="col-8"></div>
            <div class="col-2 text-center">
                <span class="align-items-center" style="padding-right: 40px; font-size: 20px; color: white">

                <?php

                  echo $_SESSION['nimi'] . "<span style='padding-left: 12px;'>" . $_SESSION['pnimi'] . "</span>";

                ?>

                 </span>
             <button class="btn btn-primary" onclick="location.href = 'logout.php'"> SIGN OUT </button>
             <!-- if isset btn unset session -->
          </div>
        </div>

  </section>

        <!-- Lehe jaotamine -->

       <div class="row">
         <div class="col-4 lists">
           <div class="list">
            <div draggable="true" class="icard1 list-item">
               <h5> Logged working hours </h5>
              <div class="row text-center">
               <div class="timelog">
                   <?php

                   $User_FK = $_SESSION['nimi'];
                   $conn = mysqli_connect("localhost", "mikkjurgeniktkhk_Matis", "Lollakas123", "mikkjurgeniktkhk_voistlus");

                    $sql = "SELECT SUM(Spent_time) AS Spent_time FROM ENTRIES WHERE User_FK = '".$User_FK."';";
                    $result = $conn->query($sql);

                    if ($conn && $result->num_rows > 0) {
                  // output data of each row
                    while($row = $result->fetch_assoc()) {

                    $tunnid = $row['Spent_time'];

                   }

                 } else {

                    echo "0 results";

                 }
                     echo "<h4>" .$tunnid. "h". "</h4>";

                   ?>

                  <span style="font-size: 13px; font-weight: bold;"> Total </span>

              </div>
              <div class="timelog">

                  <?php

                    $conn = mysqli_connect("localhost", "mikkjurgeniktkhk_Matis", "Lollakas123", "mikkjurgeniktkhk_voistlus");

                    $sql = "SELECT Spent_time FROM ENTRIES WHERE month(Date) = month(now())-1 AND User_FK = '".$User_FK."';";
                    $result = $conn->query($sql);

                    if ($conn && $result->num_rows > 0) {
                  // output data of each row
                    while($row = $result->fetch_assoc()) {

                    $kuuTunnid = $row['Spent_time'];

                    echo "<h4>".$kuuTunnid."h"."</h4>";

                   }

                 } else {

                    echo "<h4>"."0h"."</h4>";

                 }
                   ?>

                 <span style="font-size: 13px; font-weight: bold;"> Last month </span>
              </div>
             </div>
            </div>
          </div>

        <!-- Info kaardid -->

        <div class="list">
         <div draggable="true" class="icard2 list-item">
           <h5> 12 months overview </h5>
         </div>
       </div>


        <div class="list">
         <div draggable="true" class="icard3 list-item">
            <h5> Categories </h5>
        </div>
       </div>

       <div class="list">
        <div draggable="true" class="icard4 list-item">
          <h5> Used technologies </h5>
          <div class="tags">

              <span style="background-color: #008a91; border-radius: 3px; padding-right: 2px;"> Html </span>  <span style="background-color: #008a91; padding-left: 5px; padding-right: 5px; border-radius: 3px;"> Css </span>  <span style="background-color: #008a91; padding-right: 5px; border-radius: 3px;"> React </span>
              <span style="background-color: #008a91; border-radius: 3px;"> Back-End </span>

           </div>
         </div>
        </div>
      </div>

     <div class="col-8">

     <!-- tabel -->
      <div id='log_results'></div>


      <?php

        $conn = mysqli_connect("localhost", "mikkjurgeniktkhk_Matis", "Lollakas123", "mikkjurgeniktkhk_voistlus");
        $User_FK = $_SESSION['nimi'];

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

         $sql = "SELECT Date, Type, Category, Spent_time , Notes, Tags FROM ENTRIES WHERE User_FK= '".$User_FK."';";
         $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       $tul1 = "<table id='customers'><tbody><tr><th> Date <button type='submit' onclick='sortByDate()' style='color:black; margin-left: 3px;' class='fas fa-sort'></button> </th><th> Type <i style='color:black; margin-left: 3px;' class='fas fa-sort'></i> </th><th> Category <i style='color:black; margin-left: 3px;' class='fas fa-sort'></i>  </th><th> Spent_time <i style='color:black; margin-left: 3px;' class='fas fa-sort'></i>  </th><th> Notes </th><th> Tags </th><th></th></tr>";
       // output data of each row
       $tul2;
       while($row = $result->fetch_assoc()) {

         $tul2.= "<tr><td>".$row["Date"]."</td><td>".$row["Type"]."</td><td>".$row["Category"]."</td><td>".$row["Spent_time"]."</td><td>".$row["Notes"]."</td><td>".$row["Tags"]."</td><td><i style='justify-content: center ; display: flex;' class='fas fa-pencil-alt'></i></td></tr>";
      }
       $tul3 = "</tbody></table>";
       $tulemus = $tul1.$tul2.$tul3;
    echo $tulemus;

  } else {

      echo "Error getting Data";
  }


?>

    <?php

    if (isset($_POST["addE"])){


       echo "<div style=' margin-top: 250px;display: flex; float:right; padding: 22px; padding-right: 90px; color: white; font-size: 20px' class='bg-dark'>";
       echo  "<strong>" ."Entry Added". "</strong>";
       echo "<button style='color:red; margin-left: 15px; font-size: 30px; outline: none;' aria-hidden='true' onClick='deleteDiv()'type='button' class='close' aria-label='Close'>&times; </button>";
       echo  "</div>";

    }


    ?>

 <script src='index.js'></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

</body>
</html>
