<?php

require_once('includes/configuration.php');
require_once('includes/session_check.php');

if(isset($_POST))
{

        $register=sanitize_new_string($_POST['register']);

        if(isset($_POST['name']))
        {
        $name=sanitize_new_string($_POST['name']);
        }
        $email=sanitize_new_string($_POST['email']);
        $pass=sanitize_new_string($_POST['password']);

        $q="select * from users where email='".$email."'";
        $s=mysqli_query($conn,$q);
        $c=mysqli_num_rows($s);

        if($register==0)
        {
            if($c==1)
            {
                $password=hash('sha256',$pass);
              echo  $q1="select * from users where email='".$email."' and password='".$password."'";
                $s1=mysqli_query($conn,$q1);
              echo  $c1=mysqli_num_rows($s1);

                if($c1==1)
                {
                    $_SESSION['username']=$email;
                    header('Location:welcome.php');
                    exit();
                }
                else
                {
                
                }
            }
            else
            {
                echo 'aaaaaaaa';
            }

        }
        else  if($register==1)
        {
                
                    if($c>0)
                    {
                        header('Location:register.php?err=1');
                        exit();
                    }
                    else if($c==0)
                    {
                            $pass=hash('sha256',$pass);
                            $insert="INSERT INTO users (name,email,password) VALUES('$name','$email','$pass')";
                            $qinsert=mysqli_query($conn,$insert);
                            if($qinsert)
                            {
                                header('Location:register.php?suc=1');
                                exit();

                            }
                            else
                            { 
                                header('Location:login.php?suc=1');
                                exit();

                            }


                    
                        
                    }
        }


}
else
{
    die("An error occurred. May please try again");
    exit();
}

function sanitize_new_string($str)
{
    global $conn;
    $str=str_replace('@','',$str);
    $str=str_replace('#','',$str);
    $str=str_replace('>','',$str);

    return $str;

}






?>