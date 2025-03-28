<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Quản Lý Sản Phẩm</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
    <footer class="footer bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Contact Information Column -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4 position-relative animate__animated animate__fadeIn">
                        Quản Lý Sản Phẩm
                        <span class="underline-effect"></span>
                    </h5>
                    <p class="text-muted">
                        Hệ thống quản lý sản phẩm tối ưu giúp bạn theo dõi và cập nhật 
                        thông tin sản phẩm một cách chuyên nghiệp và hiệu quả.
                    </p>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-envelope me-2"></i>Email: support@quanlysp.com
                        </small>
                    </div>
                </div>

                <!-- Quick Links Column -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4 position-relative animate__animated animate__fadeIn">
                        Liên Kết Nhanh
                        <span class="underline-effect"></span>
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/Product/" class="text-white text-decoration-none hover-link">
                                <i class="fas fa-angle-right me-2"></i>Danh sách sản phẩm
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/Product/add" class="text-white text-decoration-none hover-link">
                                <i class="fas fa-angle-right me-2"></i>Thêm sản phẩm
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media Column -->
                <div class="col-lg-4 col-md-12">
                    <h5 class="text-uppercase fw-bold mb-4 position-relative animate__animated animate__fadeIn">
                        Kết Nối Với Chúng Tôi
                        <span class="underline-effect"></span>
                    </h5>
                    <div class="social-icons d-flex gap-3">
                        <a href="#" class="social-link facebook animate__animated animate__zoomIn" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link twitter animate__animated animate__zoomIn" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link instagram animate__animated animate__zoomIn" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="copyright py-3 bg-gradient-dark text-center">
            <p class="mb-0 animate__animated animate__fadeIn">
                © 2025 Quản Lý Sản Phẩm. All rights reserved. 
                <span class="ms-2">Designed with <i class="fas fa-heart text-warning animate__animated animate__heartBeat animate__infinite"></i></span>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        /* Màu sắc chủ đạo vàng-đen */
        :root {
            --primary-gold: #FFD700;
            --primary-dark: #000000;
            --secondary-dark: #1a1a1a;
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.7);
        }

        .footer {
            background: linear-gradient(180deg, var(--primary-dark), var(--secondary-dark));
        }

        .bg-gradient-dark {
            background: linear-gradient(180deg, var(--secondary-dark), #15191c);
            border-top: 1px solid var(--primary-gold);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .underline-effect {
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        h5:hover .underline-effect {
            width: 100px;
        }

        h5 {
            color: var(--primary-gold);
        }

        .hover-link {
            transition: all 0.3s ease;
            color: var(--text-light);
        }

        .hover-link:hover {
            color: var(--primary-gold) !important;
            padding-left: 10px;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-dark);
            border: 1px solid var(--primary-gold);
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
            background: var(--primary-gold);
            color: var(--primary-dark);
        }

        .facebook:hover { background: var(--primary-gold); }
        .twitter:hover { background: var(--primary-gold); }
        .instagram:hover { background: var(--primary-gold); }

        .copyright p {
            color: var(--text-muted);
        }

        .copyright p span i {
            color: var(--primary-gold);
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .footer .col-md-6, .footer .col-md-12 {
                text-align: center;
            }
            .social-icons {
                justify-content: center;
            }
        }
    </style>
</body>
</html>