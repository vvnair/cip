<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/login.css">
    </head>
        <?php $this->load->view('template/header'); ?>
        <div id="fullscreen_bg" class="fullscreen_bg"/>
        <div class="container">
		<div class="row" style="margin-top: 15px;">
		   <div class="col-sm-12">
			<h1 class="text-muted" style="text-align: center; ">Customer Information Portal</h1>
		   </div>
		</div>
            <div class="row">
		
                <div class="col-sm-12">
                    <form class="form-signin" method="post" action="<?php echo base_url(); ?>index.php/Login/do_login">
                		
                		      <input type="text" class="form-control" placeholder="Email" required="" autofocus="" name="email">
                		      <input type="password" class="form-control" placeholder="Password" required="" name="password">
                    		<button class="btn btn-lg btn-primary btn-block" type="submit">
                    			Sign In
                    		</button>
                            <a class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>index.php/Login/register">
                    			Sign Up
                    		</a>
                	</form>
                </div>
            </div>
        </div>
        <?php $this->load->view('template/footer'); ?>
