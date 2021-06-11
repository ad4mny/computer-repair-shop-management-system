  <!-- sidebar -->
  <nav id="sidebar" class="shadow">
      <div class="sidebar-header my-3 p-3">
          <a href="<?php echo base_url(); ?>staff/profile">
              <div class=" d-inline-flex align-middle ">
                  <?php
                    if (decrypt_it($this->session->userdata('picture')) != "") {
                        echo '<img src="' . base_url() . 'assets/img/profile/thumbnail/' . decrypt_it($this->session->userdata('picture')) . '" class="img-fluid rounded-circle shadow border border-3 border-white me-2" width="70">';
                    } else {
                        echo '<span class="fa-stack fa-2x "><i class="fa fa-circle fa-stack-2x text-white"></i><i class="fa fa-user fa-stack-1x text-secondary"></i></span>';
                    }
                    ?>
              </div>
              <div class="d-inline-flex flex-column align-middle">
                  <h5 class="mb-0">
                      <?php echo decrypt_it($this->session->userdata('username')); ?>
                  </h5><br>
                  <small class=" mb-0 fw-light text-white">Technician</small>
              </div>
          </a>
      </div>
      <ul class="list-unstyled components">
          <li class="<?php if ($this->uri->segment(2) == 'dashboard') echo 'active'; ?>"><a href="<?php echo base_url(); ?>staff/dashboard"><i class="fas fa-columns fa-sm fa-fw me-2"></i> Dashboard</a></li>
          <li class="<?php if ($this->uri->segment(2) == 'status') echo 'active'; ?>"><a href="<?php echo base_url(); ?>staff/status"><i class="fas fa-tasks fa-sm fa-fw me-2"></i> Status</a></li>
          <li class="<?php if ($this->uri->segment(2) == 'manage') echo 'active'; ?>"><a href="<?php echo base_url(); ?>staff/manage"><i class="fas fa-cog fa-sm fa-fw me-2"></i> Manage</a></li>
          <li class="pb-3" style="position: absolute;bottom: 0px;"><a href="<?php echo base_url(); ?>logout"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i> Logout</a></li>
      </ul>
  </nav>