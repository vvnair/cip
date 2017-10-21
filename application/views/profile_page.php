    <?php $this->load->view('template/header'); ?>
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/tab.css">

    <style>
    .billing input {
        width: 85%;
    }
    </style>

    <?php $this->load->view('template/nav'); ?>
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
                                    </div>
                                    <!-- New Request tab starts here -->
                                    <div class="tab-pane fade" id="tab2primary">
                                    <form method="post" action="">
                                        <div class="row ">
                                            <div class="col-sm-6 billing" >
                                                <h4>Billing Address</h4>
                                                <div class="form-group">
                                                    <label for="address1">Address Line1</label>
                                                    <input type="text" class="form-control" id="baddress1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address2">Address Line2</label>
                                                    <input type="text" class="form-control" id="baddress2">
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="bcity">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="bstate">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">Country</label>
                                                    <input type="text" class="form-control" id="bcountry">
                                                </div>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </div>
                                            <div class="col-sm-6 billing" >
                                                <h4>Implementation Address</h4>
                                                <div class="form-group">
                                                    <label for="address1">Address Line1</label>
                                                    <input type="text" class="form-control" id="iaddress1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address2">Address Line2</label>
                                                    <input type="text" class="form-control" id="iaddress2">
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="icity">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="istate">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">Country</label>
                                                    <input type="text" class="form-control" id="icountry">
                                                </div>
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
