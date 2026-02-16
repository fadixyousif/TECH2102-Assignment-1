<?php
include "partials/header.php";
?>

<div class="auth-container">
    <div class="auth-box">
        <h2 id="auth-title">Welcome, please login to view student information</h2>
        
        <!-- Login Form -->
        <form id="login-form" action="index.php?action=login" method="POST">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>
            </div>
            <button type="submit" class="auth-btn">Login</button>
            <p class="switch-text">Don't have an account? <button type="button" id="show-register" class="link-btn">Register here</button></p>
        </form>

        <!-- Register Form (Hidden by default) -->
        <form id="register-form" action="index.php?action=register" method="POST" style="display: none;">
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
            <button type="submit" class="auth-btn">Register</button>
            <p class="switch-text">Already have an account? <button type="button" id="show-login" class="link-btn">Login here</button></p>
        </form>
    </div>
</div>

<script>
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authTitle = document.getElementById('auth-title');
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');

    showRegister.addEventListener('click', () => {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        authTitle.innerText = 'Create an account to access student information';
    });

    showLogin.addEventListener('click', () => {
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
        authTitle.innerText = 'Welcome, please login to view student information';
    });
</script>

<?php
include "partials/footer.php";
?>