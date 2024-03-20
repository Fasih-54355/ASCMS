<style>
    .subitems {
        display: none;
        list-style-type: none;
        padding: 0;
        margin-top: 0;
        position: absolute;
        background-color: #2b2b2b;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 2; /* Ensure the dropdown is above other content */
    }

    .with-subitems {
        position: relative;
        z-index: 1; /* Ensure the dropdown is above other content */
    }

    .with-subitems:hover .subitems {
        display: block;
        top: 100%; /* Position the dropdown below the parent list item */
        left: 0;
        position: absolute;
    }

    .subitems li {
        padding: 10px;
    }

    .subitems li a {
        color: white;
        text-decoration: none;
        display: block;
    }

    .subitems li a:hover {
        background-color: #4a4a4a;
    }

    .left-sidebar {
        width: 220px;
    }

    .page-wrapper {
        margin-left: 220px;
        transition: margin-left 0.5s;
    }

    .left-sidebar .sidebar-nav ul#sidebarnav li a {
        text-align: left;
        z-index: 0; /* Set a lower z-index for the items below */
    }

    .left-sidebar .sidebar-nav ul#sidebarnav li.with-subitems:hover ~ li {
        margin-top: 50px; /* Adjust the margin-top based on the height of the subitems */
    }
</style>

<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="dashboard.php" aria-expanded="false"><i
                                 class=""></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="treeview">
          <a href="#"><i class="fa fa-file-text"></i> <span>Invoices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="invoice-create.php"><i class="fa fa-plus"></i>Create Invoice</a></li>
            <li><a href="invoice-list.php"><i class="fa fa-cog"></i>Manage Invoices</a></li>
            <li><a href="#" class="download-csv"><i class="fa fa-download"></i>Download CSV</a></li>
          </ul>
        </li>
        <!-- Menu 2 -->
         <li class="treeview">
          <a href="#"><i class="fa fa-archive"></i><span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="product-add.php"><i class="fa fa-plus"></i>Add Products</a></li>
            <li><a href="product-list.php"><i class="fa fa-cog"></i>Manage Products</a></li>
          </ul>
        </li>
        <!-- Menu 3 -->
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i><span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="customer-add.php"><i class="fa fa-user-plus"></i>Add Customer</a></li>
            <li><a href="customer-list.php"><i class="fa fa-cog"></i>Manage Customers</a></li>
          </ul>
        </li>
        
        <!-- Menu 4 -->
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i><span>System Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="user-add.php"><i class="fa fa-plus"></i>Add User</a></li>
            <li><a href="user-list.php"><i class="fa fa-cog"></i>Manage Users</a></li>
          </ul>
        </li>
                        <!-- <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Demand Forecast</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../suppliers/suppliers_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Suppliers</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../inventory/inventory_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Inventory</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../production/production_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Production</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../warehouse/wh_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Warehouse</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../orders/orders_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Orders</span></a>
                        </li>
                        
                        <li> <a class="waves-effect waves-dark" href="../distributor/distributor_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Distributors</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../retailer/retailer_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Retailer</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../logistics/logistics_panel.php" aria-expanded="false"><i
                               class=""></i><span class="hide-menu">Logistics</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../reports/reports.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Reports</span></a>
                        </li> -->
                        <!-- <li> <a class="waves-effect waves-dark" href="../invoice/index.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Invoice</span></a>
                        </li> -->
                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Settings</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Sidebar - style in sidebar.scss  -->
        