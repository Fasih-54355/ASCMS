<div class="header">
          <nav class="navbar navbar-expand">

              <div class="navbar-collapse">
                  <!-- <ul class="navbar-nav ml-auto"> -->
                      <li class="nav-item">
                          <a class="nav-link" href="../wh_panel.php">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url ?>admin/?page=purchase_order">Purchase Order</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url ?>admin/?page=receiving">Receiving</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url ?>admin/?page=back_order">Back Order</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url ?>admin/?page=return">Return List</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url ?>admin/?page=stocks">Stocks</a>
                      </li>
                                            <?php if ($_settings->userdata('type') == 1): ?>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url ?>admin/?page=maintenance/supplier">Supplier List</a>
                          </li>
                      <?php endif; ?>
                  </ul>
              </div>
              </nav>