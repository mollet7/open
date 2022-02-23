<?php
    session_start();
    //$_SESSION['courseSemister'] = $_POST['courseSemister'];

    //check to see if we’re showing the form or adding the post
    if (!$_POST) {
        //check for required info from the query string
        //if (!isset($_GET['post_id'])) {
        header('Location: ../projects.php?msg=noPost');
        exit;
    }
    try {
            include_once('conn.php'); //create connection

            //create safe values for input into the instructors table 
            $projTitle = $_POST['projTitle']; 
            //$projStatus = $_POST['projStatus'];
            $use_id = $_SESSION['user_id'];

            //check if projTitle already used
            $sthandler = $conn->prepare("SELECT * FROM project WHERE projTitle = :projTitle");
            $sthandler->bindParam(':projTitle', $projTitle);
            $sthandler->execute();
            
            if($sthandler->rowCount() > 0){
                //if projTitle already exist
                //close connection
                $conn = null;
                header('Location: ../projects.php?msg=proj_title_exist');
                exit;

            }else{

                //if projTitle not exist
                    date_default_timezone_set('Africa/Nairobi');
                    
                    // Then call the date functions
                    $date1 = date('Y-m-d H:i:s');

                        // ********* GOOD TO AVOID SQL INJECTION ***********
                        $sthandler = $conn->prepare("INSERT INTO project (projTitle, use_id) VALUES (?, ?)");
                        $sthandler->execute([$projTitle, $use_id]);

                        //close connection
                        $conn = null;
                        header('Location: ../projects.php?msg=success');
                
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

