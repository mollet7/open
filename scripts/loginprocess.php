  <?php 
	session_start();
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   
      $user_name = $_POST['user_name'];
      $u_password = $_POST['u_password'];

     include('conn.php'); //connection
	  try{
		//login code will start here...
		$sql = "SELECT COUNT(user_name) AS u_name FROM  users WHERE user_name = :user_name && u_password = :u_password";
          $stm = $conn->prepare($sql);
          $stm->bindValue(':user_name', $user_name);
		  $stm->bindValue(':u_password', $u_password);
          $stm->execute();
          $mwisho = $stm->fetch(PDO:: FETCH_ASSOC);
		  if ($mwisho['u_name'] > 0) {
           //query to fetch data when user login
           $sql = "SELECT * FROM users WHERE user_name = '".$user_name."' && u_password = '".$u_password."'";
            $rows = $conn->query($sql); 
			//Fetch the row
            if($row = $rows->fetch(PDO::FETCH_ASSOC)){
				$_SESSION['user'] = $row['user_name'];
				$_SESSION['user_id'] = $row['use_id'];
				$_SESSION['role'] = $row['user_role'];
				$_SESSION['user_status'] = $row['u_status'];
				$_SESSION['picha'] = $row['picture'];
				if($_SESSION['user_status'] == 1){
					if($_SESSION['role'] == 'Admin' OR $_SESSION['role'] == 'User'){
						//code for admin login
						$_SESSION['log'] = 'in';
						header('Location: ../pages/admin.php');
						exit;
					}else{
						//code for user login
						$_SESSION['log'] = 'in';
						header('Location: ../pages/user.php');
						exit;
					}
				}else{
					header('Location: ../login.php?msg=block');
					exit;
				}
			}else{
					header('Location: ../login.php?msg=error');
					exit;
				}
			
			
          }else{
			  header('Location: ../login.php?msg=wrUser');
			  exit;
		  }
		
		}catch (Exception $e) 
			{
          echo $e->getMessage(); //used to generate errors
			}
       
     }else{
		 header('Location: ../index.php?msg=erorLog');
		 exit;
	 }

    ?>