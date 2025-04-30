<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
---- Include the above in your HEAD tag -------- -->

<!DOCTYPE html>
<html>
    
<head>
	<title>Online Voting System</title>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="./Assets/css/index.css">
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
</head>
<!-- coded with abdul samamd -->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div>
				</div>

                <?php
                    if(isset($_GET['sign-up'])){
                    ?>
                    <div class="d-flex justify-content-center form_container " style="color:grey;" >
					<form method ="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="su_username" class="form-control input_user"  placeholder="username" required />
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="number" name="su_contact_no" class="form-control input_pass"  placeholder="Contact Number" required />
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="su_password" class="form-control input_pass"  placeholder="Password" required />
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="su_repassword" class="form-control input_pass"  placeholder="Retype-Password" required />
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="signup" class="btn login_btn">Sign UP</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Already Have Account? <a href="index.php" class="ml-2">Sign In</a>
					</div>
					
				</div>
                    <?php
                    
                    }else{
                     ?>
                     <div class="d-flex justify-content-center form_container">
					<form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="contact_no" class="form-control input_user" value="" placeholder="Contact no" required>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password" required>
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="loginBtn" class="btn login_btn">Login</button>
				   </div>
					</form> 
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="?sign-up=1" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div>
                     <?php
                    }
                ?>
				<?php
				if(isset($_GET['registered']))
				{
				?>
						<span class="bg-white text-success text-center my-3 ">your account has been create succesfly</span>
				<?php
				}else if(isset($_GET['invalid'])){
					?>
						<span class="bg-white text-danger text-center my-3 ">Unmatch PASSWORD_BCRYPT</span>
				<?php

				}
				?>




				
			</div>
		</div>
	</div>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
</body>
</html>
<?php
require_once("admin/includes/config.php");

if (isset($_POST['signup'])) {

    $su_username = mysqli_real_escape_string($db, $_POST['su_username']);
    $su_contact_no = mysqli_real_escape_string($db, $_POST['su_contact_no']);
    $su_password = mysqli_real_escape_string($db, $_POST['su_password']);
    $su_repassword = mysqli_real_escape_string($db, $_POST['su_repassword']);
    $user_role = "Voter";

    if ($su_password == $su_repassword) {
        // Hash the password for security
        $hashed_password = password_hash($su_password, PASSWORD_DEFAULT);
        $hashed_repassword = password_hash($su_repassword, PASSWORD_DEFAULT);

        // Prepare insert query
        $query = "INSERT INTO users (username, Contact_no, password, user_role) 
                  VALUES ('$su_username', '$su_contact_no', '$hashed_password', '$user_role')";

        if (mysqli_query($db, $query)) {
            echo "<script>location.assign('index.php?sign-up=1&registered=1');</script>";
        } else {
            die("Error inserting data: " . mysqli_error($db));
        }
    } else {
        echo "<script>location.assign('index.php?sign-up=1&invalid=1');</script>";
    }else if(isset($_POST['loginBtn']))
	{
		$contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
		$password = mysqli_real_escape_string($db, sha1($_POST['password']));
   
		contact_no  password   loginBtn
	}
}
?>



<!-- 51 min -->