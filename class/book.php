<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>book session</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <?php
   session_start();
   // print_r($_SESSION["user_id"]);
   $emailFromDB =  $_SESSION["user_id"];
   // echo $emailFromDB;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laundry_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `signup_form` WHERE email='$emailFromDB'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
   while($row = $result->fetch_assoc()) {
      // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      $nameFromDB =  $row["name"];
      $emailFromDB = $row["email"];
      $phoneFromDB = $row["phone"];
      $addressFromDB = $row["address"];
      // echo "yessssss";
   }
} else {
   echo "0 results";
}

   ?>

<section class="header">

   <a href="home.php" class="logo">WAAR Laundry & Dry Cleaning</a>

   <nav class="navbar">
      <a href="home.php">Dashboard</a>
      
      <a href="book.php">Book</a>
      
      <a href="logout.php">Log Out</a>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>


<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>Book Your Session Now</h1>
</div>


<section class="booking">

   <h1 class="heading-title">Book Your Cleaning Session: </h1>

   <form action="book_form.php" method="post" class="book-form">

      <div class="flex">
         <div class="inputBox">
            <span>Pick-up/Drop Date :</span>
            <?php
               //  $orgDate = date();  
               //  $newDate = date("Y-m-d", strtotime($orgDate));  
            ?>
            <input type="date" placeholder="please enter your pick-up/drop date" min="<?PHP echo date("Y-m-d"); ?>" max="<?PHP echo date("Y-m-d", strtotime(date("Y-m-d"). ' +  50 days')); ?>" name="date" required>
         </div>
         <div class="inputBox">
            <span>Top Wear(tshirt,top,shirt) :</span>
            <input id = "topwear" type="text" placeholder="enter no of topwear" name="topwear" required>
         </div>
         <div class="inputBox">
            <span>Bottom Wear(lower,jeans,leggins) :</span>
            <input id= "bottomwear" type="text" placeholder="enter no of bottomwear" name="bottomwear" required>
         </div>
         <div class="inputBox">
            <span>Woolen Cloths :</span>
            <input id="woolen" type="text" placeholder="enter number of woolen cloth" name="woolen" required>
         </div>
         <div class="inputBox">
            <span>Others :</span>
            <input id="others" type="text" placeholder="mention other kind of cloths(if any)" name="others" required>
         </div>
         <div class="inputBox">
            <span>Service Type:</span>
            <select name = "servicetype" class = "box drp_btn">
               <option value = "cleaning">Cleaning</option>
               <option value = "dryclean">Dry Clean</option>
               <option value = "stainremoval">Stain Removal</option>
               <option value = "ironing">Ironing</option>
               <option value = "fabriccare">Fabric Care</option>
               <option value = "bleaching">Bleaching</option>

            </select>
         </div>
         <div class="inputBox">
            <span>Name :</span>
            <input id="name" type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input id="email" type="email"  placeholder="enter your email" name="email" required>
         </div> 
         <div class="dropdown">
            <!-- <span>Country Code:</span> -->
            <select name = "countrycode" class = "box drp_btn">
               <option value = "+251">+211</option>
               <option value = "+252">+252</option>
               <option value = "+253">+253</option>
               <option value = "+254">+254</option>
               <option value = "+255">+255</option>
               

            </select>
         </div>

         <div class="inputBox">
            <span>Phone Number :</span>
            <input id= "phoneno" type="tel"  max="9999999999" placeholder="enter your number" name="phone" required>
         </div>


         <div class="inputBox">
            <span>Address :</span>
            <input id="address" type="text" placeholder="enter your pick-up/drop address" name="address" required>
         </div>  
         <div class="inputBox">
            <span >Pin Code :</span>
            <input  id= "phone" type="tel" min="000000" max="999999" placeholder="enter your area code" name="pin" required>
         </div>
         <div class="inputBox">
            <span>Description(if any) :</span>
            <input id="description" type="text" placeholder="if any instructions please mention here" name="description" required >
         </div>

          
         
         <style>
               .drp_btn{
                  min-width:100%;
                  padding: 1.2rem 1.4rem;
                  font-size: 1.6rem;
                  color: var(--light-black);
                  text-transform: none;
                  margin-top: 1.5rem;
                  border:1px solid black;
               }
               #phoneno{
                  position: relative;
                  padding-left: 90px;
               }
               .dropdown{
                  height: 70px;
                  width: 30px;
                  position: absolute;
                  margin-top: 454px;
                  /* margin-left: 760px; */
                  z-index: 11111;

               }
               .box{
                  width: 75px;
               }
               
            </style>
      </div>
      <center>
      <input type="submit" value="Make Payment" class="btn" name="send">
</center>
   </form>

</section>






<script>
         document.getElementById("name").value = "<?php echo $nameFromDB ?>";
         document.getElementById("email").value = "<?php echo $emailFromDB ?>";
         document.getElementById("phoneno").value = "<?php echo $phoneFromDB ?>";
         document.getElementById("address").value = "<?php echo $addressFromDB ?>";
</script>








<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>