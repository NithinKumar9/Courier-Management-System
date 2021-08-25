<?php      
    include('connection.php'); 
    if (empty($_POST['login_id']) || empty($_POST['password'])) //Validating inputs using PHP code 
    { 
        echo 
        "Incorrect Login Id or password";
        header("location: Login.html");
    } 
    else
    {
         
    $username = $_POST['login_id'];  
    $password = $_POST['password'];  
    $designation = "Manager";
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from login where login_id = '$username' and password = '$password' and designation = '$designation' ";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1)
        {  
            $login_session['login_id'] = $username; 
            header("Location: manager_after_login.html");
            
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }  
    }
