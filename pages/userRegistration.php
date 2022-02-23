<?php
  session_start();
  if($_SESSION['log']!='in') {
    header('location:../login.php');
    exit;
  }
  include_once('myQueries/conn.php'); //create connection
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OFRS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
    include('sections/headerlinks.php');
  ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php
    include('sections/header.php');
    include('sections/adminsidebar.php');
  ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
           
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">
            Opening Files Recording System - OFRS
          </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>

        </div>

            <?php
              if (isset ($_GET["msg"])){
                if ($_GET["msg"] == "noPost"){
                  echo '<p class = "text-center">';
                  echo '<span class="small text-danger" id = "infor">No data sent, Fill the form and then send</span>';
                  echo '</p>'; 
                }else if ($_GET["msg"] == "user_name_exist"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-warning small" id = "infor">Sorry! The user_name already exist. try another user_name </span>';
                    echo '</p>';  
                  }else if ($_GET["msg"] == "u_email_exist"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-warning small" id = "infor">Sorry! The email already exist. try another email </span>';
                    echo '</p>';  
                  }else if ($_GET["msg"] == "success"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-success small" id = "infor">User registered successfully </span>';
                    echo '</p>';  
                  }else if ($_GET["msg"] == "sysError"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-danger small" id = "infor">Some error happen during registration process, Try again or contact with  administrator </span>'; 
                    echo '</p>'; 
                  }else if ($_GET["msg"] == "userDeleted"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-danger small" id = "infor">user deleted successfully </span>'; 
                    echo '</p>'; 
                  }
              }
                //end of display massage if department failed to be registered
            ?>

        <!-- form start -->
        <form role="form" method="POST" action="myQueries/userRegistrationProcess.php" enctype="multipart/form-data">
            <div class="box-body">
              Users Registration Form
              <div class="box box-danger">
                
                <div class="box-body">
              
                </div>
                <!-- /.box-body -->
                <div class="row">
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <label for="user_name">Username*</label>
                          <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter Username" required="required">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <label for="u_email">Email*</label>
                          <input type="email" class="form-control" id="u_email" name="u_email" placeholder="Enter Email" required="required">
                        </div>
                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>

                <div class="row">
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <label for="password">Password*</label>
                          <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" required="required">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <label for="user_role">User role*</label>
                          <select class="form-control select2" style="width: 100%;" required="required" id="user_role" name="user_role" required="required">
                            <option value="">Select Status</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>

                <div class="row">
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <label for="picture">Profile Picture*</label>
                          <input type="file" id="picture" name="picture" required="required" placeholder="Enter Profile Picture">

                          <p class="help-block">Upload your profile picture here. Maximum size is 2MB</p>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>

              </div>
              <!-- /.box -->
            </div>
            <!-- /.box-body -->
        </form>
        
        <div class="box-footer">
            <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Registered Users with thier role</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>User role</th>
                  <th>Status</th>
                  <th>Register Date</th>
                  <th>Picture</th>
                  <th class="text-center text-primary">Update</th>
                  <th class="text-center text-danger">Delete</th>

                </tr>
                </thead>
                <tbody>

                <?php
                      try {
                        //select records from faculty table
                        $sql = "SELECT * FROM users ORDER BY user_name ASC";

                        $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
                        $val = 1;
                        do {
                            $use_id = $row[0];
                            $user_name = $row[1];
                            $u_email = $row[2];
                            //$u_password = $row[3];
                            $u_status = $row[4];
                            $user_role = $row[5];
                            $picture = $row[6];
                            $timedate = $row[7];
                            $profile = 'uploads/' . $picture;

                            //check if faculty is lock or unlock
                            if ($u_status == 1) {
                              $u_status1 = 'active';
                            }else{
                              $u_status1 = 'blocked';
                            }
                            echo '<tr>';
                              echo '<td>' . $val . '</td>';
                              echo '<td>' . $user_name . '</td>';
                              echo '<td>' . $u_email . '</td>';
                              echo '<td>' . $user_role . '</td>';
                              echo '<td>' . $u_status1 . '</td>';
                              echo '<td>' . $timedate . '</td>';
                              echo '<td>
                                <a href="'.$profile.'" target = "_blank">
                                  <img src="'.$profile.'" class="img-thumbnail" alt="profile" style="width: 50px; height: 50px;">
                                </a> 
                              </td>';
                              echo '<td class="text-center">';
                                  echo "<a class='btn btn-default btn-md btn-block' onClick=\"javascript: return confirm('You are going to update ". $user_name ."');\" href='updateUser.php?use_id=".$use_id."' data-toggle='tooltip' data-placement='top' title='update'>";
                                    echo 'Edit
                                  </a> 
                                </td>';
                            echo '<td class="text-center">';
                                echo "<a class='btn btn-default btn-md btn-block' onClick=\"javascript: return confirm('You are going to delete ". $user_name ."');\" href='myQueries/deleteUser.php?profile=".$profile."&use_id=".$use_id."' data-toggle='tooltip' data-placement='top' title='delete user'>";
                                  echo '
                                  Delete
                                </a> 
                            </td>';
                            echo '</tr>';
                            $val++;
                          } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
                        }
                        catch(PDOException $e) {
                          echo "Error: " . $e->getMessage();
                      }
                      $conn = null;
                    ?>

                </tbody>
                <!--<tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include('sections/footer.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php
  include('sections/scripts.php');
?>

</body>
</html>
