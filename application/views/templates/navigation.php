  <!-- sidebar -->
  <nav id="sidebar">
      <div class="sidebar-header my-3 p-3">
          <a href="<?php echo base_url(); ?>profile">
              <div class="rounded-circle bg-white d-inline-flex p-3 align-middle shadow"><i class="fas fa-user fa-lg text-secondary"></i></div>
              <div class="d-inline-flex flex-column align-middle">
                  <h5 class="mb-0 ms-2 fw-bold">
                      <?php echo $this->session->userdata('username'); ?>
                  </h5><br>
                  <small class=" mb-0 ms-2 fw-light ">User</small>
              </div>
          </a>
      </div>
      <ul class="list-unstyled components">
          <li class="<?php if($this->uri->uri_string() == 'dashboard') echo 'active'; ?>"><a href="<?php echo base_url(); ?>dashboard"><i class="fas fa-desktop"></i> Dashboard</a></li>
          <li class="<?php if($this->uri->uri_string() == 'request') echo 'active'; ?>"><a href="<?php echo base_url(); ?>request"><i class="fas fa-copy"></i> Request</a></li>
          <li class="<?php if($this->uri->uri_string() == 'status') echo 'active'; ?>"><a href="<?php echo base_url(); ?>status"><i class="fas fa-stream"></i> Status</a></li>
          <li class="<?php if($this->uri->uri_string() == 'manage') echo 'active'; ?>"><a href="<?php echo base_url(); ?>manage"><i class="fas fa-cog"></i> Manage</a></li>
          <li class=" pb-3" style="position: absolute;bottom: 0px;"><a href="<?php echo base_url(); ?>logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
  </nav>