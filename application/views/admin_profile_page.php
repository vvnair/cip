<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/tab.css">
<script type="text/javascript" src="<?php echo base_url();?>/js/jquery.tabletoCSV.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/js/admin_profile_page.js"></script>

<?php $this->load->view('template/nav'); ?>
<?php

    $date = date("Y-m-d");
    $session_data = $this->session->userdata();
    $user_id = $session_data['sessionid'];

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="container">

                <div class="col-sm-12">
                    <div class="panel with-nav-tabs panel-primary">
                        <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1primary" data-toggle="tab">Home</a></li>
                                    <li><a href="#tab2primary" data-toggle="tab">Companies</a></li>
                                    <li><a href="#tab3primary" data-toggle="tab">User Management</a></li>
                                    <!-- <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li> -->
                                </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1primary">

                                    <div class="row">
                                        <button class="btn btn-info" style="margin-left : 10px; margin-bottom:10px;" id="print">Download</button>
                                            <div class="table table-responsive" >
                                                <table class="table table-bordered admin_table ">
                                                    <thead>
                                                      <tr>
                                                        <th>No</th>
                                                        <th>SR Number</th>
                                                        <th>User ID</th>
                                                        <th>Billing Address</th>
                                                        <th>Implementation Address</th>
                                                        <th>B/w</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        <th>Documents Uploaded till Date </th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($data as $key => $value) { ?>


                                                 <tr>
                                                    <td><?php echo $key+1 ; ?></td>
                                                    <td>
                                                        <strong>
                                                            <?php echo $value->request_number . "<br /><br /> Requested on : ". $value->request_date; ?>
                                                            <?php
                                                                foreach($last_update as $r => $o){
                                                                    foreach($o as $l =>$e){
                                                                        if($e->sr_request_number == $value->request_number){
                                                                            echo "<br /><br /> Last updated on : ". $e->update_date . "( ". $e->updated_by ." )";
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </strong>
                                                    </td>
                                                    <td><?php echo $value->email; ?></td>
                                                    <td>
                                                        <a href="#" data-toggle="tooltip" title="<?php echo $value->company."\n".$value->baddress1 . "\n ". $value->baddress2 . "\n " . $value->baddress3 . "\n" . $value->bcity . "\n " . $value->bstate . "\n " . $value->bcountry . "\n " . $value->bzipcode . " \n GSTIN No: " . $value->bgst ; ?>"><span class="glyphicon glyphicon-info-sign"></span></a>

                                                    </td>

                                                    <td><?php echo $value->company."<br />". $value->iaddress1 . "<br /> ". $value->iaddress2 . " <br/>" . $value->iaddress3 . "<br /> " . $value->icity . "<br /> " . $value->istate . "<br /> " . $value->icountry . "<br /> " . $value->izipcode . " <br /> GSTIN No: " . $value->igst ; ; ?></td>
                                                    <td><?php echo $value->bandwidth; ?></td>
                                                    <form method="post" action="<?php echo base_url(); ?>index.php/Login/update_status" enctype="multipart/form-data">
                                                    <td><select name="status" class="form-control status_select" data-id="<?php echo $value->request_number; ?>" >
                                                            <?php foreach ($statuses as $k => $v) { ?>
                                                                <option value="<?php echo $v; ?>" <?php if($v === $value->status){?> selected<?php } ?>><?php echo ucwords($v); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php $stats = "";
                                                            if($customer_proposal_data) { ?>
                                                            <div style = "margin-top : 10px;">
                                                                Customer Response on Proposal : <?php foreach ($customer_proposal_data as $key => $val) { ?>
                                                                    <?php if($val->sr_request_number == $value->request_number){ ?>
                                                                        <strong><?php echo $val->proposal_status;
                                                                                $stats = $val->proposal_status;
                                                                                 ?>
                                                                        </strong>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="file_upload<?php echo $value->request_number;?>" " hidden >
                                                            <div>
                                                            <label for="proposal">Proposal : </label>
                                                            <input type="file" name="proposal" size="20" class="btn btn-primary" id="proposal"/>
                                                            </div>
                                                            <div>
                                                            <label for="proposal">CAF : </label>
                                                            <input type="file" name="caf" size="20" class="btn btn-primary" id="caf"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="hidden" name="req_num" value="<?php echo $value->request_number; ?>"/>
                                                        <input type="hidden" name="req_id" value="<?php echo $value->id; ?>"/>
                                                        <input type="hidden" name="last_update_date" value="<?php echo $date;?>" />
                                                        <input type="hidden" name="user_name" value="<?php echo $session_data['username']; ?>" />
                                                        <button type="submit" class="btn btn-success">Update</button>

                                                    </td>
                                                    <td>
                                                        <?php
                                                            foreach($self_files as $ke => $fi){
                                                                foreach($fi as $p => $m) { ?>
                                                                    <?php if($m->sr_request_number == $value->request_number){ ?>
                                                                        <div><a href="<?php echo base_url(); ?>index.php/Login/download/?p=<?php echo $m->fullpath;?>"><?php echo ucfirst($m->filename); ?></a></div><br/>
                                                                    <?php } ?>
                                                        <?php    }
                                                            }
                                                        ?>
                                                        <?php if($stats == 'Proposal Accepted') {

                                                            foreach($files as $k => $file){
                                                                foreach($file as $y => $z) {?>
                                                                    <?php if($z->sr_request_number == $value->request_number){ ?>
                                                                        <div><a href="<?php echo base_url(); ?>index.php/Login/download/?p=<?php echo $z->fullpath;?>"><?php echo ucfirst($z->filename); ?></a></div><br/>
                                                                    <?php } ?>
                                                        <?php }}} ?>
                                                    </td>
                                                    </form>
                                                  </tr>

                                                    <?php } ?>

                                                    </tbody>
                                                  </table>
                                            </div>
                                    </div>
                                </div>
                                <!-- New Request tab starts here -->
                                <div class="tab-pane fade" id="tab3primary">
                                    <div class="row">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered table-responsive">
                                                    <thead>
                                                      <tr>
                                                        <th>No</th>
                                                        <th>User ID</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Company</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($user_roles as $k => $v){ ?>
                                                        <form action ="<?php echo base_url(); ?>index.php/Login/update_user_role" method="post">
                                                            <tr>
                                                                <td><?php echo $k+1; ?></td>
                                                                <td><?php echo $v->id; ?></td>
                                                                <td><?php echo $v->name ?></td>
                                                                <td>
                                                                    <select class="form-control" name="role">
                                                                        <?php foreach($roles as $role) { ?>
                                                                            <option value="<? echo $role; ?>" <?php if($role == $v->role) {?>selected <?php }?>><? echo $role; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <input type="hidden" name="user_id" value="<?php echo $v->id; ?>"/>
                                                                <?php //echo "<pre>";print_r($cmp_users);exit; ?>
                                                                <td>
                                                                    <select class="form-control" multiple name="company[]">
                                                                        <?php foreach($companies as $k => $c){ ?>
                                                                            <option value="<?php echo $c->id; ?>"
                                                                                <?php if(!empty($cmp_users)){
                                                                                    foreach($cmp_users as $no => $valu){
                                                                                    if($valu->id == $c->id && $valu->user_id == $v->id){ ?>
                                                                                        selected
                                                                                    <?php }
                                                                                } } ?>
                                                                            ><?php echo $c->company; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><button type="submit" class="btn btn-primary">Update</button></td>
                                                            </tr>
                                                        </form>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab2primary">
                                    <?php if(!empty($companies)) { ?>
                                    <div class="row">
                                            <div class="table table-responsive">
                                                <table class="table table-bordered table-responsive">
                                                    <thead>
                                                      <tr>
                                                        <th>No</th>

                                                        <th>Company</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($companies as $key => $val) { ?>
                                                        <tr>
                                                            <td><?php echo $key+1; ?></td>
                                                            <td><?php echo $val->company; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form action="<?php echo base_url(); ?>index.php/Login/add_company" method="post">
                                              <div class="form-group">
                                                <label for="company">Company Name</label>
                                                <input type="text" class="form-control" name="company" style="width: 40%;">
                                              </div>

                                              <button type="submit" class="btn btn-primary">Add Company</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            <!-- New Request tab ends here         -->
                                </div>
                                <!-- <div class="tab-pane fade" id="tab2primary">Primary 3</div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
