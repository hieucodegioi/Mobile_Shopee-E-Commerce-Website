<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>
<?php
    $firstname = $lastname = $email = $password = "";
    $firstnameErr = $lastnameErr = $emailErr = $passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valid = true;

        if (empty($_POST["firstname"])) {
            $firstnameErr = "First name is required";
            $valid = false;
        } else {
            $firstname = $_POST["firstname"];
        }

        if (empty($_POST["lastname"])) {
            $lastnameErr = "Last name is required";
            $valid = false;
        } else {
            $lastname = $_POST["lastname"];
        }

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
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }

        if ($valid) {
            $conn = new mysqli("localhost", "root", "", "shopee");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $insertQuery = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "Registration successful";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
    ?>

    <div class="container">
        <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="second">
                <div class="myform form ">
                    <div class="logo mb-3">
                        <div class="col-md-12 text-center">
                            <h1>Signup</h1>
                        </div>
                    </div>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="Enter FirstName">
                            <span style="color: red;"><?php echo $firstnameErr; ?></span><br>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="Enter Lastname">
                            <span style="color: red;"><?php echo $lastnameErr; ?></span><br>
                        </div>
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

                        <input class=" btn btn-block mybtn btn-primary tx-tfm" type="submit" value="Register">
                        <div class="form-group">
                            <p class="text-center">Already have an account? <a href="./login.php" id="signup">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>