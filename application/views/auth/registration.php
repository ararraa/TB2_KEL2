<style>
.custom-input-signup {
    width: 300px;
    border-radius: 20px;
    padding: 8px 15px;
    font-size: 14px;
    margin: 0 auto;
    display: block;
}
.custom-btn-signup {
    padding: 10px 20px;  
    font-size: 14px;     
    width: 150px;         
}

</style>

<div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-4">
                            <div class="text-center">
                                    <img src="<?= base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width: 140px; height: auto;">
                            </div>
                            <div class="p-4">
                            <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control custom-input-signup" id="name" name="name"
                                        placeholder="Full Name" value="<?= set_value('name'); ?>">
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control custom-input-signup" id="email" name="email"
                                        placeholder="Email Address" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control custom-input-signup"
                                            id="password1" name="password1" placeholder="Password">
                                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control custom-input-signup"
                                            id="password2" name="password2" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <div class="text-center">
                                <button type="submit" 
                                        class="btn btn-primary custom-btn-signup" 
                                        style="background-color: #0a0f3c; border-color: #0a0f3c; border-radius: 20px; padding: 10px 30px;">
                                    Sign Up
                                </button>
                                </div>
                            </form>
                           <div class="p-4">
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth')?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
