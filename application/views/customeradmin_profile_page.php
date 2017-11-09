    <?php $this->load->view('template/header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/tab.css">
    <script type="text/javascript" src="<?php echo base_url();?>/js/jquery.tabletoCSV.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/js/customeradmin_page.js"></script>

    <style>
    .table {
        margin-left: 10px;
        margin-right: 10px;
        width: 98%;
    }

    .table td  {
       text-align: center;
    }
    .table th  {
       text-align: center;
    }
    </style>
    <script>

    </script>

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
                                                <button class="btn btn-info" style="margin-left : 10px; margin-bottom:10px;" id="print">Download</button>
                                                <div class="table">
                                                    <table class="table table-bordered table-responsive" id="customeradmintable">
                                                        <thead>
                                                          <tr>
                                                            <th>No</th>
                                                            <th>SR Number</th>
                                                            <th>User ID</th>
                                                            <th>Billing Address</th>
                                                            <th>Implementation Address</th>
                                                            <th>Bandwidth</th>
                                                            <th>Status</th>
                                                            <th>Documents Uploaded till now </th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($data as $k => $v){ ?>
                                                                <tr>
                                                                    <td><?php echo $k+1; ?></td>
                                                                    <td><strong><?php echo $v->request_number . "<br /> <br /> Requested on : ". $v->request_date;?></strong></td>
                                                                    <td><?php echo $v->email;?></td>
                                                                    <td><a href="#" data-toggle="tooltip" title="<?php echo $v->company."\n".$v->baddress1 . "\n ". $v->baddress2 . "\n " . $v->baddress3 . "\n" . $v->bcity . "\n " . $v->bstate . "\n " . $v->bcountry . "\n " . $v->bzipcode . " \n GSTIN No: " . $v->bgst ; ?>"><span class="glyphicon glyphicon-info-sign"></span></a></td>
                                                                    <!-- <td><?php //echo $v->company ."<br />".$v->baddress1 . "<br /> ". $v->baddress2 . " <br/>" . $v->baddress3 . "<br /> " . $v->bcity . "<br /> " . $v->bstate . "<br /> " . $v->bcountry . "<br /> " . $v->bzipcode . " <br /> GSTIN No: " . $v->bgst ; ?></td> -->
                                                                    <td><?php echo $v->company ."<br />". $v->iaddress1 . "<br /> ". $v->iaddress2 . " <br/>" . $v->iaddress3 . "<br /> " . $v->icity . "<br /> " . $v->istate . "<br /> " . $v->icountry . "<br /> " . $v->izipcode . " <br /> GSTIN No: " . $v->igst ; ; ?></td>
                                                                    <td><?php echo $v->bandwidth; ?></td>
                                                                    <td><?php echo $v->status; ?></td>
                                                                    <td> 
                                                                        <?php if($v->status == 'feasible') {
                                                                            foreach ($files as $k => $vu) { ?>
                                                                                <?php foreach($vu as $y => $z) { ?>
                                                                                    <?php if($z->sr_request_number == $v->request_number) {  ?>
                                                                                        <div><a class="" style="margin-bottom: 5px;margin-top: 5px; " href="http://localhost/cip/index.php/Login/download/?p=<?php echo $z->fullpath; ?>"> <?php echo ucfirst($z->filename); ?>  </a> </div><br/>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                        <?php    } ?>
                                                                        <?php } ?>
                                                                        <?php foreach($self_files as $l => $e ){
                                                                                foreach($e as $a => $b){ ?>
                                                                                    <?php if($b->sr_request_number == $v->request_number) {?>
                                                                                        <div><a class="" style="margin-bottom: 5px;margin-top: 5px; " href="http://localhost/cip/index.php/Login/download/?p=<?php echo $b->fullpath; ?>"> <?php echo ucfirst($b->filename); ?>  </a> </div><br/>
                                                                                    <?php } ?>
                                                                            <? }
                                                                        } ?>
                                                                    </td>
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
