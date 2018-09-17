<?php
session_start();

include_once 'dbh.php';
include_once 'Request.php';
include_once 'Validation.php';

class LogIn
{
    /**
    * @var array $errors
    *
    */
    private $errors = [];

    /**
    * construction
    *
    * if the request method is post go to LogInTheUser function
    * else go to display form
    */

    public function __construct()
    {
        if (Request::method() == 'POST') {
            $this->LogInTheUser();
        } else {
            $this->displayForm();
        }
    }
    /**
    * Function displayForm To show the errors that happened during the login
    *
    */
    private function displayForm()
    {
        $LogInerrors = $this->errors;
        require '../signup.php';
    }
     /**
    * Function LogInTheUser, If the valid form is correct go to isValidLogin
    * else go to displayForm to show the error
    */
    private function LogInTheUser()
    {
        if ($this->isValidForm()) {
            if ($this->isValidLogin()) {
                // grant access
                // store a logged in key in the session
                $_SESSION['user'] = true;
                header("Location:../index.php?signin=Success");
            } else {
                $this->errors['wrong'] = 'Invalid Login';
                $this->displayForm();

            }
        } else {
            $this->displayForm();
        }
    }
    /**
    * method isValidForm to check the validations rules
    * Function isEmpty To check if the value of input for paswword and user fields is empty or not
    *
    * @return bool isEmpty
    */
    private function isValidForm()
    {
        if (Validation::isEmpty('pwd')) {
            $this->errors['pwd'] = 'pwd is required';
        }
        if (Validation::isEmpty('user')) {
            $this->errors['user'] = 'User Name Is Required';
        }
        return empty($this->errors);
    }
    /**
    * Function errors to show the errors
    * @return bool errors
    */
    public function errors()
    {
        return $this->errors;
    }

    public function isValidLogin()
    {
        /**
         * function isValidLogin 
         * @var string $user
         * @var string $pwd
         * @var  $sql
         * @var  $database
         * @var  $query
         */
        $user = Request::input('user');
        $pwd = Request::input('pwd');

        $sql = "SELECT * FROM users WHERE user= :user and pwd= :pwd";
        $database = db();
        $query = $database->prepare($sql);

        $query->bindParam(':user', $user);
        $query->bindParam(':pwd', $pwd);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return !empty($result);
    }
}
new LogIn;
