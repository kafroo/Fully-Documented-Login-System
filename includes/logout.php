<?php
/**
 * If we clicked on logout button close all the sessions and go to the home page again 
 */
if (isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
