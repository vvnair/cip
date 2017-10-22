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
        $user_id = $session_data['session_id'];

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
                                        <li><a href="#tab2primary" data-toggle="tab">New Request</a></li>
                                        <!-- <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li> -->
                                    </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1primary">
                                        Welcome User
                                        <div class="row">
                                                <div class="table">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                          <tr>
                                                            <th>No</th>
                                                            <th>SR Number</th>
                                                            <th></th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>John</td>
                                                            <td>Doe</td>
                                                            <td>john@example.com</td>
                                                          </tr>

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
                                                <div class="form-group">
                                                    <label for="state">Zip Code</label>
                                                    <input type="text" class="form-control" id="izipcode" name="izipcode" required>
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
