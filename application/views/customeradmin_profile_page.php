    <?php $this->load->view('template/header'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/tab.css">
    <script type="text/javascript" src="<?php echo base_url();?>/js/jquery.tabletoCSV.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>/js/customeradmin_page.js"></script>

	
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
                                                <div class="table table-responsive">
                                                    <table class="table table-bordered table-responsive" id="customeradmintable" >
                                                        <thead>
                                                          <tr class="info">
                                                            <th>No</th>
                                                            <th><nobr>SR Number</nobr></th>
                                                            <th>User ID</th>
                                                            <th><nobr>Implementation Address</nobr></th>
							    <th><nobr>Billing Address</nobr></th>
                                                            <th>B/w</th>
                                                            <th>Status</th>
                                                            <th><nobr>Documents Uploaded </nobr></th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($data as $k => $v){ ?>
                                                                <tr>
                                                                    <td style="text-align: center;"><?php echo $k+1; ?></td>
                                                                    <td>
                                                                        <strong>
                                                                            <?php echo $v->request_number . "</strong><br /> <br /> Submitted on: <br /> ". $v->request_date;?>
                                                                            <?php
                                                                                foreach($last_update as $r => $o){
                                                                                    foreach($o as $l =>$e){
                                                                                        if($e->sr_request_number == $v->request_number){
                                                                                            echo "<br /><br /> Last updated<br /> On:<nobr> ". $e->update_date . "</nobr><br />By: ". $e->updated_by ;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        
                                                                    </td>
                                                                    <td><?php echo $v->email;?></td>
                                                                    
                                                                    <td><?php echo $v->company ."<br />". $v->iaddress1 . "<br /> ". $v->iaddress2 . " <br/>" . $v->iaddress3 . "<br /> " . $v->icity . "<br /> " . $v->istate . "<br /> " . $v->icountry . "<br /> " . $v->izipcode . " <br /> GSTIN No: " . $v->igst ; ; ?></td>
								    <td style="text-align: center;"><a href="#" data-toggle="tooltip" title="<?php echo $v->company."\n".$v->baddress1 . "\n ". $v->baddress2 . "\n " . $v->baddress3 . "\n" . $v->bcity . "\n " . $v->bstate . "\n " . $v->bcountry . "\n " . $v->bzipcode . " \n GSTIN No: " . $v->bgst ; ?>"><span class="glyphicon glyphicon-info-sign"></span></a></td>
                                                                    <td style="text-align: center;"><?php echo $v->bandwidth; ?></td>
                                                                    <td><?php echo ucwords($v->status); ?></td>
                                                                    <td>
									<p><strong><u>By Sify:</u></strong></p>
									
                                                                        <?php if($v->status == 'feasible') {
                                                                            foreach ($files as $k => $vu) { ?>
                                                                                <?php foreach($vu as $y => $z) { ?> <ul>
                                                                                    <?php if($z->sr_request_number == $v->request_number) {  ?><li>
                                                                                        <div><a style="color: #cc0000" class="" style="margin-bottom: 5px;margin-top: 5px; " href="<?php echo base_url(); ?>index.php/Login/download/?p=<?php echo $z->fullpath; ?>"><nobr> <?php echo strtoupper($z->filename); ?>  </nobr></a> </div><br/>
                                                                                   </li> <?php } ?></ul>
                                                                                <?php } ?>
                                                                        <?php    } ?>
                                                                        <?php } ?>
									<hr>
									<p><strong><u>By <?php echo $v->company;?>:</u></strong></p>
									
                                                                        <?php foreach($self_files as $l => $e ){
                                                                                foreach($e as $a => $b){ ?><ul>
                                                                                    <?php if($b->sr_request_number == $v->request_number) {?><li>
                                                                                        <div><a class="" style="margin-bottom: 5px;margin-top: 5px; " href="<?php echo base_url(); ?>index.php/Login/download/?p=<?php echo $b->fullpath; ?>"> <nobr><?php echo strtoupper($b->filename); ?>  </nobr></a> </div><br/>
                                                                                   </li> <?php } ?></ul>
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
