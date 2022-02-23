<?php
  session_start(); //start session
  include('conn.php');
  try {
    if(isset($_GET['plotId'])){
      $plotId = $_GET['plotId'];
      $projId = $_GET['projId'];

      //check if c already registered
                $sthandler1 = $conn->prepare("SELECT * FROM plots WHERE plotId = :plotId");
                $sthandler1->bindParam(':plotId', $plotId);
                $sthandler1->execute();
                if($sthandler1->rowCount() > 0){
                    //update type records into department table

                    // ********* DELETE department STATUS ***********
                     $sql="DELETE FROM plots  where plotId= '".$plotId."'";
                    // Prepare statement
                    $stmt = $conn->prepare($sql);
                    // execute the query
                    if($stmt->execute()){
                        $conn = null;
                        header('Location: ../viewPlots.php?msg=plotDeleted&projId='.$projId);
                        exit;
                    }else{
                        $conn = null;
                        header('Location: ../regiter_dept.php?msg=plotDeletedfail');
                        exit;
                    }

                }else{
                    //if type doesnot exist
                    header('Location: ../regiter_dept.php?msg=plotNotExist');
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