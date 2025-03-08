<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background: #0056b3;
        }
        .social-login {
            margin-top: 15px;
        }
        .social-login a {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .google-login {
            background: #db4437;
        }
        .facebook-login {
            background: #3b5998;
        }
        .google-login:hover {
            background: #c1351d;
        }
        .facebook-login:hover {
            background: #2d4373;
        }
        #responseMessage {
            margin-top: 10px;
            font-weight: bold;
        }
        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }
        .register-link a {
            text-decoration: none;
            color: #007bff;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Login Form -->
<div class="container" id="loginContainer">
    <img src="logo.png" alt="Logo" class="logo"> <!-- Replace with your actual logo -->
    <h2>Login</h2>
    <form id="loginForm">
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p id="responseMessage"></p>

    <h3>Or login with:</h3>
    <div class="social-login">
        <a href="<?php echo e(url('/auth/google/redirect')); ?>" class="google-login">Login with Google</a>
        <a href="<?php echo e(url('/auth/facebook/redirect')); ?>" class="facebook-login">Login with Facebook</a>
    </div>

    <!-- Register Link -->
    <p class="register-link">Don't have an account? <a href="<?php echo e(route('register')); ?>">Register here</a></p>
</div>

<script>
    $(document).ready(function() {
        // AJAX Login Request
        $('#loginForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo e(route('ajax.login')); ?>",
                type: "POST",
                data: {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    $('#responseMessage').text(response.message).css('color', response.status === 'success' ? 'green' : 'red');
                    if (response.status === 'success') {
                        window.location.href = "/dashboard";
                    }
                },
                error: function() {
                    $('#responseMessage').text("Something went wrong!").css('color', 'red');
                }
            });
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\act6\act6\resources\views/login.blade.php ENDPATH**/ ?>