<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
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
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top">
            <div class="container-fluid px-4">
                <!-- Brand Logo with Rabbit Icon -->
                <a class="navbar-brand fw-bold d-flex align-items-center animate__animated animate__bounceInLeft" href="/">
                    <i class="fas fa-paw me-2 rabbit-icon"></i> <!-- Icon bàn chân thay cho thỏ -->
                    <span>KanTrun</span>
                </a>

                <!-- Toggler Button -->
                <button class="navbar-toggler" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Items -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav gap-3">
                        <li class="nav-item">
                            <a class="nav-link transition-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" 
                               href="/Product/">
                                <i class="fas fa-list me-1"></i>Danh sách sản phẩm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link transition-link" href="/Product/add">
                                <i class="fas fa-plus-circle me-1"></i>Thêm sản phẩm
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle transition-link" 
                               href="#" 
                               id="categoryDropdown" 
                               role="button" 
                               data-bs-toggle="dropdown" 
                               aria-expanded="false">
                                <i class="fas fa-folder-open me-1"></i>Danh mục
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark animate__animated animate__fadeIn">
                                <!-- Danh sách danh mục -->
                                <li><a class="dropdown-item" href="/Category/index">Danh sách danh mục</a></li>
                                <!-- Thêm danh mục -->
                                <li><a class="dropdown-item" href="/Category/add_category">Thêm danh mục</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Actions -->
                    <ul class="navbar-nav gap-3 align-items-center">
                        <li class="nav-item">
                            <form class="d-flex" action="/Product/search" method="GET">
                                <input class="form-control me-2 search-input" 
                                       type="search" 
                                       placeholder="Tìm kiếm..." 
                                       name="query">
                                <button class="btn btn-warning transition-all" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link transition-link position-relative" href="/Product/cart/">
                                <i class="fas fa-shopping-cart"></i>
                                <span id="cart-count" class="badge bg-warning text-dark position-absolute top-0 start-100 translate-middle-y rounded-circle">
                                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle transition-link d-flex align-items-center" 
                               href="#" 
                               id="userDropdown" 
                               role="button" 
                               data-bs-toggle="dropdown" 
                               aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                <?php
                                if (class_exists('SessionHelper') && SessionHelper::isLoggedIn()) {
                                    echo htmlspecialchars($_SESSION['username']);
                                } else {
                                    echo "Tài khoản";
                                }
                                ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end animate__animated animate__fadeIn">
                                <?php
                                if (class_exists('SessionHelper') && SessionHelper::isLoggedIn()) {
                                    echo '<li><a class="dropdown-item" href="/Profile/">Hồ sơ</a></li>';
                                    echo '<li><a class="dropdown-item" href="/Orders/">Đơn hàng</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item text-warning" href="/account/login">Đăng nhập</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <!-- Nút Đăng nhập riêng khi chưa đăng nhập -->
                        <?php
                        if (!class_exists('SessionHelper') || !SessionHelper::isLoggedIn()) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link transition-link text-warning" href="/account/login">';
                            echo '<i class="fas fa-sign-in-alt me-1"></i>Đăng nhập';
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                        <!-- Nút Đăng xuất riêng khi đã đăng nhập -->
                        <?php
                        if (class_exists('SessionHelper') && SessionHelper::isLoggedIn()) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link transition-link text-warning" href="/account/logout">';
                            echo '<i class="fas fa-sign-out-alt me-1"></i>Đăng xuất';
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5 pt-5">
        <!-- Main content -->
    </div>

    <!-- Bootstrap 5 JS (CDN mới) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" 
            integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEG3imfuvojJj7eHg78MXMXcRVRvJNZdAvxA==" 
            crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        /* Your custom styles here */
    </style>

    <!-- Custom JavaScript -->
    <script>
        // Your custom scripts here
    </script>
</body>
</html>
