<?php
session_start();

include_once 'dbh.php';
include_once 'Request.php';
include_once 'Validation.php';

class LogIn{
	private $errors = [];

	public function __construct()
    {
        if (Request::method() == 'POST') {
            $this->LogInTheUser();
        } else {
            $this->displayForm();
		}
	}
	private function displayForm()
    {
        $LogInerrors = $this->errors;
        require '../signup.php';          
	}
	private function LogInTheUser()
    {
        if ($this->isValidForm()) {
            if ($this->isValidLogin()) {
                // grant access 
                // store a logged in key in the session
                $_SESSION['user'] = true;
                header("Location:../index.php?signin=Success");
            } else {
                $this->errors['wrong']= 'Invalid Login';
                $this->displayForm(); 

            }
        } else {
            $this->displayForm(); 
		}
	}
	private function isValidForm()
    {
        if (Validation::isEmpty('pwd')) {
            $this->errors['pwd'] = 'pwd is required';
        }
        if (Validation::isEmpty('user')){
            $this->errors['user']= 'User Name Is Required';
		}
		return empty($this->errors);
	}
	public function errors()
    {
        return $this->errors;
	}
	public function isValidLogin()
	{
        
        $user = Request::input('user');
        $pwd = Request::input('pwd');
        
        $sql = "SELECT * FROM users WHERE user= :user and pwd= :pwd";
        $database = db();
        $query = $database->prepare ($sql); 
        
        $query-> bindParam (':user', $user);
        $query-> bindParam (':pwd',  $pwd);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return !empty($result);
    }
}
new LogIn;