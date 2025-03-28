<?php include 'app/views/shares/header.php'; ?>

<style>
    /* Background đẹp mắt */
    body {
        background: url('https://source.unsplash.com/1600x900/?technology,abstract') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    /* Overlay tạo hiệu ứng mờ */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Lớp phủ màu đen mờ */
        z-index: -1;
    }

    /* Card đăng ký */
    .register-card {
        background: linear-gradient(135deg, #212529, #ffc107);
        border-radius: 1rem;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-in-out;
    }

    /* Hiệu ứng button */
    .btn-register {
        background: #ffc107;
        color: #212529;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }

    .btn-register:hover {
        background: #ffdb4d;
        transform: scale(1.05);
        box-shadow: 0px 0px 10px rgba(255, 209, 67, 0.6);
    }
</style>

<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container" style="max-width: 75%;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card text-white register-card animate__animated animate__fadeInUp">
                    <div class="card-body p-5 text-center">

                        <h2 class="fw-bold mb-4 text-uppercase">Đăng Ký</h2>
                        <p class="text-white-50 mb-4">Tạo tài khoản ngay hôm nay!</p>

                        <?php
                        if (isset($errors)) {
                            echo "<ul class='text-danger'>";
                            foreach ($errors as $err) {
                                echo "<li>$err</li>";
                            }
                            echo "</ul>";
                        }
                        ?>

                        <form action="/account/save" method="post">
                            <!-- Username & Fullname -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3">
                                    <input type="text" class="form-control form-control-lg" 
                                           id="username" name="username" 
                                           placeholder="Tài khoản" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-lg" 
                                           id="fullname" name="fullname" 
                                           placeholder="Họ và Tên" required>
                                </div>
                            </div>

                            <!-- Password & Confirm Password -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3">
                                    <input type="password" class="form-control form-control-lg" 
                                           id="password" name="password" 
                                           placeholder="Mật khẩu" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-lg" 
                                           id="confirmpassword" name="confirmpassword" 
                                           placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <div class="form-group text-center">
                                <button class="btn btn-register btn-lg px-5" type="submit">
                                    Đăng Ký
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="mt-3">
                                <p class="mb-0">Đã có tài khoản? 
                                    <a href="/account/login" class="text-warning fw-bold">Đăng Nhập</a>
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
