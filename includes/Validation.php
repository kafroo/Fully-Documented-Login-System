<?php
include_once 'dbh.php';

class Validation { 
    
    public static function isEmpty($inputName)      
    {
        /**
         * Function isEmpty To check if the value of input for the all fields is empty or not 
         * 
         * @var string $inputName
         * return string
         */
        $inputValue = Request::input($inputName);
        return empty($inputValue);
    }
    public static function isEmail($inputName)
    {
        /**
         * Function isEmail To check if the email is valid or not 
         * 
         * @var string $inputName
         * return string
         */
        $inputValue = Request::input($inputName);
        return filter_var($inputValue, FILTER_VALIDATE_EMAIL);
    }
    public static function exists($inputName)
    {
         /**
         * Function exists To check if the email is taken or not by connecting to the database to check for it
         * 
         * @var bool $sql
         * @var  $database
         * @var bool $query
         * @var bool $result
         * return bool
         */
        $sql = "SELECT * FROM users WHERE email= '$inputName'";
        $database = db();
        $query = $database->prepare ($sql);
        $query-> bindParam ('email', $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return empty($query);
        
    }
}
    