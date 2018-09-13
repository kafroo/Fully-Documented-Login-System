<?PHP
class Request
{
    
    public static function input($key)
    {
        /**
     * Function input to check if this variable $key is exsist or not then to check that this variable is set or not
     * @var bool $key
     * return bool|null
     */
        if (isset($_POST[$key])) {           //return isset($_POST[$ey]) ? $_POST[$ey] : null; this is equavilent to this if condition

            return $_POST[$key];
        } else {
            return null;
        }
    }
    public static function method(){
        /**
     * Function method that Returns the request method used to access the page 
     * @Super Global Variable $_SERVER
     * return string
     */
      return  $_SERVER['REQUEST_METHOD'];
    }
}