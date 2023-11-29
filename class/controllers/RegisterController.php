<?php
// include('config/app.php');
class RegisterController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function registration($name,$email,$password,$phone,$address,$securityquestion,$securityanswer)
    {
        $register_query = "INSERT INTO signup_form(name,email,password,phone,address,securityquestion,securityanswer) VALUES('$name','$email','$password','$phone','$address','$securityquestion','$securityanswer')";
        $result = $this->conn->query($register_query);
        return $result;
    }

    public function isUserExists()
    {
        $checkUser = "SELECT email FROM signup_form WHERE email='$email' LIMIT 1";
        $result = $this->conn->query($checkUser);
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function confirmPassword($password,$cpassword)
    {
        if($password == $cpassword){
            return true;
        }else{
            return false;
        }
    }
}


?>