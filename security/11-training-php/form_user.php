<?php
// Bắt đầu phiên
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

// Hàm mã hóa và giải mã ID
function encryptId($id) {
    return base64_encode($id);
}

function decryptId($encryptedId) {
    return base64_decode($encryptedId);
}

$user = NULL; // Biến để lưu thông tin người dùng
$_id = NULL;

if (!empty($_GET['id'])) {
    // Giải mã ID từ URL
    $_id = decryptId($_GET['id']); // Nhận giá trị đã mã hóa từ URL và giải mã
    // Kiểm tra nếu ID hợp lệ
    if (is_numeric($_id)) {
        $user = $userModel->findUserById($_id); // Tìm user theo ID đã giải mã
    }
}

if (!empty($_POST['submit'])) {
    $errors = []; // Mảng lưu trữ lỗi

    // Kiểm tra thông tin name
    if (empty($_POST['name'])) {
        $errors[] = 'Name is required.';
    } elseif (!preg_match('/^[A-Za-z0-9]{5,15}$/', $_POST['name'])) {
        $errors[] = 'Name must be between 5 and 15 characters and can only contain letters and numbers.';
    }

    // Kiểm tra thông tin password
    if (empty($_POST['password'])) {
        $errors[] = 'Password is required.';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!@#$%^&*()]).{5,10}$/', $_POST['password'])) {
        $errors[] = 'Password must be between 5 and 10 characters, and include at least one lowercase letter, one uppercase letter, one number, and one special character.';
    }

    // Nếu có lỗi, lưu lỗi vào phiên
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    } else {
        // Nếu không có lỗi, tiến hành xử lý cập nhật
        if (!empty($_POST['id'])) {
            $id = decryptId($_POST['id']); // Giải mã ID từ form
            if (is_numeric($id)) {
                $userModel->updateUser($_POST);
            }
        } else {
            $userModel->insertUser($_POST);
        }
        header('location: list_users.php');
        exit(); // Thêm exit() sau khi chuyển hướng
    }
}
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    // Lưu lại trang hiện tại để sau khi đăng nhập có thể quay lại
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    
    // Chuyển hướng người dùng đến trang login
    header('Location: login.php');
    exit();
}

// Sau khi người dùng đã đăng nhập, tiếp tục thực hiện logic cập nhật
require_once 'models/UserModel.php';
$userModel = new UserModel();

// Tiếp tục logic hiện tại của bạn...

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php'; ?>
</head>
<body>
    <?php include 'views/header.php'; ?>
    <div class="container">

        <?php if (!empty($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['errors']); // Xóa thông báo lỗi sau khi hiển thị ?>
        <?php endif; ?>

        <?php if ($user || !isset($_id)) { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <form method="POST">
                <!-- Mã hóa ID khi gửi form -->
                <input type="hidden" name="id" value="<?php echo encryptId($_id); ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user[0]['name'])) echo $user[0]['name']; ?>' required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>
</html>
