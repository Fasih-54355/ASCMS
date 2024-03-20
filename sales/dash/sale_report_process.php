<?php
include '../../config.php';
include_once('sidebar.php');
include_once('../../header.php');

?>
<?php
  if(isset($_POST['submit'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_sale_by_dates($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('sales_report.php', false);
    endif;

  } else {
    $session->msg("d", "Select dates");
    redirect('sales_report.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Default Page Title</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
<?php 
if(!$results) {
    $session->msg("d", "Sorry no sales has been found. ");
    redirect('sales_report.php', false);
}

$display_start_date = isset($start_date) ? $start_date : '';
$display_end_date = isset($end_date) ? $end_date : '';

$total_prices = total_price($results);
$grand_total = number_format($total_prices[0], 2);
$profit = number_format($total_prices[1], 2);

if(isset($db)) { 
    $db->db_disconnect(); 
}
?>
<!DOCTYPE html>
<html>
<body>
    <div class="page-break">
        <div class="sale-head">
            <h1>Inventory Management System - Sales Report</h1>
            <strong><?= $display_start_date ?> TILL DATE <?= $display_end_date ?></strong>
        </div>
        <table class="table table-border">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product Title</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Total Qty</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($results as $result): 
                    $result = array_map('remove_junk', $result);
                ?>
                <tr>
                    <td><?= $result['date']; ?></td>
                    <td class="desc"><h6><?= ucfirst($result['name']); ?></h6></td>
                    <td class="text-right"><?= $result['buy_price']; ?></td>
                    <td class="text-right"><?= $result['sale_price']; ?></td>
                    <td class="text-right"><?= $result['total_sales']; ?></td>
                    <td class="text-right"><?= $result['total_saleing_price']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="text-right">
                    <td colspan="4"></td>
                    <td colspan="1">Grand Total</td>
                    <td>$ <?= $grand_total ?></td>
                </tr>
                <tr class="text-right">
                    <td colspan="4"></td>
                    <td colspan="1">Profit</td>
                    <td>$ <?= $profit ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

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
    <script src="../../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../js/custom.min.js"></script>
    <!-- jQuery peity -->
    <script src="../../assets/node_modules/peity/jquery.peity.min.js"></script>
    <script src="../../assets/node_modules/peity/jquery.peity.init.js"></script>


      </body>
      </html>