<?php
// Bắt đầu phiên
session_start();

require_once 'models/UserModel.php';
$userModel = new UserModel();

if (!empty($_POST['submit'])) {
    $users = [
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ];
    $user = NULL;
    if ($user = $userModel->auth($users['username'], $users['password'])) {
        // Đăng nhập thành công
        $_SESSION['id'] = $user[0]['id']; // ID người dùng
        
        // Mã hóa ID để bảo vệ
        $_SESSION['encrypted_id'] = encryptId($user[0]['id']); // Mã hóa ID
        $_SESSION['message'] = 'Login successful';
        header('location: list_users.php');
        exit(); // Thêm exit sau khi chuyển hướng
    } else {
        // Đăng nhập thất bại
        $_SESSION['message'] = 'Login failed';
    }
}
// Giả sử bạn đã có logic xác thực đăng nhập ở đây
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Xác thực username và password tại đây...
    // Nếu đăng nhập thành công, thiết lập session
    $_SESSION['user_id'] = $user['id']; // Thiết lập session người dùng

    // Kiểm tra nếu có trang trước đó mà người dùng định truy cập
    if (!empty($_SESSION['redirect_to'])) {
        $redirect_url = $_SESSION['redirect_to'];
        unset($_SESSION['redirect_to']); // Xóa session sau khi sử dụng
        header("Location: $redirect_url");
    } else {
        // Nếu không có trang redirect, chuyển đến trang mặc định sau khi đăng nhập
        header("Location: dashboard.php");
    }
    exit();
}

// Hàm mã hóa ID
function encryptId($id) {
    return base64_encode($id); // Bạn có thể thay thế bằng thuật toán mã hóa khác
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
<?php include 'views/header.php'?>

    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Login</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body" >
                    <form method="post" class="form-horizontal" role="form">

                        <div class="margin-bottom-25 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">
                        </div>

                        <div class="margin-bottom-25 input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                        </div>

                        <div class="margin-bottom-25">
                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                            <label for="remember"> Remember Me</label>
                        </div>

                        <div class="margin-bottom-25 input-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 control">
                                    Don't have an account!
                                    <a href="form_user.php">
                                        Sign Up Here
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>