document.addEventListener('DOMContentLoaded', function() {
    // Auth Form Switching
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const authTitle = document.getElementById('auth-title');
    const showRegister = document.getElementById('show-register');
    const showLogin = document.getElementById('show-login');

    /* 
        Event listeners for switching between login and registration forms.
    */
    if (showRegister && loginForm && registerForm) {
        showRegister.addEventListener('click', () => {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            authTitle.innerText = 'Create an account to access student information';
        });
    }

    /* 
        Event listener for switching back to the login form from the registration form.
    */
    if (showLogin && loginForm && registerForm) {
        showLogin.addEventListener('click', () => {
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
            authTitle.innerText = 'Welcome, please login to view student information';
        });
    }

    // Modal Logic
    const modal = document.getElementById('student-modal');
    const openBtn = document.getElementById('open-modal');
    const closeBtn = document.querySelector('.close-btn');

    // Event listeners for opening and closing the student information modal, as well as closing the modal when clicking outside of it.
    if (openBtn && modal) {
        openBtn.onclick = () => modal.classList.add('flex-modal');
    }

    if (closeBtn && modal) {
        closeBtn.onclick = () => modal.classList.remove('flex-modal');
    }

    // Event listener to close the modal when clicking outside of it
    window.onclick = (e) => {
        if (e.target == modal) modal.classList.remove('flex-modal');
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
