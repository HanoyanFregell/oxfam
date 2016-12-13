<html>

    <head>
        <title>Oxfam</title>


        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-custom-home.css" rel="stylesheet" type="text/css"/>
         <link href="css2/mdb.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/png" href="resources/Oxfam_Circle_Green-min.png"/>
  

       <script src="js2/bootstrap.min.js" type="text/javascript"></script>
        <script src="js2/jquery.min.js" type="text/javascript"></script>
        <script src="js2/mdb.min.js" type="text/javascript"></script>
        <?php
        session_start();

        $mysql = new mysqli("localhost", "root", "", "oxfam");
        ?>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <img src="resources/Oxfam_Circle_Green-min.png" class="symbol" />
                </div>

                <ul class="nav navbar-nav ">
                    <li ><a href="home.php">DASHBOARD</a></li>
                     <!--    <li><a href="orders.php" >ORDERS</a></li>-->    
                    <li  class="active"><a href="inventory.php"  >INVENTORY</a></li> 
                    <li><a href="suppliers.php"  >SUPPLIERS</a></li> 
                    <li><a href="reports.php"  >REPORTS</a></li> 
                </ul>

                <form class="navbar-form navbar-right">
                    <div class="input-group has-feedback search-bar-wrapper">
                        <input type="text" class="form-control search-bar" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>

            </div>
        </nav>

        <div class="container-fluid text-center " style="padding-top:50px; font-size: 45px;font-weight: bold;">
            <div class="row">
                INVENTORY
            </div>
        </div>

        <div class="container-fluid" style="padding: 50px 100px 0 100px;">
            <div class="input-group has-feedback search-bar-wrapper pull-right">
                <input type="text" class="form-control search-bar" placeholder="Find Produce">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
        </div>


        <div class="container-fluid " style=" padding-top: 100px; margin: 0 100px 0 100px;">
            <table class="table" style="">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class=" text-center">Price</th>
                        <th class=" text-center">Unit</th>
                        <th class=" text-center">In Stock</th>
                        <th class=" text-center ">Add Stock</th>
                        <th class=" text-center "></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $item_id = 0;
                    $item_name = "";
                    $item_price = "";
                    $supplier_company = "";
                    $item_description = "";
                    $item_dimensions = "";
                    $item_unit = "";
                    $inventory_quantity = 0;

                    $item_list_q = $mysql->query("select item.id,supplier.company_name,item.name,item.price,item.description,item.dimensions,item.unit, inventory.quantity from item left join supplier on item.supplier_id = supplier.id left join inventory on inventory.item_id = item.id limit 5");

                    if ($item_list_q->num_rows > 0) {
                        while ($row = $item_list_q->fetch_assoc()) {
                            $item_id = $row['id'];
                            $item_name = $row['name'];
                            $item_price = $row['price'];
                            $supplier_company = $row['company_name'];
                            $item_description = $row['description'];
                            $item_dimensions = $row['dimensions'];
                            $item_unit = $row['unit'];
                            $inventory_quantity = $row['quantity'];
                            ?>

                            <tr>
                                <td class="col-md-3" >
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="http://mdbootstrap.com/images/ecommerce/products/shoes.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-sm-4">
                                            <h3><strong><?php echo $item_name; ?></strong></h3>
                                            <p class="text-muted"><?php echo $supplier_company; ?></p>
                                        </div>

                                    </div>
                                </td>
                                <td class="col-md-2 text-center"><?php echo $item_price; ?></td>
                                <td class=" text-center"><?php echo $item_unit; ?></td>
                                <td class=" text-center"><?php echo $inventory_quantity; ?></td>
                                <td class="col-sm-1 center-block text-center">
                                    <input type="number" class="form-control text-center " value="0" id="new-stock-count<?php echo $item_id; ?>" />
                                </td>
                                <td class=" col-sm-1 center-block text-center">
                                    <button class=" btn btn-default add-stock"  type="button" data-id="<?php echo $item_id; ?>" data-stock="<?php echo $inventory_quantity; ?>" data-toggle="modal" data-target="#add_stock_modal"> 
                                        <span class="glyphicon glyphicon-plus"></span> Add
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container-fluid text-center" style='padding: 20px 0 50px 0' >
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


        <div class="modal fade" id="add_stock_modal" role="dialog" style="padding-top: 15%;">
            <div class="modal-dialog" >
                <!-- Modal content-->
                <form method="POST" id="add_stock_form" action="add_stock.php"  style="margin: 0 50px 0 50px ;">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Supplier</h4>
                        </div>
                        <div class="modal-body text-center"  >

                            <input type="hidden" class="form-control" id="id"  name="id" />
                            <input type="hidden" class="form-control" id="stock"  name="stock" />
                            <input type="hidden" class="form-control" id="quantity"  name="quantity" />
                            <p>Are you sure you want to add stock?</p>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" id="delete_supplier" name="add_stock">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>

    <script>

     
        $(document).on("click", ".add-stock", function () {
            var id = $(this).data('id');
            var stock = $(this).data('stock');
            var quantity = document.getElementById("new-stock-count" + id).value;
            $(".modal-body #id").val(id);
            $(".modal-body #stock").val(stock);
            $(".modal-body #quantity").val(quantity);
            $(".modal-body").append("<p class='text-warning'>Additional Stock: " + quantity + "<p>");
        });

        $("#add_stock_form").on("submit", function (e) {

            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");

            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function (data) {
                    $('#add_stock_form .modal-header .modal-title').html("");
                    $('#add_stock_form .modal-body').html(data);
                    $("#add_stock").remove();

                },
                error: function (status, error) {
                    console.log(status + ": " + error);
                }
            });
            e.preventDefault();
        });

        $('#add_stock_modal').on('hidden.bs.modal', function () {
            location.reload();
        });
    </script>


</html>