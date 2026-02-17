<?php
include "partials/header.php";
?>

<div class="auth-container">
    <div class="auth-box">
        <h2 id="auth-title">Welcome, please login to view student information</h2>
        
        <?php include "partials/message.php"; ?>

        <!-- Login Form -->
        <form id="login-form" method="POST">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>
            </div>
            <button type="submit" class="auth-btn" name="auth-login">Login</button>
            <p class="switch-text">Don't have an account? <button type="button" id="show-register" class="link-btn">Register here</button></p>
        </form>

        <!-- Register Form (Hidden by default) -->
        <form id="register-form" method="POST" class="hidden">
            <div class="form-group">
                <label for="reg-username">Username</label>
                <input type="text" id="reg-username" name="username" required>
            </div>
            <div class="form-group">
                <label for="reg-email">Email</label>
                <input type="email" id="reg-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="reg-password">Password</label>
                <input type="password" id="reg-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="reg-confirm-password">Confirm Password</label>
                <input type="password" id="reg-confirm-password" name="confirm_password" required>
            </div>
            <button type="submit" class="auth-btn" name="auth-register">Register</button>
            <p class="switch-text">Already have an account? <button type="button" id="show-login" class="link-btn">Login here</button></p>
        </form>
    </div>
</div>

<?php
include "partials/footer.php";
?>