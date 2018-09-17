<?php
include_once 'dbh.php';
include_once 'Request.php';
include_once 'Validation.php';
// require: stops the code when there is an error "Fatal Error".
// include: just show message that there is an error but continue running the code.
// ISSET  :   check if this variable is exsist or not then to check that this variable is set or not.
// bindparam : pass variables only.
// bindvalue : pass variables and values.

class SignUp
{
    /**
     * @var array $errors
     *
     */
    private $errors = [];

    /**
    * construction
    *
    * if the request method is post go to createNewUser function
    * else go to display form
    */

    public function __construct()
    {
        
        if (Request::method() == 'POST') {
            $this->createNewUser();
        } else {
            $this->displayForm();
        }
    }
    /**
    * Function displayForm To show the errors that happened during the SignUp
    *
    */
    private function displayForm()
    {
        
        $SignUperrors = $this->errors;
        require '../signup.php';
    }
    /**
    * Function createNewUser , If the valid form is correct go to insertTodatabase
    * else go to display form to show the errors
    */
    private function createNewUser()
    {
        
        if ($this->isValidForm()) {
            $this->insertToDatabase();
        } else {
            $this->displayForm(); // with errors
        }
    }
    /**
    * method isValidForm to check the validations rules
    * Function isEmpty To check if the value of input for the all fields is empty or not
    *
    * @return bool isEmpty
    */
    private function isValidForm()
    {
        
        if (Validation::isEmpty('first')) {
            $this->errors['first'] = 'First Name Is Required';
        }
        if (Validation::isEmpty('last')) {
            $this->errors['last'] = 'Last Name Is Required';
        }
        if (Validation::isEmpty('pwd')) {
            $this->errors['pwd'] = 'pwd is required';
        }
        if (Validation::isEmpty('user')) {
            $this->errors['user'] = 'User Name Is Required';
        }
        if (Validation::isEmpty('email')) {
            $this->errors['email'] = 'email is required';
        } elseif (!Validation::isEmail('email')) {
            $this->errors['email'] = 'Invalid email address';
        } elseif (Validation::exists('email')) {
            $this->errors['email'] = 'email address exists';
        }
        return empty($this->errors);
    }
    public function errors()
    {
    /**
    * Function errors to show the errors
    * @return bool errors
    */
        return $this->errors;
    }
    /**
    * function insertToDatabase
    * @var string $first
    * @var string $last
    * @var string $email
    * @var string $user
    * @var  $sql
    * @var  $database
    * @var  $query
    */
    public function insertToDatabase()
    {
        if (isset($_POST['submit'])) {
            $first = $_POST['first'];
            $last = $_POST['last'];
            $email = $_POST['email'];
            $user = $_POST['user'];
            $pwd = $_POST['pwd'];

            $sql = 'INSERT INTO users SET first=:first, last=:last, email=:email, user=:user, pwd=:pwd';
            $database = db();
            $query = $database->prepare($sql);
            $query->bindParam('first', $first);
            $query->bindParam('last', $last);
            $query->bindParam('email', $email);
            $query->bindParam('user', $user);
            $query->bindParam('pwd', $pwd);
            $query->execute();
            header("Location:../signup.php?signup=Success");

        }
    }}
new SignUp;

/* foreach (['first', 'last'] as $name) {
if (Validation::isEmpty($name)) {
$this->errors['first'] = 'first name is required';
} elseif (! Validation::isValidName('first')) {
$this->errors['first'] = 'Invalid first name';
}
}*/
