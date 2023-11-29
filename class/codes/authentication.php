<?php
// include('config/app.php');
include_once('controllers/RegisterController.php');

if(isset($_POST['send']))
{
    $name = validateInput($db->conn,$_POST['name']);
    $email = validateInput($db->conn, $_POST['email']);
    $password=validateInput($db->conn, $_POST['password']);
    $cpassword=validateInput($db->conn, $_POST['cpassword']);
    $phone = validateInput($db->conn, $_POST['phone']);
    $address = validateInput($db->conn, $_POST['address']);
    $securityquestion = validateInput($db->conn, $_POST['securityquestion']);
    $securityanswer = validateInput($db->conn, $_POST['securityanswer']);

    $register = new RegisterController;
    $result_password = $register->confirmPassword($password,$cpassword);
    if($result_password)
    {
        $result_user = $register->isUserExists($email);
        if($result_user){
            redirect("Already Email Exists", "index.php");
        }else{
            $register_query = $register->registration($name, $email, $password, $phone, $address, $securityquestion, $securityanswer);
            if($register_query){
                redirect("Registered Successfully", "signup.php");
            }else{
                redirect("Something went Wrong", "signup.php");
            }
        }
    }
    else
    {
        redirect("Password and Confirm Password Does not match", "signup.php");
    }
    
}


?>