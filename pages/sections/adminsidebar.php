<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="uploads/<?php echo $_SESSION['picha'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?php
            echo  $_SESSION['user'];
            ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SYSTEM DASHBOARD</li>
        <?php
          if ($_SESSION['role'] == 'Admin') {
           ?>
              <li class="">
          <a href="admin.php">
            <i class="glyphicon glyphicon-log-in"></i>
            <span>Admin Dashboard</span>
          </a>
        </li>
        <li>
          <a href="userRegistration.php">
            <i class="glyphicon glyphicon-user"></i>
            <span>User Registration</span>
          </a>
        </li>
        <li>
          <a href="projects.php">
            <i class="glyphicon glyphicon-th-large"></i>
            <span>Projects</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="glyphicon glyphicon-file"></i>
            <span>Reports</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="glyphicon glyphicon-log-in"></i>
            <span>Login Activities</span>
          </a>
        </li>
           <?php
          }else{
            ?>
              <li class="">
          <a href="admin.php">
            <i class="glyphicon glyphicon-log-in"></i>
            <span>Admin Dashboard</span>
          </a>
        </li>
        <!--<li>
          <a href="userRegistration.php">
            <i class="glyphicon glyphicon-user"></i>
            <span>User Registration</span>
          </a>
        </li> -->
        <li>
          <a href="projectsUser.php">
            <i class="glyphicon glyphicon-th-large"></i>
            <span>Projects</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="glyphicon glyphicon-file"></i>
            <span>Reports</span>
          </a>
        </li>
        <!--<li>
          <a href="#">
            <i class="glyphicon glyphicon-log-in"></i>
            <span>Login Activities</span>
          </a>
        </li> -->
            <?php
          }
        ?>
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>