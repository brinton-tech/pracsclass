<?php

// // include('config/app.php');
include_once('controllers/RegisterController.php');
include_once('controllers/LoginController.php');

if(isset($_POST['login'])){
    
    $email = validateInput($db->conn,$_POST['email']);
    $password = validateInput($db->conn,$_POST['password']);

    $auth = new LoginController;
    $checkLogin = $auth->userLogin($email, $password);
    if($checkLogin){
        redirect("Logged in successfully", "home.php");
    }
    else
    {
        redirect("Invalid Email Id or password", "login.php");
    }
}

if(isset($_POST['submit']))
{

    $fname =  validateInput($db->conn,$_POST['firstname']);
    $lname =  validateInput($db->conn,$_POST['lastname']);
    $sname =  validateInput($db->conn,$_POST['surname']);
    $school =  validateInput($db->conn,$_POST['school']);
    $course =  validateInput($db->conn,$_POST['course']);
    $email =  validateInput($db->conn,$_POST['email']);
    $password =  validateInput($db->conn,$_POST['password']);
    $cpassword =  validateInput($db->conn,$_POST['cpassword']);

    $register = new RegisterController;
    $result_password = $register->confirmpassword($password,$cpassword);

    if($result_password)
    {
        $result_user = $register->isUserExists($email);
        if($result_user)
        {
            redirect("Already Email Exists", "index.php");
        }
        else
        {
            $register_query = $register->registration($fname,$lname,$sname,$school,$course,$email,$password);
            if($register_query){
                redirect("Resgistered Successfully","login.php");
            }
            else{
                redirect("something went wrong","signup.php");
            }
        }
        
    }
    else{
        redirect("password and confirm password Does not match", "signup.php");
    }

}



?>