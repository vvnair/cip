    <?php $this->load->view('template/header'); ?>
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/tab.css">
    <style>
    .table {
        margin-left: 10px;
        margin-right: 10px;
        width: 98%;
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
                                    </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1primary">

                                        <div class="row">
                                                <div class="table">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                          <tr>
                                                            <th>No</th>
                                                            <th>SR Number</th>
                                                            <th>User ID</th>
                                                            <th>Billing Address</th>
                                                            <th>Implementation Address</th>
                                                            <th>Bandwidth</th>
                                                            <th>Status</th>

                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($data as $k => $v){ ?>
                                                                <tr>
                                                                    <td><?php echo $k+1; ?></td>
                                                                    <td><strong><?php echo $v->request_number;?></strong></td>
                                                                    <td><?php echo $v->user_id;?></td>
                                                                    <td><?php echo $v->baddress1 . "<br /> ". $v->baddress2 . " <br/>" . $v->baddress3 . "<br /> " . $v->bcity . "<br /> " . $v->bstate . "<br /> " . $v->bcountry . "<br /> " . $v->bzipcode . " <br /> GSTIN No: " . $v->bgst ; ?></td>
                                                                    <td><?php echo $v->iaddress1 . "<br /> ". $v->iaddress2 . " <br/>" . $v->iaddress3 . "<br /> " . $v->icity . "<br /> " . $v->istate . "<br /> " . $v->icountry . "<br /> " . $v->izipcode . " <br /> GSTIN No: " . $v->igst ; ; ?></td>
                                                                    <td><?php echo $v->bandwidth; ?></td>
                                                                    <td><?php echo $v->status; ?></td>
                                                                </tr>
                                                            <?php }  ?>
                                                        </tbody>
                                                      </table>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('template/footer'); ?>
