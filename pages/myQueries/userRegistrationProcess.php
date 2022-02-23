<?php
    session_start();
    //$_SESSION['courseSemister'] = $_POST['courseSemister'];

    //check to see if we’re showing the form or adding the post
    if (!$_POST) {
        //check for required info from the query string
        //if (!isset($_GET['post_id'])) {
        header('Location: ../userRegistration.php?msg=noPost');
        exit;
    }
    try {
            include_once('conn.php'); //create connection

            //create safe values for input into the instructors table 
            $user_name = $_POST['user_name']; 
            $u_email = $_POST['u_email'];
            $u_password = $_POST['password'];
            $user_role = $_POST['user_role']; 

            $file = rand(1000,100000)."-".$_FILES['picture']['name'];
            $file_loc = $_FILES['picture']['tmp_name'];
            $file_size = $_FILES['picture']['size'];
            $file_type = $_FILES['picture']['type'];
            $folder="../uploads/"; 
            // new file size in KB
            $new_size = $file_size/1024;  
            // new file size in KB
            // make file name in lower case
            $new_file_name = strtolower($file);
            // make file name in lower case
            $final_file = str_replace(' ','-',$new_file_name);

            //check if user_name already used
            $sthandler = $conn->prepare("SELECT * FROM users WHERE user_name = :user_name");
            $sthandler->bindParam(':user_name', $user_name);
            //$sthandler->bindParam(':u_email', $u_email);
            $sthandler->execute();
            
            if($sthandler->rowCount() > 0){
                //if user_name already exist
                //close connection
                $conn = null;
                header('Location: ../userRegistration.php?msg=user_name_exist');
                exit;

            }else{

                    //check if u_email already used
                    $sthandler = $conn->prepare("SELECT * FROM users WHERE u_email = :u_email");
                    //$sthandler->bindParam(':user_name', $user_name);
                    $sthandler->bindParam(':u_email', $u_email);
                    $sthandler->execute();

                    if($sthandler->rowCount() > 0){
                        //if u_email already exist
                        //close connection
                        $conn = null;
                        header('Location: ../userRegistration.php?msg=u_email_exist');
                        exit;
                    }

                //if username or email not exist
                    //insert instructors records into user_login table
                    date_default_timezone_set('Africa/Nairobi');
                    
                    // Then call the date functions
                    $date1 = date('Y-m-d H:i:s');

                    if(move_uploaded_file($file_loc,$folder.$final_file)){

                        // ********* GOOD TO AVOID SQL INJECTION ***********
                        $sthandler = $conn->prepare("INSERT INTO users (user_name, u_email, u_password, user_role, picture) VALUES (?, ?, ?, ?, ?)");
                        $sthandler->execute([$user_name, $u_email, $u_password, $user_role, $final_file]);

                        //close connection
                        $conn = null;
                        header('Location: ../userRegistration.php?msg=success');
                    }else{
                        $conn = null;
                        header('Location: ../userRegistration.php?msg=sysError');
                    }
                
            }
        }
    catch(PDOException $e){
        if($e->errorInfo[1] === 1062){
        echo 'Duplicate entry';
        }else{
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null; //close connection
    }
?> 

