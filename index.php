<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <script src="https://kit.fontawesome.com/60bfce93ff.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Icons does not work when JavaScript is disabled -->

    <title>Magebit Test</title>
</head>
<body>
    <div class="row">
    <div class="column left">
        <div class="navigation-bar">
            <div class="logo">
                <img src="./images/Union.png" class="union">
                <img src="./images/pineapple..png" class="pineaple">
            </div>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">How it works</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="content">
            <img src="./images/success.png" alt="successfully" class="success hidden">
            <div class="teksts" id="teksts">

                <div class="heading">
                    <h1 id="head">Subscribe to newsletter</h1>
                </div>
                <div class="subheading">
                    <p id="subhead">Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
                </div>
            </div>
            <form name="myForm" id="form" class="email_form" method="POST" action="includes/validation.php">
                <div class="input_box">
                    <div class="line"></div>
                    <input type="text" class = "epasts" placeholder="Type your email adress here..." name="epasts" id="epasts" value="<?php echo isset($_GET['email']) ?  htmlspecialchars($_GET['email']) : ''; ?>">
                    <button class="myButton" type="submit" id="btn_arrow" name="submit"><img src="./images/ic_arrow.png" class="arrow"></button>
                    <p class="msg"><?php
                    if(isset($_SESSION['errors'])){
                        $array = $_SESSION['errors'];
                        // echo all errors at once
                        // foreach($array as $val) {
                        //     echo $val.'<Br>';
                        //   }
                        echo $array[0];
                        unset($_SESSION['errors']);
                    }elseif(isset($_GET['error'])) {
                        echo $_GET['error'];
                    } else{
                        echo '';
                    }?></p>
                    
                </div>
                <div class="container" id="cont">
                <input type="checkbox" class="cb" id="terms" name="term_cb">     
                <span>I agree to <a href="#">terms of service</a></span>
                </div>
            </form>
            

            <div class="h-line">
            </div>

            <div class="icons">
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram"></i></i></a>
                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="column right">
    </div>

    <script>
        $(document).ready(function () {
            //disables submit button
            $(':input[type="submit"]').prop('disabled', true);
            //live validation
            $('.epasts,.cb').on('keypress keydown keyup click',function(){
                    if (!validateForm()) {
                    // there is a mismatch, hence show the error message
                        $('.msg').show();
                    }else{
                        // else, hide message and enable submit button
                        $(':input[type="submit"]').prop('disabled', false);
                        $('.msg').addClass('hidden');
                    }
                });
                $("form").submit(function(e){
                    //Prevent the default submit
                        e.preventDefault(e);
                            $.ajax({
                                type: 'post',
                                url: 'includes/validation.php',
                                data: $('form').serialize(),
                                success: function(response) {
                                        $('.email_form').addClass('hidden');
                                        $('.container').addClass('hidden');
                                        $('.content').addClass('margins');
                                        $('.success').removeClass('hidden');
                                        $('#head').text('Thanks for subscribing!');
                                        $('#subhead').text('You have successfully subscribed to our email listing. Check your email for the discount code.');
                            }
                        });
                        });           
            });      
    </script>
    <script src="./includes/code.js"></script>
    </div>
</body>
</html>