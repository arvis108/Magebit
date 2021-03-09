<?php
session_start();
require_once('databasecontroll.php');
require_once('email_class.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    $email = htmlspecialchars($_POST['epasts']);
    if($email == ""){
        array_push($errors,'Email address is required');
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,'Please provide a valid e-mail address');
    }  
    if(preg_match("/co$/", $email)){
        array_push($errors,'We are not accepting subscriptions from Colombia emails');
    }
    if(empty($_POST['term_cb'])){
        array_push($errors,'You must accept the terms and conditions');
    }
    
    
    if (count($errors) == 0) {
        $subscribed_email = new EmailClass($email);
        if($subscribed_email->register($conn)){
            header("location: ../success.php");
        }else{
            $error = 'Unknown';
            header("location: ../index.php?email={$email}&error={$error}");
            exit();
        }
      } else {
        $_SESSION['errors']= $errors;
        header("location: ../index.php?email={$email}");
        exit();
      }
}
?>