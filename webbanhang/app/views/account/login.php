<?php include 'app/views/shares/header.php'; ?>

<style>
    body {
        background: url('https://cdn.tgdd.vn/mwgcart/mwg-site/ContentMwg/images/backgroundDesktopTGDD.jpg') no-repeat center center fixed;
        background-size: cover;
    }
    .custom-card {
        border-radius: 1rem;
        background: linear-gradient(135deg, #0053a6, #ffcc00);
    }
</style>

<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="card text-white custom-card animate__animated animate__fadeInUp">
                    <div class="card-body p-5 text-center">
                        <form action="/account/checklogin" method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Đăng Nhập</h2>
                                <p class="text-white-50 mb-5">Vui lòng nhập thông tin tài khoản!</p>

                                <!-- Username -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="username" class="form-control form-control-lg" required />
                                    <label class="form-label">Tài khoản</label>
                                </div>

                                <!-- Password -->
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label">Mật khẩu</label>
                                </div>

                                <!-- Forgot Password -->
                                <p class="small mb-5"><a class="text-white-50" href="#">Quên mật khẩu?</a></p>

                                <!-- Login Button -->
                                <button class="btn btn-warning btn-lg px-5 fw-bold" type="submit">
                                    Đăng Nhập
                                </button>

                                <!-- Social Login -->
                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                                    <a href="#" class="text-white mx-2"><i class="fab fa-google fa-lg"></i></a>
                                </div>
                            </div>

                            <!-- Register Link -->
                            <div>
                                <p class="mb-0">Chưa có tài khoản? 
                                    <a href="/account/register" class="text-warning fw-bold">Đăng ký</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>
