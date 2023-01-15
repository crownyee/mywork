<!DOCTYPE html>
<html lang="zh-TW">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

    <title>登入</title>
    <link rel='stylesheet' href="./assets/css/ylog.css">
    <link rel="shortcut icon" href="./assets/images/icon.png">
</head>
<body>
    <div class="container">
        <div class="signin-sign-up">
            <form action="Overview.php" class="sign-in-form">
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="名字">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="密碼">
                </div>
                <a href="#" class="forgot-password">忘記密碼🤬</a>
                <a href="Com.php"><input type="submit" value="Login" class="btn"></a>
                <p>沒有帳號😞 <a href="#" class="account-text" id="sign-up-link">Sign up</a></p>
            </form>
            <form action="" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="名字">
                </div>
                <div class="input-field">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" placeholder="身分證">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="密碼">
                </div>
                <a href="#" class="forgot-password">忘記密碼🤬</a>
                <input type="submit" value="Sign up" class="btn">
                <p>已有帳號 <a href="#" class="account-text" id="sign-in-link">Sign in</a></p>
            </form>

        </div>
    </div>
    <script src='./assets/js/app.js'></script>
</body>

</html>