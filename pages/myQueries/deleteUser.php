<?php
  session_start(); //start session
  include('conn.php');
  try {
    if(isset($_GET['use_id'])){
      $use_id = $_GET['use_id'];
      $profile = $_GET['profile'];
      $profile_path = '../'.$profile;

      

      //check if c already registered
                $sthandler1 = $conn->prepare("SELECT * FROM users WHERE use_id = :use_id");
                $sthandler1->bindParam(':use_id', $use_id);
                $sthandler1->execute();
                if($sthandler1->rowCount() > 0){
                    //update type records into department table

                    // ********* DELETE department STATUS ***********
                     $sql="DELETE FROM users  where use_id= '".$use_id."'";
                    // Prepare statement
                    $stmt = $conn->prepare($sql);
                    // execute the query
                    if($stmt->execute()){
                      //delete profile picture
                          if (file_exists($profile_path)) 
                            {
                                unlink($profile_path); //statement to delete picture
                                $conn = null;
                                header('Location: ../userRegistration.php?msg=userDeleted&use_id='.$use_id);
                                exit;
                            }else{
                                    $conn = null;
                                    header('Location: ../userRegistration.php?msg=userDeleted&use_id='.$use_id);
                                    exit;
                                }
                    }else{
                        $conn = null;
                        header('Location: ../userRegistration.php?msg=plotDeletedfail');
                        exit;
                    }

                }else{
                    //if type doesnot exist
                    header('Location: ../userRegistration.php?msg=plotNotExist');
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