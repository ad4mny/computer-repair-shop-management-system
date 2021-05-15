  <!-- sidebar -->
  <nav id="sidebar">
      <div class="sidebar-header my-3">
          <a href="<?php echo base_url(); ?>profile">
              <div class="rounded-circle bg-secondary d-inline p-3"><i class="fas fa-user fa-lg"></i></div>
              <h4 class="d-inline mb-0 ms-2"><?php echo $this->session->userdata('username'); ?></h4>
          </a>
      </div>
      <ul class="list-unstyled components">
          <li class="active"><a href="<?php echo base_url(); ?>dashboard"><i class="fas fa-desktop"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url(); ?>request"><i class="fas fa-copy"></i> Request</a></li>
          <li><a href="<?php echo base_url(); ?>status"><i class="fas fa-stream"></i> Status</a></li>
          <li><a href="<?php echo base_url(); ?>manage"><i class="fas fa-cog"></i> Manage</a></li>
          <li class=" pb-3" style="position: absolute;bottom: 0px;"><a href="<?php echo base_url(); ?>logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
  </nav>