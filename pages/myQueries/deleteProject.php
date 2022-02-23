<?php
  session_start(); //start session
  include('conn.php');
  try {
    if(isset($_GET['projId'])){
      $projId = $_GET['projId'];
      

      //check if c already registered
                $sthandler1 = $conn->prepare("SELECT * FROM project WHERE projId = :projId");
                $sthandler1->bindParam(':projId', $projId);
                $sthandler1->execute();
                if($sthandler1->rowCount() > 0){
                    //update type records into department table

                    // ********* DELETE department STATUS ***********
                     $sql="DELETE FROM project  where projId= '".$projId."'";
                    // Prepare statement
                    $stmt = $conn->prepare($sql);
                    // execute the query
                    if($stmt->execute()){
                        $conn = null;
                        header('Location: ../projects.php?msg=projDeleted&projId='.$projId);
                        exit;
                    }else{
                        $conn = null;
                        header('Location: ../projects.php?msg=plotDeletedfail');
                        exit;
                    }

                }else{
                    //if type doesnot exist
                    header('Location: ../projects.php?msg=plotNotExist');
                    exit;
                }

     }else{
      echo '<h2 style="text-align: center; color: red;">Error Occurs</h2>';
     }
        
  }
  catch(PDOException $e){

    echo $sql."<br>" .$e->getMessage();
  }
?>