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
            include('conn.php'); //create connection

            //create safe values for input into the plots table 
            //$filename = $_FILES['file']['tmp_name'];
            //if ($_FILES['file']['size'] > 0) {

            //$file_loc = $_FILES['picture']['tmp_name'];
            //$file_size = $_FILES['picture']['size'];

                //$file = fopen($filename, "r");
                $plots = $_POST['pnumber'];
                $size = $_POST['psize'];
                $status = $_POST['proStatus'];
                $projId = $_POST['projId'];
                $use_id = $_SESSION['user_id'];
                $block = $_POST['block'];

                $sthandler = $conn->prepare("SELECT * FROM plots WHERE plotNo = :plot AND block = :block AND projId = :projId");
            $sthandler->bindParam(':plot', $plots);
            $sthandler->bindParam(':block', $block);
            $sthandler->bindParam(':projId', $projId);
            $sthandler->execute();
            
            if($sthandler->rowCount() > 0){
                //if projTitle already exist
                //close connection
                $conn = null;
                header('Location: ../projects.php?msg=proj_title_exist');
                exit;

            }else{
                $sthandler = $conn->prepare("INSERT INTO plots (plotNo, plotSize, block, plotStatus, projId, use_id) VALUES (?, ?, ?, ?, ?, ?)");
                        $sthandler->execute([$plots, $size, $block, $status, $projId, $use_id]);

                     header('Location: ../projects.php?msg=successAdd');
                exit;    
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

