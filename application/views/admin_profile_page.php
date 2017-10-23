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
                                    <!-- <li><a href="#tab2primary" data-toggle="tab">New Request</a></li> -->
                                    <!-- <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li> -->
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
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($data as $key => $value) { ?>
                                                        <? //print_r($value); ?>
                                                    <form method="post" action="http://localhost/cip/index.php/Login/update_status">
                                                     <tr>
                                                        <td><?php echo $key+1 ; ?></td>
                                                        <td><?php echo $value->request_number; ?></td>
                                                        <td><?php echo $value->user_id; ?></td>
                                                        <td><?php echo $value->baddress1 . "<br /> ". $value->baddress2 . " <br/>" . $value->baddress3 . "<br /> " . $value->bcity . "<br /> " . $value->bstate . "<br /> " . $value->bcountry . "<br /> " . $value->bzipcode; ?></td>
                                                        <td><?php echo $value->iaddress1 . "<br /> ". $value->iaddress2 . " <br/>" . $value->iaddress3 . "<br /> " . $value->icity . "<br /> " . $value->istate . "<br /> " . $value->icountry . "<br /> " . $value->izipcode; ?></td>
                                                        <td><select name="status" class="form-control">

                                                                <option value="Initiated">Initiated</option>
                                                                <option value="wip">Work In Progress</option>
                                                                <option value="resolved">Resolved</option>
                                                                <option value="unresolved">Unresolved</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="hidden" name="req_num" value="<?php echo $value->request_number; ?>"/>
                                                            <input type="hidden" name="req_id" value="<?php echo $value->id; ?>"/>
                                                            <button type="submit" class="btn btn-success">Change</button>

                                                        </td>
                                                      </tr>

                                                    </form>

                                                    <?php } ?>

                                                    </tbody>
                                                  </table>
                                            </div>
                                    </div>
                                </div>
                                <!-- New Request tab starts here -->
                                <div class="tab-pane fade" id="tab2primary">

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
