<?php
    session_start();
if (!$_GET) {
//check for required info from the query string
header('Location: logout.php?msg=noPost');
exit;
}
 
try {
    include_once('conn.php'); //create connection
    $plotStatus=$_GET['plotStatus'];
    $plotId=$_GET['plotId'];
    $projId = $_GET['projId'];
    $userId = $_SESSION['user_id'];

    if ($plotStatus == 'open' OR $plotStatus == 'Open' OR $plotStatus == 'OPEN') {
        $plotStatus2 = 'NOT OPEN';
    }else{
        $plotStatus2 = 'OPEN';
    }
    
//.........................................
    $sql = "UPDATE plots SET plotStatus='".$plotStatus2."', use_id='".$userId."' WHERE plotId = '".$plotId."'";
// Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    if($stmt->execute()){
        $conn = null;
        header("location: ../viewPlotsUsers.php?projId=".$projId."&msg=statusSuccess");
        exit;
    }else{
        $conn = null;
        header("location: ../viewPlotsUsers.php?projId=".$projId."&msg=statusFail");
        exit;
    }
        
} catch (Exception $e) {
    echo $sql . "<br>" . $e->getMessage();
    //echo 'Error';
}

?>