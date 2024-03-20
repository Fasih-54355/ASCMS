<!DOCTYPE html>
<html>
<head>
	<!-- <title> Admin: Home </title>
	<link rel="stylesheet" href="../includes/main_style.css" > -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, AdminWrap lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, AdminWrap lite design, AdminWrap lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="AdminWrap Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
	<?php
    	include '../../header.php';
		include 'config.php';
    
		include '../../sidebar.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if the form is submitted
            $po_code = $_POST['po_code'];
            $supplier_id = $_POST['supplier_id'];
            $amount = $_POST['amount'];
            $discount_perc = $_POST['discount_perc'];
            $discount = $_POST['discount'];
            $tax_perc = $_POST['tax_perc'];
            $tax = $_POST['tax'];
            $remarks = $_POST['remarks'];
        
            // Your SQL query to insert data into the database
         // Your SQL query to insert data into the database
        $query = "INSERT INTO purchase_order_list (po_code, supplier_id, amount, discount_perc, discount, tax_perc, tax, remarks)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $conn->prepare($query);
        
        // Bind parameters
        $stmt->bind_param("ssddddss", $po_code, $supplier_id, $amount, $discount_perc, $discount, $tax_perc, $tax, $remarks);
        
        // Execute the query
        $result = $stmt->execute();
        
        // Check for success
        if ($result) {
        echo "Data inserted successfully!";
        } else {
        echo "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
        }
                    ?>
	<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    
        <div class="header">
            <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                            
                            <nav>
                            <a href="../wh_panel.php">Home</a><!--
                                        --><a href="../wh_detail.php">Warehouse Detail</a><!--
                                        --><a href="../../raw_material/raw_material.php">Raw Material Inventory</a><!--
                                        --><a href="../../inventory/InventorySystem_PHP/product.php">Product Inventory</a>
                                        <a href="purchase_order.php">purchase_order</a><!--
                                        --><a href="receiving.php">receiving</a><!--
                                            --><a href="back_order.php">back_order</a>
                                            <a href="return_list.php">return_list</a>
                                            
                                    <a href="stocks.php">stocks</a>
                                    <!-- <a href="../admin/view_invoice.php">Invoice</a> -->
                            </nav>

                        </li>
                    </ul>
            </div>
        </div>
        <br>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- Recently Added Products -->
        <div class="row mt-3">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Inventory Details</h4> -->
                        <!-- <div class="card card-outline card-primary"> -->
	<div class="card-header">
		<h3 class="card-title">List of Purchase Orders</h3>
        <div class="card-tools">
        <a href="add_order.php" class="btn btn-flat btn-primary btn-create-new">
        <span class="fas fa-plus"></span>Create New
    </a></div>

	</div>
   <!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add new order -->
                <form id="addOrderForm">
                    <div class="form-group">
                        <label for="po_code">P.O. Code</label>
                        <input type="text" class="form-control" id="po_code" name="po_code" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select class="form-control" id="supplier_id" name="supplier_id" required>
                            <option value="" disabled selected>Select Supplier</option>
                            <?php
                            // Fetch suppliers from the database (replace this with your logic)
                            $supplierQuery = $conn->query("SELECT id, name FROM supplier_list WHERE status = 1 ORDER BY name ASC");
                            while ($row = $supplierQuery->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="discount_perc">Discount Percentage</label>
                        <input type="number" class="form-control" id="discount_perc" name="discount_perc" required>
                    </div>
                    <div class="form-group">
                        <label for="tax_perc">Tax Percentage</label>
                        <input type="number" class="form-control" id="tax_perc" name="tax_perc" required>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                    <!-- You can add more fields as needed -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addOrderModal">Add Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-create-new').click(function () {
            $('#addOrderModal').modal('show');
        });

        $('#addOrderForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'purchase_order.php',
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('#addOrderModal').modal('hide');
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<div class="card-body">
    <div class="container-fluid">
        <div class="container-fluid">
            <table class="table table-bordered table-stripped">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="20%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>PO Code</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT p.*, s.name as supplier FROM `purchase_order_list` p INNER JOIN supplier_list s ON p.supplier_id = s.id ORDER BY p.`date_created` DESC");
                    while($row = $qry->fetch_assoc()):
                        $row['items'] = $conn->query("SELECT COUNT(item_id) AS `items` FROM `po_items` WHERE po_id = '{$row['id']}'")->fetch_assoc()['items'];
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['po_code'] ?></td>
                            <td><?php echo $row['supplier'] ?></td>
                            <td class="text-right"><?php echo number_format($row['items']) ?></td>
                            <td class="text-center">
                                <?php if ($row['status'] == 0): ?>
                                    <span class="badge badge-primary rounded-pill">Pending</span>
                                <?php elseif ($row['status'] == 1): ?>
                                    <span class="badge badge-warning rounded-pill">Partially received</span>
                                <?php elseif ($row['status'] == 2): ?>
                                    <span class="badge badge-success rounded-pill">Received</span>
                                <?php else: ?>
                                    <span class="badge badge-danger rounded-pill">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <?php if ($row['status'] == 0): ?>
                                        <a class="dropdown-item" href="<?php echo base_url.'admin?page=receiving/manage_receiving&po_id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-boxes text-dark"></span> Receive</a>
                                        <div class="dropdown-divider"></div>
                                    <?php endif; ?>
                                    <a class="dropdown-item" href="<?php echo base_url.'admin?page=purchase_order/view_po&id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url.'admin?page=purchase_order/manage_po&id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
	        <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.min.js"></script>
    <!-- jQuery peity -->
    <script src="../assets/node_modules/peity/jquery.peity.min.js"></script>
    <script src="../assets/node_modules/peity/jquery.peity.init.js"></script>
    <!-- <script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Purchase Order permanently?","delete_po",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Payment Details","transaction/view_payment.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_po($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script> -->

</body>
</html>