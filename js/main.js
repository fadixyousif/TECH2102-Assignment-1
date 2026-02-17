document.addEventListener('DOMContentLoaded', function() {
    // Auth Form Switching
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authTitle = document.getElementById('auth-title');
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');

    if (showRegister && loginForm && registerForm) {
        showRegister.addEventListener('click', () => {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            authTitle.innerText = 'Create an account to access student information';
        });
    }

    if (showLogin && loginForm && registerForm) {
        showLogin.addEventListener('click', () => {
            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
            authTitle.innerText = 'Welcome, please login to view student information';
        });
    }

    // Modal Logic
    const modal = document.getElementById('student-modal');
    const openBtn = document.getElementById('open-modal');
    const closeBtn = document.querySelector('.close-btn');

    if (openBtn && modal) {
        openBtn.onclick = () => modal.style.display = 'flex';
    }

    if (closeBtn && modal) {
        closeBtn.onclick = () => modal.style.display = 'none';
    }

    window.onclick = (e) => {
        if (e.target == modal) modal.style.display = 'none';
    }

    // Auto-hide Alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.6s ease';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 600);
        }, 3000);
    });
});
