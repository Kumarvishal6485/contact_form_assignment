<?php
    include_once 'db/db.php';                // including the database connection file
    if(isset($_POST['submit'])){             //submit button is clicked by the user
        $name = $_POST['name'];              //fetching the name entered by the user  
        $phone = $_POST['phone'];            //fetching the phone number entered by the user
        $email = $_POST['email'];            //fetching the email entered by the user
        $subject = $_POST['subject'];        //fetching the subject entered by the user
        $message = $_POST['message'];        //fetching the message entered by the user
    
        if($name == ''){                      //name required validation
            $name_empty = true;
        }

        if($phone == ''){                     //phone number required validation
            $phone_empty = true;
        }

        if($email == ''){                    //email required validation
            $phone_empty = true;
        }

        if($subject == ''){                  //subject required validation
            $subject_empty = true;
        }

        if($message == ''){                 //message required validation
            $message_empty = true;
        }

        if(preg_match('/[a-zA-Z ]{1,}/',$name) and !isset($name_empty)){        //checking name valid or not
            $is_name = true;
        }
        else{
            $is_name = false;
        }

        if(preg_match('/[0-9]{1,10}/',$phone) and !isset($phone_empty) ){        //checking phone valid or not
            $is_phone = true;
        }
        else{
            $is_phone = false;
        }

        if(preg_match('/[a-zA-Z0-9]{1,}[@]{1}[a-z]{2,5}[\.]{1}[a-z]{2,3}/',$email) and !isset($email_empty) ){    //checking email valid or not
            $is_email = true;
        }
        else{
            $is_email = false;
        }

        if(preg_match('/[a-zA-Z0-9]{1,}/',$subject) and !isset($subject_empty) ){         //checking subject valid or not
            $is_subject = true;
        }
        else{
            $is_subject = false;
        }

        if(preg_match('/[a-zA-Z0-9]{1,}/',$message) and !isset($message_empty)){         //checking message valid or not
            $is_message = true;
        }
        else{
            $is_message = false;
        }

        if($is_name and $is_email and $is_phone and $is_subject and $is_message){            //all the input fields are valid 
            $ip = $_SERVER['REMOTE_ADDR'];                                                   // getting the IP address
            $query = "insert into contact_form ( name , phone , email , subject , message , ip) values('$name' , '$phone' , '$email' , '$subject' , '$message' , '$ip')";         //query to insert all fields in db
            db($query);                         // query sent to db method that's created in db/db.php
        }
    }

    if(isset($name)){                //checking whether form submitted or not (as if it is submitted , we have assigned true to name and reused $name variable)
        if($name){
            unset($_POST);            //destroy all the fields variables
            header("Location: ".$_SERVER['PHP_SELF']);        //redirect to same page 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        input{
            height : 30px;
            width : 240px;
        }

        input[type=submit]{
            color : white;
            background-color : green;
            outline : none;
            width : 70px;
            border : none;
            border-radius : 10px;
            margin-left : 100px;
        }

        span{
            margin-left : 100px;
        }
    </style>
</head>
<body>
    <fieldset>
        <legend>Contact Us</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <table>
                <tr>
                    <td>
                        <label for="name">Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Name" name="name" id="name" value="<?php if(isset($is_name)){if($is_name){ echo $name;}}?>" maxlength="30">
                        <?php 
                            if(isset($is_name) and !isset($name_empty)){
                                if(!$is_name){
                                    ?>
                                        <span style="color:red">*Only a-zA-z characters allowed</span>
                                    <?php
                                }
                            }
                            elseif(isset($name_empty)){
                                ?>
                                        <span style="color:red">*Name is Required</span>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone">Phone Number</label>
                    </td>
                    <td>
                        <input type="tel" placeholder="Enter Phone Number" name="phone" id="phone" value="<?php if(isset($is_phone)){if($is_phone){ echo $phone;}}?>" maxlength="13">
                        <?php 
                            if(isset($is_phone) and !isset($phone_empty)){
                                if(!$is_phone){
                                    ?>
                                        <span style="color:red">*Only 0-9 characters allowed</span>
                                    <?php
                                }
                            }
                            elseif(isset($phone_empty)){
                                ?>
                                        <span style="color:red">*Phone Number is Required</span>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Enter Email" name="email" id="email"value="<?php if(isset($is_email)){if($is_email){ echo $email;}}?>" maxlength="30">
                        <?php 
                            if(isset($is_email) and !isset($email_empty)){
                                if(!$is_email){
                                    ?>
                                        <span style="color:red">*Enter valid Email</span>
                                    <?php
                                }
                            }
                            elseif(isset($email_empty)){
                                ?>
                                        <span style="color:red">*Email is Required</span>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="subject">Subject</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Subject" name="subject" id="subject"value="<?php if(isset($is_subject)){if($is_subject){ echo $subject;}}?>" maxlength="200">
                        <?php 
                            if(isset($is_subject) and !isset($subject_empty)){
                                if(!$is_subject){
                                    ?>
                                        <span style="color:red">*Only a-zA-z0-9 characters allowed</span>
                                    <?php
                                }
                            }
                            elseif(isset($subject_empty)){
                                ?>
                                        <span style="color:red">*Subject is Required</span>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="message">Message</label>
                    </td>
                    <td>
                        <textarea name="message" placeholder=" Enter Message" id="message" cols="30" rows="10"><?php if(isset($is_message)){if($is_message){ echo $message;}}?></textarea>
                        <?php 
                            if(isset($message_empty)){
                                ?>
                                        <span style="color:red">*Message is Required</span>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <input type="submit" value="Submit" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>
