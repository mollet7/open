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
            $filename = $_FILES['file']['tmp_name'];
            if ($_FILES['file']['size'] > 0) {

            //$file_loc = $_FILES['picture']['tmp_name'];
            //$file_size = $_FILES['picture']['size'];

                $file = fopen($filename, "r");
                $projId = $_POST['projId'];
                $use_id = $_SESSION['user_id'];
                $erPlots = 0;
                $successPlots = 0;

                while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    //check if plotNo already used
                    $sthandler = $conn->prepare("SELECT * FROM plots WHERE plotNo = :plotNo AND block = :block AND projId = :projId");
                    $sthandler->bindParam(':plotNo', $emapData[0]);
                    $sthandler->bindParam(':block', $emapData[2]);
                    $sthandler->bindParam(':projId', $projId);
                    $sthandler->execute();
                    
                    if($sthandler->rowCount() > 0){
                        $erPlots = $erPlots + 1; 
                    }else{
                        $inst = "INSERT INTO plots (plotNo, plotSize, block, plotStatus, projId, use_id) VALUES ('$emapData[0]', '$emapData[1]', '$emapData[2]', '$emapData[3]', '$projId', '$use_id')";
                        $conn->exec($inst);
                        $successPlots = $successPlots + 1;
                    }
                    
                }
                fclose($file);
                header('Location: ../projects.php?successPlots='.$successPlots.'&erPlots='.$erPlots.'&msg=successUpl');
                exit;
            }else{
              header('Location: ../projects.php?msg=invalid');
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

