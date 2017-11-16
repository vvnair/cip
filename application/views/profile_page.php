    <?php $this->load->view('template/header'); ?>
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/tab.css">
    <script type="text/javascript" src="<?php echo base_url();?>/js/jquery.tabletoCSV.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/js/profile_page.js"></script>


    <?php $this->load->view('template/nav'); ?>
    <?php $six_digit_random_number = mt_rand(000000, 999999);
        $request_number = "SR".$six_digit_random_number;
        date_default_timezone_set('Asia/Kolkata');
    	$date = date("Y-m-d H:i:s");
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
                                                <button class="btn btn-info" style="margin-left : 10px; margin-bottom:10px;" id="print">Download</button>
                                                <div class="table table-responsive">
                                                    <table class="table table-bordered customer_table">
                                                        <thead >
                                                          <tr class="info">
                                                            <th>No</th>
                                                            <th><nobr>SR Number</nobr></th>
							    <th><nobr>Implementation Address</nobr></th>
                                                            <th><nobr>Billing Address</nobr></th>
							     <th>B/w</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                            <th>Documents Uploaded</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($data as $key => $value) { ?>

                                                          <tr>
                                                            <td style="text-align: center;"><?php echo $key+1 ; ?></td>
                                                            <td>
                                                                <strong>
                                                                    <?php echo $value->request_number . " </strong><br /><br /> Submitted on:  <br />". $value->request_date ;
                                                                    foreach($last_update as $r => $o){
                                                                        foreach($o as $l =>$e){
                                                                            if($e->sr_request_number == $value->request_number){
                                                                                echo "<br /><br /> Last updated<br/>On:<nobr> ". $e->update_date . "</nobr><br/ >By: ". $e->updated_by ."";
                                                                            }
                                                                        }
                                                                    } ?>
                                                               
                                                            </td>
                                                            <!-- <td><?php //echo $value->company ."<br />". $value->baddress1 . "<br /> ". $value->baddress2 . " <br/>" . $value->baddress3 . "<br /> " . $value->bcity . "<br /> " . $value->bstate . "<br /> " . $value->bcountry . "<br /> " . $value->bzipcode; ?></td> -->
                                                            
                                                            <td><?php echo $value->company ."<br />". $value->iaddress1 . "<br /> ". $value->iaddress2 . " <br/>" . $value->iaddress3 . "<br /> " . $value->icity . "<br /> " . $value->istate . "<br /> " . $value->icountry . "<br /> " . $value->izipcode; ?></td>
							    <td style="text-align: center;"><a href="#" data-toggle="tooltip" title="<?php echo $value->company."\n".$value->baddress1 . "\n ". $value->baddress2 . "\n " . $value->baddress3 . "\n" . $value->bcity . "\n " . $value->bstate . "\n " . $value->bcountry . "\n " . $value->bzipcode . " \n GSTIN No: " . $value->bgst ; ?>"><span class="glyphicon glyphicon-info-sign"></span></a></td>
                                                            <td style="text-align: center;"	><?php echo $value->bandwidth; ?> </td>
							    <td><strong><?php echo ucfirst($value->status);?></strong>

                                                            </td>
                                                            <td>
                                                                <?php if($value->status == 'feasible'){ ?>

                                                                    <div>
                                                                        <form action="<?php echo base_url(); ?>index.php/Login/change_proposal_status" method="post" enctype="multipart/form-data"><?    //   echo "<pre>";print_r($proposal_statuses ); ?>
                                                                            <select name="proposal_status" class="form-control select_action" data-id="<?php echo $value->request_number; ?>">
                                                                                <?php //foreach($customer_proposal_status as $p => $m) { ?>
                                                                                    <?php foreach ($proposal_statuses as $val) { ?>

                                                                                        <option value="<?php echo $val; ?>" <?php if($m->proposal_status == $val){ ?> selected<?php } ?>><?php echo $val; ?></option>
                                                                                    <?php// } ?>
                                                                                <?php } ?>
                                                                            </select>

                                                                            <input type="hidden" name="sr_request_number" value="<?php echo $value->request_number; ?>"  />
                                                                            <input type="hidden" name="req_num" value="<?php echo $value->request_number; ?>"  />
                                                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                                                                            <input type="hidden" name="last_update_date" value="<?php echo $date;?>" />
                                                                            <input type="hidden" name="user_name" value="<?php echo $session_data['username']; ?>" />
                                                                            <div class="file_upload<?php echo $value->request_number;?>" " hidden >
                                                                                <div>
                                                                                <label for="signedproposal">Purchase Order : </label>
                                                                                <input type="file" name="signedproposal" size="20" class="btn btn-primary" id="signedproposal"/>
                                                                                </div>
                                                                                <div>
                                                                                <label for="signedcaf">Signed CAF : </label>
                                                                                <input type="file" name="signedcaf" size="20" class="btn btn-primary" id="signedcaf"/>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" style="margin-top: 5px;" class="btn btn-success">Change Status</button>
                                                                            <br /><br /><strong>Current Status : </strong><?php foreach($customer_proposal_status as $p => $m) {
                                                                                if($m->sr_request_number == $value->request_number){ ?>
										<nobr>
                                                                                <?php echo $m->proposal_status;
                                                                            }?></nobr> <?php } ?>
                                                                        </form>
                                                                    </div>

                                                            <?php } ?>
                                                            </td>
                                                            <td><p><strong><u>By Sify:</u></strong></p>
								
                                                                <?php if($value->status == 'feasible') {
                                                                    foreach ($files as $k => $v) { ?>
                                                                        <?php foreach($v as $y => $z) {?><ul>
                                                                            <?php if($z->sr_request_number == $value->request_number) { ?><li>
                                                                                <div><a style="color: #cc0000; " class="" style="margin-bottom: 5px;margin-top: 5px; " href="<?php echo base_url(); ?>index.php/Login/download/?p=<?php echo $z->fullpath; ?>"><nobr> <?php echo strtoupper($z->filename); ?> </nobr> </a> </div><br/>
                                                                            </li><?php } ?></ul>
                                                                        <?php } ?>
                                                                <?php    } ?>
                                                                <?php } ?>
								<hr>
								<p><strong><u> By <?php echo $value->company;?>: </u></strong></p>
								
                                                                <?php foreach($self_files as $l => $e ){
                                                                        foreach($e as $a => $b){ ?><ul>
                                                                            <?php if($b->sr_request_number == $value->request_number) {?><li>
                                                                                <div><a class="" style="margin-bottom: 5px;margin-top: 5px;  " href="<?php echo base_url(); ?>index.php/Login/download/?p=<?php echo $b->fullpath; ?>"> <?php echo strtoupper($b->filename); ?>  </a> </div><br/>
                                                                            </li><?php } ?></ul>
                                                                    <? }
                                                                } ?></ul>
                                                            </td>
                                                          </tr>

                                                        <?php } ?>

                                                        </tbody>
                                                      </table>
                                                </div>
                                        </div>
                                    </div>
                                    <!-- New Request tab starts here -->
                                    <div class="tab-pane fade" id="tab2primary">

                                    <form method="post" action="<?php echo base_url(); ?>index.php/Login/new_request">
                                        <div class="row">
                                            <div class="col-sm-6 billing" >
                                                <div class="form-group">
                                                    <label for="company">Select Company</label>
                                                    <select name="company" class="form-control" style="width:70%;" id="comp_name" >
                                                        <?php foreach ($user_companies as $p => $company) { ?>
                                                            <option value="<?php echo $company->id; ?>"><?php echo $company->company; ?></option>
                                                        <?php } ?>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-sm-6 billing">
                                                <label for="company">Company : </label>
                                                <div id="comp_text"></div>
                                            </div>
                                        </div>
                                        <hr />
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
                                            <div class="table table-responsive">
                                                <table class="table table-bordered table-responsive">
                                                    <thead>
                                                      <tr>
                                                        <th>No</th>
                                                        <th>SR Number</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($data as $key => $value) { ?>
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
