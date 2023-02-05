<?php 
    session_start();

    $_SESSION['FUNCTIONS'] = array(
        "F4" => "login_user",
        "F5" => "logout_user",
        "F6" => "register_user",
    );

    if (!isset($_SESSION['CREDENTIALS'])){
        $_SESSION['CREDENTIALS'] = array(
            0 => [
                "index" => 0,
                "name_full" => "Test Admin",
                "name_first" => "Test",
                "name_last" => "Admin",
                "username" => "testadmin",
                "password" => "adminpass",
                "access" => "ADMIN",
            ],
            1 => [
                "index" => 1,
                "name_full" => "Test Member",
                "name_first" => "Test",
                "name_last" => "Member",
                "username" => "testmember",
                "password" => "memberpass",
                "access" => "MEMBER",
            ],
        );
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karl D</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg" style="background-color: pink;">
                <div class="container-fluid">
                    <div class="d-flex">
                        <a class="navbar-brand p-3" href="homePage.php">
                            <img src="../assets/logo.png" alt="">
                        </a>
                    </div>

                    <div class="d-flex ms-auto order-5">   
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-light" aria-current="page" href="homePage.php" style="color: white; margin-right: 5px;">Home</a>
                                </li>
                                <?php
                                    if(isset($_SESSION["ACCESS"])){
                                        checkAccess();
                                    } else {
                                        echo ("
                                            <li class=\""."nav-item\"".">
                                                <a class=\""."nav-link btn btn-outline-light\""." aria-current=\""."page\""." href=\""."loginPage.php\""." style=\""."color: white; margin-right: 5px;\"".">Log in</a>
                                            </li>
                                        ");
                                    }
                                ?>
                            </ul>
                        </div>

                        <div class="navbar-header">
                            <button 
                                class="navbar-toggler" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#navbarNav" 
                                aria-controls="navbarNav" 
                                aria-expanded="false" 
                                aria-label="Toggle navigation"
                            >
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <section class="items">
        <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if (empty($_POST[$_SESSION['FUNCTIONS']["F5"]])){ //order is complete?
                } else {
                    logoutUser();
                }
            } 

            function logoutUser(){
                unset($_SESSION["ACCESS"]);
                unset($_SESSION["FULLNAME"]);
                
                reloadPage();
            }
            
            function checkAccess(){
                if(isset($_SESSION['ACCESS'])){
                    $userAccess = $_SESSION['ACCESS'];
                    if($userAccess == "SUPER"){
                    } else if($userAccess == "ADMIN"){
                        echo ("
                            <form
                                method=\""."post\""."
                                action=\""."homePage.php\""."
                            >
                                <li class=\""."nav-item\"".">
                                    <input type=\""."submit\""." class=\""."nav-link btn btn-outline-light\""." aria-current=\""."page\""." name=\""."logout_user\""." value=\""."Sign out\""." style=\""."color: white; margin-right: 5px;\""."/>
                                </li>
                            </form>
                        ");
                        echo ("
                            <li class=\""."nav-item\"".">
                                <a class=\""." nav-link disabled active\""." aria-current=\""."page\""." style=\""."color: white;\""."> Welcome, ". $_SESSION['FULLNAME'] ."</a>
                            </li>
                        ");
                    } else if($userAccess == "MEMBER"){
                        echo ("
                            <form
                                method=\""."post\""."
                                action=\""."homePage.php\""."
                            >
                                <li class=\""."nav-item\"".">
                                    <input type=\""."submit\""." class=\""."nav-link btn btn-outline-light\""." aria-current=\""."page\""." name=\""."logout_user\""." value=\""."Sign out\""." style=\""."color: white; margin-right: 5px;\""."/>
                                </li>
                            </form>
                            <li class=\""."nav-item\"".">
                                <a class=\""." nav-link disabled active\""." aria-current=\""."page\""." style=\""."color: white;\""."> Welcome, ". $_SESSION['FULLNAME'] ."</a>
                            </li>
                        ");
                    }
                }
            }

            function reloadPage(){
                echo("<meta http-equiv='refresh' content='1'>");
            }
        ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>