<?php 
    session_start(); 
    // session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karl D : Register</title>
    <link rel="icon" type="image/x-icon" href="../assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="midterm.css">
</head>
<body class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg" style="background-color: pink;">
            <div class="container-fluid d-flex justify-content-center">
                <a class="navbar-brand" href="homePage.php">
                    <img src="../assets/logo.png" alt="">
                </a>
            </div>
            </nav>
        </div>
    </div>

    <?php
        $CREDENTIALS = $_SESSION['CREDENTIALS'];

        function printRegister(){
            ?>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="row card-login">
                        <div class="col-12 mt-4"><h2>Register</h2></div>
                        <div class="col-12">
                            <section class="items">
                                <form
                                    method="post"
                                    action="registerPage.php"
                                >
                                    <p>
                                        First Name: 
                                        <input
                                            type="text"
                                            class="form-control form-rounded"
                                            name="name_first"
                                        />
                                    </p>
                                    <p>
                                        Last Name: 
                                        <input
                                            type="text"
                                            class="form-control form-rounded"
                                            name="name_last"
                                        />
                                    </p>
                                    <p>
                                        Username: 
                                        <input
                                            type="text"
                                            class="form-control form-rounded"
                                            name="username"
                                        />
                                    </p>
                                    <p>
                                        Password: 
                                        <input
                                            type="password"
                                            class="form-control form-rounded"
                                            name="password"
                                        />
                                    </p>
                                    <p>
                                        <input 
                                            type="submit"
                                            name="register_user"
                                            class="btn"
                                            value="Register"
                                            style="color: white; background-color: #80b444"
                                        />
                                    </p>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            <?php
        }

        function printError(){
            ?>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="row card-login">
                        <div class="col-12 mt-4"><h3 style="color: red;">Invalid Details</h3></div>
                        <div class="col-12">
                            <section class="items">
                                <form
                                    method="post"
                                    action="registerPage.php"
                                >
                                    <p>
                                        First Name: 
                                        <input
                                            type="text"
                                            class="form-control form-rounded"
                                            name="name_first"
                                        />
                                    </p>
                                    <p>
                                        Last Name: 
                                        <input
                                            type="text"
                                            class="form-control form-rounded"
                                            name="name_last"
                                        />
                                    </p>
                                    <p>
                                        Username: 
                                        <input
                                            type="text"
                                            class="form-control form-rounded"
                                            name="username"
                                        />
                                    </p>
                                    <p>
                                        Password: 
                                        <input
                                            type="password"
                                            class="form-control form-rounded"
                                            name="password"
                                        />
                                    </p>
                                    <p>
                                        <input 
                                            type="submit"
                                            name="register_user"
                                            class="btn"
                                            value="Register"
                                            style="color: white; background-color: #80b444"
                                        />
                                    </p>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            <?php
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST[$_SESSION['FUNCTIONS']["F6"]])){ //register user
                printRegister();
            } else {
                //check if details are valid || fit guideline
                //else append details to CREDENTIALS
                $providedFirstName = $_POST['name_first'];
                $providedLastName = $_POST['name_last'];
                $providedFullName = $providedFirstName . " " . $providedLastName;
                $providedUsername = $_POST['username'];
                $providedPassword = $_POST['password'];

                
                if($error = checkUser($CREDENTIALS, $providedUsername)){
                    $error = checkPass($CREDENTIALS, $providedPassword);
                    $index = count($CREDENTIALS) + 1;
                    array_push($CREDENTIALS, 
                        [
                            $index => [
                            "index" => $index,
                            "name_full" => $providedFullName,
                            "name_first" => $providedFirstName,
                            "name_last" => $providedLastName,
                            "username" => $providedUsername,
                            "password" => $providedPassword,
                            "access" => "MEMBER",
                            ]
                        ]
                    );

                }

                if(!$error){
                    $error = loginUser($providedUsername, $providedPassword);
                    if(!$error){
                        $_SESSION['CREDENTIALS'] = $CREDENTIALS;
                        ?> <meta http-equiv="refresh" content="0;url=http://localhost/ITDOM2/Sem_2/login/pages/homePage.php"> <?php
                    } else {
                        printError();
                    }
                } else {
                    printError();
                }
            }
        } else {
            printLogin();
        } 

        function checkUser($CREDENTIALS, $user){
            foreach ($CREDENTIALS as $user => $userDetails){
                if(in_array($_POST['username'], $CREDENTIALS[$user], false)){
                    $_SESSION["USER_DETAILS"] = $userDetails;
                    return(False);
                } 
            }
            return(True);
        }

        function checkPass($CREDENTIALS, $user){
            foreach ($CREDENTIALS as $user => $userDetails){
                if(in_array($_POST['username'], $CREDENTIALS[$user], false)){
                    $_SESSION["USER_DETAILS"] = $userDetails;
                    return(False);
                } 
            }
            return(True);
        }
        
        function loginUser($providedUser, $providedPass){
            $USERNAME = $_SESSION["USER_DETAILS"]["username"];
            $PASSWORD = $_SESSION["USER_DETAILS"]["password"];

            if(strcmp($USERNAME, $providedUser) == 0){
                if (strcmp($PASSWORD, $providedPass) == 0){
                    $ACCESS = $_SESSION["USER_DETAILS"]["access"];
                    $FULLNAME = $_SESSION["USER_DETAILS"]["name_full"];
                    $_SESSION['ACCESS'] = $ACCESS;
                    $_SESSION['FULLNAME'] = $FULLNAME;
                    return(False);
                } else {
                    return(True);
                }
            } else {
                return(True);
            }  
            return(True);
        }

        function getUsername($user){
            $username = $user['username'];
            return($username);
        }
        function getPassword($user){
            $password = $user['password'];
            return($password);
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">


                                        // echo ("
                                        //     <li class=\""."nav-item\"".">
                                        //         <a class=\""."nav-link btn btn-outline-light\""." aria-current=\""."page\""." href=\""."registerPage.php\""." style=\""."color: white; margin-right: 5px;\"".">Register</a>
                                        //     </li>
                                        // ");

    </script>
</body>
</html>

