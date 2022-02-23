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
                }else if ($_GET["msg"] == "proj_title_exist"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-warning small" id = "infor">Sorry! The project already exist. Enter new project </span>';
                    echo '</p>';  
                  }else if ($_GET["msg"] == "success"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-success small" id = "infor">Project registered successfully </span>';
                    echo '</p>';  
                  }else if ($_GET["msg"] == "successUpl"){
                    $erPlots = $_GET["erPlots"];
                    $successPlots = $_GET["successPlots"];
                    if ($erPlots == 0) {
                      echo '<p class = "text-center">';
                      echo '<span class="text-success small" id = "infor">All plots uploaded successfully </span>';
                      echo '</p>'; 
                    }else{
                      echo '<p class = "text-center">';
                      echo '<span class="text-success small" id = "infor">' .$successPlots.' plots uploaded successfully. </span>';
                      echo '<br/><span class="text-danger small" id = "infor" style="font-weight: bold;">
                         ' .$erPlots.' plots already exist, so are not uploaded.
                        </span>';
                      echo '</p>';
                    }
                     
                  }else if ($_GET["msg"] == "invalid"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-success small" id = "infor">File uploaded is empty/invalid format </span>';
                    echo '</p>';  
                  }else if ($_GET["msg"] == "projDeleted"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-danger small" id = "infor">Projects deleted successfully </span>'; 
                    echo '</p>'; 
                  }else if ($_GET["msg"] == "successAdd"){
                    echo '<p class = "text-center">';
                    echo '<span class="text-success small" id = "infor">Plot added successfully </span>'; 
                    echo '</p>'; 
                  }
                    }
              //}
                //end of display massage if project failed to be registered
            ?>

        <!-- form start -->
        
        <!-- form end -->
        <div class="box-footer">
            <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Registered Projects</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Project Title</th>
                  <th>Username</th>
                  <th>Registered Date</th>
                  <!-- <th>Project Status</th>  -->
                  <!--<th>Plots</th>
                  <th>Plot</th> -->
                  <th>Plots</th>
                  <!--<th>Project</th> -->
                  <th>Project</th> 
                  <!--<th>Project</th> -->

                </tr>
                </thead>
                <tbody>
                  <?php
                      try {
                        //select records from project table
                        $sql = "SELECT * FROM project ORDER BY projTitle ASC";

                        $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
                        $val = 1;
                        do {
                            $projId = $row[0];
                            $projTitle = $row[1];
                            //$projStatus = $row[2];
                            $use_id = $row[2];
                            $projDate = $row[3];

                             //condition to check the role of access for admin and instructor
                             $sql2 = "SELECT user_name FROM users WHERE use_id = '".$use_id."'";
                              $rows2 = $conn->query($sql2); 

                              //Fetch the row
                              if($row2 = $rows2->fetch(PDO::FETCH_ASSOC)){
                                  $user_name = $row2['user_name'];
                                }else{
                                  $user_name = $use_id;
                                }


                            echo '<tr>';
                              echo '<td>' . $val . '</td>';
                              echo '<td>' . $projTitle . '</td>';
                              echo '<td>' . $user_name . '</td>';
                              echo '<td>' . $projDate . '</td>';
                              
                             /* echo '<td class="text-center">';
                                echo '<button type ="button" class="btn btn-default btn-xs identifyingClass" data-toggle="modal" data-target="#myModalUpl" data-id="'.$projId.'" title="upload plots file">
                                  Upload&nbsp;&nbsp;<span class="fa fa-upload"></span>
                                </button>';
                              echo '</td>';

                              echo '<td class="text-center">';
                                echo '<button type ="button" class="btn btn-default btn-xs identifyingClass" data-toggle="modal" data-target="#myModaladd" data-id="'.$projId.'" title="add single plot">
                                  Add new&nbsp;&nbsp;<span class="fa fa-plus"></span>
                                </button>';
                              echo '</td>'; */

                            echo '<td class="text-center">';
                                echo "<a class='btn btn-default btn-block' onClick=\"javascript: return confirm('You are going to view plots from the ". $projTitle ." project');\" href='viewPlotsUsers.php?projId=".$projId."' data-toggle='tooltip' data-placement='top' title='view plots'>";
                                  echo 'View&nbsp;&nbsp;<span class="fa fa-eye"></span>
                                </a> 
                            </td>';

                           /* echo '<td class="text-center">';
                                echo '<button type ="button" class="btn btn-default btn-xs identifyingClass" data-toggle="modal" data-target="#myModalUpd" data-id="'.$projId.'" title="update project">
                                  update&nbsp;&nbsp;<span class="fa fa-pencil"></span>
                                </button>';
                              echo '</td>';*/

                            echo '<td class="text-center">';
                                echo "<a class='btn btn-default btn-block' onClick=\"javascript: return confirm('You are going to print the ". $projTitle ." project');\" href='printProject.php?projId=".$projId."' data-toggle='tooltip' data-placement='top' title='print project'>";
                                  echo 'print&nbsp;&nbsp;<span class="fa fa-print"></span>
                                </a> 
                            </td>';
                           /* echo '<td class="text-center">';
                                echo "<a class='btn btn-danger btn-xs' onClick=\"javascript: return confirm('You are going to delete ". $projTitle ." project');\" href='myQueries/deleteProject.php?projId=".$projId."' data-toggle='tooltip' data-placement='top' title='delete project'>";
                                  echo 'delete&nbsp;&nbsp;<span class="fa fa-trash"></span>
                                </a> 
                            </td>'; */
                            echo '</tr>';
                            $val++;
                          } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
                        }
                        catch(PDOException $e) {
                          echo "Error: " . $e->getMessage();
                      }
                      $conn = null;
                    ?>
                
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


<!-- Modal -->
  <div class="modal fade" id="myModalUpl" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Plots</h4>
        </div>
        <div class="modal-body">
          <p class="help-block">Only Excel/CSV File Import or 
            <a href="../database/plotsData.csv" target="_blank">Download Excel/CSV tamplate here..</a> 
          </p>
           <form method= "POST" action ="myQueries/uploadPlotsProcess.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="user_role">Plot Excel/CSV file:</label>
              <input type="file" class="form-control" name="file" id="file" size="200" accept=".xls,.xlsx,.csv" required="required" />
            </div>
              <input type="hidden" class="form-control" id="projId" name="projId" />
            <button type="submit" class="btn btn-primary" name="import">Upload</button>
          </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModaladd" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Plots</h4>
        </div>
        <div class="modal-body">
           <form method= "POST" action ="myQueries/addPlotsProcess.php" enctype="multipart/form-data">
            <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                          <label for="pnumber">Plot No*</label>
                          <input type="text" class="form-control" id="pnumber" name="pnumber" placeholder="Enter plot number" required="required">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="psize">Size*</label>
                          <input type="text" class="form-control" id="psize" name="psize" placeholder="plot size" required="required">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="block">Block*</label>
                          <input type="text" class="form-control" id="block" name="block" placeholder="block" required="required">
                        </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                            <label>Status*</label>
                            <select class="form-control select2" style="width: 100%;" required="required" name="proStatus" required="required">
                              <option value="">Select Status</option>
                              <option value="open">open</option>
                              <option value="not open">not open</option>
                            </select>
                          </div>
                      </div>
                </div>

                <div class="row">
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-5">
                    <input type="hidden" class="form-control" id="projId" name="projId" />
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>
          </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

   <!-- Modal -->
  <div class="modal fade" id="myModalUpd" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Project</h4>
        </div>
        <div class="modal-body">
           <form method= "POST" action ="myQueries/updateProjectProcess.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-12">
                        <div class="form-group">
                          <label for="projTitle">Project Title*</label>
                          <input type="text" class="form-control" id="projTitle" name="projTitle" placeholder="Enter project title" required="required">
                        </div>
                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>



                <div class="row">
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-5">
                    <input type="hidden" class="form-control" id="projId" name="projId" />
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                    <div class="col-sm-1">&nbsp;</div>
                </div>
          </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    //send orderId to the modal class input field
    $(function () {
        $(".identifyingClass").click(function () {
            var my_id_value = $(this).data('id');
            $(".modal-body #projId").val(my_id_value);
        })
    });

  </script>