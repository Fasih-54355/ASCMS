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
                        <!-- <li class="sidebar-item with-subitems ">
                         <a class="waves-effect waves-dark" href="../sales/sales_panel.php" aria-expanded="false"><i
                                class=""></i><span class="hide-menu">Sales Records</span></a>
                                <ul class="subitems">
                                    <li><a href="#">Subitem 1</a></li>
                                    <li><a href="#">Subitem 2</a></li>
                                    <!-- Add more subitems as needed 
                                </ul>
                        </li> -->
                        <!-- <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Demand Forecast</span></a>
                        </li> -->
                        <!-- <li> <a class="waves-effect waves-dark" href="../suppliers/suppliers_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Suppliers</span></a>
                        </li> -->
                        <li> <a class="waves-effect waves-dark" href="dist_inventory.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Inventory</span></a>
                        </li>
                        <!-- <li> <a class="waves-effect waves-dark" href="../production/production_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Production</span></a>
                        </li> -->
                        <!-- <li> <a class="waves-effect waves-dark" href="../warehouse/wh_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Warehouse</span></a>
                        </li> -->
                        <li> <a class="waves-effect waves-dark" href="dist_orders.php" aria-expanded="false"><i
                                class=""></i><span class="hide-menu">Orders</span></a>
                        </li>
                        
                        <!-- <li> <a class="waves-effect waves-dark" href="../distributor/distributor_panel.php" aria-expanded="false"><i
                            class=""></i><span class="hide-menu">Distributors</span></a>
                        </li> -->
                        <li> <a class="waves-effect waves-dark" href="retailer_panel.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Retailer</span></a>
                        </li>
                        <!-- <li> <a class="waves-effect waves-dark" href="../logistics/logistics_panel.php" aria-expanded="false"><i
                               class=""></i><span class="hide-menu">Logistics</span></a>
                        </li> -->
                        <li> <a class="waves-effect waves-dark" href="returns.php" aria-expanded="false"><i
                                    class=""></i><span class="hide-menu">Returns</span></a>
                        </li>
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
        