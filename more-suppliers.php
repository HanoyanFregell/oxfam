<?php
session_start();

$mysql = new mysqli("localhost", "root", "", "oxfam");

$supplier = "";
$supplier .= '<div class = "row supplier-list-item-wrapper" style="display: none;">';

$supplier_id = 0;
$company = "";
$name = "";
$owner = "";
$age = "";
$address = "";
$sex = "";
$max = $_POST['max'];
$limit = $_POST['limit'];

$supplier_list_q = $mysql->query("select * from supplier limit $limit");
if ($supplier_list_q->num_rows > 0) {
    $count = 0;
    while ($row = $supplier_list_q->fetch_assoc()) {
        $count++;
        if ($count >= $max) {

            $supplier_id = $row['id'];
            $company = $row['company_name'];
            $name = $row['fname'] . " " . $row['lname'];
            $age = $row['age'];
            $address = $row['address'];
            $sex_num = $row['sex'];


            if ($sex_num == 0) {
                $sex = "Male";
            } else {
                $sex = "Female";
            }
            $supplier .= '<div class="col-sm-4">
                <div class="panel panel-default supplier-list-item">
                    <div class="panel-heading " >
                        <button type="button" class="close delete_supplier_btn" data-id="<?php echo $supplier_id; ?>" data-toggle="modal" data-target="#delete_supplier_modal" >&times;</button>
                        <div class="row" style="padding: 50px 0 50px 0;">
                            <img src="http://mdbootstrap.com/images/ecommerce/products/shoes.jpg" alt="" class="img-fluid center-block">
                        </div>
                        <div class="row text-center" style="font-weight: bold; font-size: 24px;padding-bottom: 50px;">
                            <div class="col-sm-12">
                                ' . $company . '
                            </div>
                        </div>

                        <div class="row" style="padding-bottom: 15px;">
                            <div class="col-sm-2" style="font-weight: bold">
                                Owner:
                            </div>
                            <div class="col-sm-5">
                                ' . $name . '
                            </div>
                            <div class="col-sm-2" style="font-weight: bold">
                                Age:
                            </div>
                            <div class="col-sm-3">
                                ' . $age . '
                            </div>                            </div>
                        <div class="row" style="padding-bottom: 15px;">
                            <div class="col-sm-2" style="font-weight: bold">
                                Address:
                            </div>
                            <div class="col-sm-5">
                                ' . $address . '
                            </div>
                            <div class="col-sm-2" style="font-weight: bold">
                                Sex:
                            </div>
                            <div class="col-sm-3">
                                ' . $sex . '
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row text-center" style="font-weight: bold; font-size: 14px; padding: 20px 0 20px 0;">
                            <div class="col-sm-12">
                                PRODUCE
                            </div>
                        </div>
                        <div class="row" style="padding: 0 30px 0 30px;">';

            $item_id = 0;
            $item_name = "";
            $item_desc = "";
            $item_dimensions = "";
            $item_unit = "";

            $item_check_q = $mysql->query("select * from item where supplier_id =  $supplier_id");
            if ($item_check_q->num_rows > 0) {

                $supplier .= '  <table class="table" >
                                    <thead style="font-size: 12px;">
                                        <tr>
                                            <th>Product</th>
                                            <th class=" text-center">Description</th>
                                            <th class=" text-center">Dimensions</th>
                                            <th class=" text-center">Unit</th>
                                            <th class=" text-center"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                while ($row = $item_check_q->fetch_assoc()) {
                    $item_id = $row['id'];
                    $item_name = $row['name'];
                    $item_desc = $row['description'];
                    $item_dimensions = $row['dimensions'];
                    $item_unit = $row['unit'];

                    $supplier .= '<tr>
                                                <td class="col-md-3" >' . $item_name . '/td>
                                                <td class="col-md-2 text-center">' . $item_desc . '</td>
                                                <td class=" text-center">' . $item_dimensions . '</td>
                                                <td class=" text-center">' . $item_unit . '</td>
                                                <td class=" text-center">
                                                    <button type="button" class="delete_item_btn close" data-id="' . $item_id . '" data-toggle="modal" data-target="#delete_item_modal" >&times;</button>                                              
                                                </td>
                                            </tr>';
                }
                $supplier .= '
                </tbody>
                </table>';
            } else {

                $supplier .= '<div class="container-fluid">
                <p class="lead text-muted text-center">
                    NO PRODUCE REGISTERED
                </p>
            </div>';
            }
            $supplier .= '</div>
        </div>
        <div class="panel-footer ">
            <div class="container-fluid text-center">
                <button class="add_item_btn btn btn-default" data-id="' . $supplier_id. '" type="button"  data-toggle="modal" data-target="#add_item_modal"> 
                    <span class="glyphicon glyphicon-plus"></span> ADD PRODUCE
                </button>
            </div>
        </div>

        </div>
        </div>';
        }
    }
}


$supplier .= '</div>';

echo json_encode($supplier);
