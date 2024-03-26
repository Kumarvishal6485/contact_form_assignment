<?php 
    function db($query){
        $conn = mysqli_connect('localhost','root','','assignment') or die("Can\'t Establish Connection"); // connection with database
        if($conn){                                                  // if connection created succesfully
            $res = mysqli_query($conn,$query);                      // execute the query
            if($res){

                $name = true;                                        // variable to destroy other variables
                //code for sending the mail
                $to = 'abc@gmail.com'; // change mail with owner's mail
                $headers = "From: $email"; // user email
                mail($to,$subject,$message,$headers); // mail function
                echo "<script>alert('Your Response Have been submitted')</script>";  // alert to notify the user that the form have been submitted succesfully
                echo "<script>window.location='index.php</script>";
            }
            else{
                header("location:index.php");
            }
        }
        else{
            header("location:index.php");
        }
    }
?>
