    <?php $this->load->view('template/header'); ?>
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/tab.css">

    <style>
    .billing input {
        width: 85%;
    }

    .table {
        margin-left: 10px;
        margin-right: 10px;
        width: 98%;
    }

    hr {
        	border-top: 1px solid #8c8b8b;
    }

    </style>

    <?php $this->load->view('template/nav'); ?>
    <?php $six_digit_random_number = mt_rand(000000, 999999);
        $request_number = "SR".$six_digit_random_number;
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
                                        <li><a href="#tab2primary" data-toggle="tab">New Feasibility</a></li>
                                        <li><a href="#tab3primary" data-toggle="tab">Upgrade Feasibility</a></li>
                                        <!-- <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li> -->
                                    </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1primary">

                                        <div class="row">
                                                <div class="table table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                          <tr>
                                                            <th>No</th>
                                                            <th>SR Number</th>
                                                            <th>Billing Address</th>
                                                            <th>Implementation Address</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($data as $key => $value) { ?>

                                                          <tr>
                                                            <td><?php echo $key+1 ; ?></td>
                                                            <td><strong><?php echo $value->request_number; ?></strong></td>
                                                            <td><?php echo $value->baddress1 . "<br /> ". $value->baddress2 . " <br/>" . $value->baddress3 . "<br /> " . $value->bcity . "<br /> " . $value->bstate . "<br /> " . $value->bcountry . "<br /> " . $value->bzipcode; ?></td>
                                                            <td><?php echo $value->iaddress1 . "<br /> ". $value->iaddress2 . " <br/>" . $value->iaddress3 . "<br /> " . $value->icity . "<br /> " . $value->istate . "<br /> " . $value->icountry . "<br /> " . $value->izipcode; ?></td>
                                                            <td><strong><?php echo $value->status;?></strong>
                                                                <?php if($value->status == 'feasible') {
                                                                    foreach ($files as $k => $v) { ?>
                                                                        <?php foreach($v as $y => $z) {?>
                                                                            <?php if($z->sr_request_number == $value->request_number) { ?>
                                                                                <div><a class="btn btn-info" style="margin-bottom: 5px;margin-top: 5px; " href="http://localhost/cip/index.php/Login/download/?p=<?php echo $z->fullpath; ?>"> <?php if($y == 0){?> Download Proposal <?php }else{ ?> Download CAF <?php } ?>  </a> </div>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                <?php    } ?>

                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($value->status == 'feasible'){ ?>

                                                                    <div>
                                                                        <form action="http://localhost/cip/index.php/Login/change_proposal_status" method="post"><?    //   echo "<pre>";print_r($proposal_statuses ); ?>
                                                                            <select name="proposal_status" class="form-control">
                                                                                <?php //foreach($customer_proposal_status as $p => $m) { ?>
                                                                                    <?php foreach ($proposal_statuses as $val) { ?>

                                                                                        <option value="<?php echo $val; ?>" <?php if($m->proposal_status == $val){ ?> selected<?php } ?>><?php echo $val; ?></option>
                                                                                    <?php// } ?>
                                                                                <?php } ?>
                                                                            </select>

                                                                            <input type="hidden" name="sr_request_number" value="<?php echo $value->request_number; ?>"  />
                                                                            <button type="submit" style="margin-top: 5px;" class="btn btn-success">Change Status</button>
                                                                            <br /><br /><strong>Current Proposal Status : </strong><?php foreach($customer_proposal_status as $p => $m) {
                                                                                if($m->sr_request_number == $value->request_number){
                                                                                echo $m->proposal_status;
                                                                            }} ?>
                                                                        </form>
                                                                    </div>

                                                            <?php } ?>
                                                            </td?
                                                          </tr>

                                                        <?php } ?>

                                                        </tbody>
                                                      </table>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- New Request tab starts here -->
                                    <div class="tab-pane fade" id="tab2primary">

                                    <form method="post" action="http://localhost/cip/index.php/Login/new_request">
                                        <div class="row ">
                                            <div class="col-sm-6 billing" >
                                                <h4>Billing Address</h4>
                                                <div class="form-group">
                                                    <label for="address1">Address 1</label>
                                                    <input type="text" class="form-control" id="baddress1" name="baddress1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address2">Address 2</label>
                                                    <input type="text" class="form-control" id="baddress2" name="baddress2" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address2">Address 3</label>
                                                    <input type="text" class="form-control" id="baddress3" name="baddress3">
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="bcity" name="bcity" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="bstate" name="bstate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">Country</label>
                                                    <input type="text" class="form-control" id="bcountry" name="bcountry" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">Zip Code</label>
                                                    <input type="text" class="form-control" id="bzipcode" name="bzipcode" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bgst">GSTIN Number</label>
                                                    <input type="text" class="form-control" id="bgst" name="bgst" required>
                                                </div>
                                                <input type="hidden" name="request_number" value="<?php echo $request_number;?>" />
                                                <input type="hidden" name="request_date" value="<?php echo $date; ?>" />
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

                                            </div>
                                            <div class="col-sm-6 billing" >
                                                <h4>Implementation Address</h4>

                                                <div class="form-group">
                                                    <label for="address1">Address 1</label>
                                                    <input type="text" class="form-control" id="iaddress1" name="iaddress1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address2">Address 2</label>
                                                    <input type="text" class="form-control" id="iaddress2" name="iaddress2" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address2">Address 3</label>
                                                    <input type="text" class="form-control" id="iaddress3" name="iaddress3" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="icity" name="icity" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="istate" name="istate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">Country</label>
                                                    <input type="text" class="form-control" id="icountry" name="icountry" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="state">Zip Code</label>
                                                        <input type="text" class="form-control" id="izipcode" name="izipcode" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="bandwidth">BandWidth (Mbps)</label>
                                                        <input type="text" class="form-control" id="bandwidth" name="bandwidth" placeholder="in Mbps" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="igst">GSTIN Number</label>
                                                    <input type="text" class="form-control" id="igst" name="igst" required>
                                                </div>


                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-6 billing">

                                                <div class="form-group">
                                                    <label for="address1">Local Contact Number #1</label>
                                                    <input type="text" class="form-control" id="localcontactnum1" name="localcontactnum1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address1">Local Contact Number #2</label>
                                                    <input type="text" class="form-control" id="localcontactnum2" name="localcontactnum2" required>
                                                </div>

                                            </div>
                                            <div class="col-sm-6 billing">
                                                <div class="form-group">
                                                    <label for="address1">Local Contact Person</label>
                                                    <input type="text" class="form-control" id="localcontact" name="localcontact" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address1">Local Contact Email</label>
                                                    <input type="text" class="form-control" id="localcontactemail" name="localcontactemail" required>
                                                </div>

                                            </div>
                                            <div class="col-sm-12" style="">
                                                <button type="submit" class="btn btn-primary" >Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab3primary">
                                    <div class="row">
                                            <div class="table">
                                                <table class="table table-bordered">
                                                    <thead>
                                                      <tr>
                                                        <th>No</th>
                                                        <th>SR Number</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($data as $key => $value) { print_r($value);?>
                                                            <tr>
                                                                <td><?php echo $key+1; ?></td>
                                                                <td><?php echo $value->request_number; ?></td>
                                                                <td><button class="btn btn-success">Edit</button></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                                <!-- New Request tab ends here         -->
                                    </div>
                                    <!-- <div class="tab-pane fade" id="tab3primary">Primary 3</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php $this->load->view('template/footer'); ?>
