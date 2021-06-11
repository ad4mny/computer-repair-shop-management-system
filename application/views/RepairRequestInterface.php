<div class="wrapper">
    <div class="container p-5" id="content">
        <div class="row">
            <div class="col">
                <h3 class="display-4 mb-0 text-secondary ">New Request</h3>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 mx-3">
                <p>Add new repair quotation request here</p>
            </div>
        </div>
        <form method="post" action="<?php echo base_url(); ?>request/add">
            <div class="row mx-3 mb-3 border-start border-2 ">
                <div class="col">
                    <div class="form-group pb-2">
                        <small class="text-muted">Device Brand</small>
                        <input type="text" class="form-control" name="brand" placeholder="Enter device brand" required>
                    </div>
                    <div class="form-group pb-2">
                        <small class="text-muted">Device Model</small>
                        <input type="text" class="form-control" name="model" placeholder="Enter device model" required>
                    </div>
                    <div class="form-group pb-2">
                        <small class="text-muted">Device Color</small>
                        <input type="text" class="form-control" name="color" placeholder="Enter device color" required>
                    </div>
                    <div class="form-group pb-2">
                        <small class="text-muted">Damage Severity</small>
                        <select class="form-control" name="severity" required>
                            <option value="0">Fair</option>
                            <option value="1">Average</option>
                            <option value="2">Worst</option>
                        </select>
                    </div>
                    <div class="form-group pb-2">
                        <small class="text-muted">Damage Information</small>
                        <textarea class="form-control" name="information" row="4" max="100" placeholder="Max 100 characters." required></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group pb-2">
                        <small class="text-muted">Device Pickup Date</small>
                        <input type="date" class="form-control" name="pickup_date" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group pb-2">
                        <small class="text-muted">Device Pickup Time</small>
                        <select class="form-select" name="pickup_time" required>
                            <option value="10:00:00">10.00 AM</option>
                            <option value="14:00:00">2.00 PM</option>
                            <option value="18:00:00">6.00 PM</option>
                            <option value="20:00:00">8.00 PM</option>
                        </select>
                        <small class="text-muted ">Note: Please make sure you are with your device upon runner arrival.</small><br>
                    </div>
                </div>
            </div>
            <div class="row mx-3 mb-3 ">
                <div class="col text-end">
                    <div class="form-group">
                        <a href="<?php echo base_url(); ?>dashboard" class="btn btn-secondary">CANCEL</a>
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">SUBMIT REQUEST <i class="fas fa-chevron-right fa-fw"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>