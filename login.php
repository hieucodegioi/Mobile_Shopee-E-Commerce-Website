<!DOCTYPE html>
<html>

<head>
   <title>Login</title>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>



   <?php
   session_start();
   $email = $password = "";
   $emailErr = $passwordErr = "";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $valid = true;

      if (empty($_POST["email"])) {
         $emailErr = "Email is required";
         $valid = false;
      } else {
         $email = $_POST["email"];
      }

      if (empty($_POST["password"])) {
         $passwordErr = "Password is required";
         $valid = false;
      } else {
         $password = $_POST["password"];
      }

      if ($valid) {
         $conn = new mysqli("localhost", "root", "", "shopee");

         if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
         }

         $selectQuery = "SELECT * FROM users WHERE email='$email'";
         $result = $conn->query($selectQuery);

         if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
               $_SESSION["user_id"] = $row["id"];
               echo "Login successful";
               header("Location: ./index.php"); // Chuyển hướng sau khi đăng nhập thành công
            exit();
            } else {
               echo "Invalid password";
            }
         } else {
            echo "User not found";
         }

         $conn->close();
      }
   }
   ?>
   <div class="container">
      <div class="row">
         <div class="col-md-5 mx-auto">
            <div id="first">
               <div class="myform form ">
                  <div class="logo mb-3">
                     <div class="col-md-12 text-center">
                        <h1>Login</h1>
                     </div>
                  </div>
                  <form method="post" action="">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">

                        <span style="color: red;"><?php echo $emailErr; ?></span><br>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">

                        <span style="color: red;"><?php echo $passwordErr; ?></span><br>
                     </div>
                     <input class=" btn btn-block mybtn btn-primary tx-tfm" type="submit" value="Login">
                     <div class="form-group">
                        <p class="text-center">Don't have account? <a href="register.php" id="signup">Sign up here</a></p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   

</body>

</html>