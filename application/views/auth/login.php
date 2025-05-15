<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <!-- Logo Section -->
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width: 120px; height: auto;">
                                </div>
                                <!-- Form Section -->
                                <div class="p-4">
                                    <?= $this->session->flashdata('message'); ?>
                                    
                                    <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control custom-input"
                                                id="email" name="email"
                                                placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control custom-input"
                                                id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                            
                                            
                                            <div class="text-right mt-1">
                                                <a class="small text-decoration-none" href="forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        
                                        <!-- Login Button -->
                                    <div class="d-flex justify-content-center">
                                       <button type="submit" class="btn btn-primary btn-user btn-block custom-btn" style="background-color: #0a0f3c; border-color: #0a0f3c;">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                    
                                    <!-- Create Account Link -->
                                    <div class="text-center mt-3">
                                        <a class="small" href="<?= base_url('auth/registration') ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>