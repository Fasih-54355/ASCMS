<style>

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
                        <li> <a class="waves-effect waves-dark" href="../../admin/dashboard.php" aria-expanded="false"><i
                                 class=""></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="admin.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Sales Records</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../demand_forecast/demand.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Demand Forecast</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../suppliers/suppliers_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Suppliers</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../inventory/InventorySystem_PHP/product.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Inventory</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../production/production_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Production</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../warehouse/wh_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Warehouse</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../orders/orders_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Orders</span></a>
                        </li>
                        
                        <li> <a class="waves-effect waves-dark" href="../../distributor/distributor_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Distributors</span></a>
                        </li>
                        <!-- <li> <a class="waves-effect waves-dark" href="../retailer/retailer_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Retailer</span></a>
                        </li> -->
                        <li> <a class="waves-effect waves-dark" href="../../logistics/logistics_panel.php" aria-expanded="false"><i
                               class=""></i><span class="hide-menu">Logistics</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="../../reports/reports.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Reports</span></a>
                        </li>
                        <!-- <li> <a class="waves-effect waves-dark" href="../invoice/index.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Invoice</span></a>
                        </li> -->
                        <!-- <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Settings</span></a> -->
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Sidebar - style in sidebar.scss  -->
        