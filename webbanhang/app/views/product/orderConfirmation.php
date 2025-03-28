<!-- app/views/shares/header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: white;
            animation: fadeIn 0.5s ease-in;
            text-align: center;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        h1 {
            color: #333;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }
        
        p {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 1.1em;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.3);
        }
        
        .success-icon {
            color: #28a745;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Trang xác nhận đơn hàng -->
<?php include 'app/views/shares/header.php'; ?>
<div class="confirmation-container">
    <i class="fas fa-check-circle success-icon"></i>
    <h1>Xác nhận đơn hàng</h1>
    <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý thành công.</p>
    <a href="/Product" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
</div>
<?php include 'app/views/shares/footer.php'; ?>
<!-- app/views/shares/footer.php -->
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>