
<nav class="navbar navbar-inverse">
  <div class="container-fluid">

    <div class="navbar-header">
      <a class="navbar-brand" href="#">Customer Information Portal</a>
    </div>
    <ul class="nav navbar-nav">
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php if($this->session->userdata('sessionid')){ ?>
             <li><a href="<?php echo base_url(); ?>index.php/Login/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php }else{ ?>
      <li><a href="<?php echo base_url(); ?>index.php/Login/" id="logout"><span class="glyphicon glyphicon-user"></span> Login</a></li>
  <?php } ?>
    </ul>

  </div>
</nav>
