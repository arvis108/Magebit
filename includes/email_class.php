<?php
class EmailClass
{
    private $email;
    public function __construct($email)
    {
            $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function register($conn){
        //Check if email is not already used
        $stmt = $conn->prepare('SELECT * FROM emails WHERE email = ?');
        $stmt->execute([$this->email]);
        if ($stmt->rowCount() > 0) {
            $error = 'You are already subscribed to our newsletter';
            header("location: ../index.php?email={$this->email}&error={$error}");
            exit();
            } else{
                //if email is not taken, add to data base
            $stmt = $conn->prepare('INSERT INTO emails (email) VALUES (?)');
            if($stmt->execute([$this->email])){
                return true;
            } else{
                return false;
        }  
    }  
    }
}