
<header class="main-header">
    <!-- Logo -->
     <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PIL</b>FILEOPEN</span>
      <img src="../images/logo.png" width="100px" height="44px">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        PIL FILE OPENING
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="myQueries/logout.php" class="">
              <span class="hidden-xs">Logout <span class="glyphicon glyphicon-log-out"></span></span>
            </a>
            <ul class="dropdown-menu" >
              <!-- User image -->
              <li class="user-header" style="height: 208px; background-color: rgb(238, 238, 238);">
                
                  <form id="formLogin" class="form container-fluid" method="POST" action="pages/admin.php">
                    <div class="form-group">
                      <input type="text" class="form-control" id="usr" name="u-emal" placeholder="user name">
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" id="pwd" name="u-pass" placeholder="Password">
                    </div>
                    <button class="btn btn-block btn-primary" id="btnalaogin">Login</button>
                  </form>
                  <div class="container-fluid">
                  <br/>
                    <a href="#" class="small texti-info">Forget Password?</a>
                  </div>
              
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>