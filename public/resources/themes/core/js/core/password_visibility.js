export function password_visibility() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        togglePassword.classList.toggle('fa-eye-slash');
    });
    const togglePassword2 = document.getElementById('togglePassword2');
    const password2 = document.querySelector('#password2');
    togglePassword2.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
        password2.setAttribute('type', type);
        // toggle the eye slash icon
        togglePassword2.classList.toggle('fa-eye-slash');
    });
    const togglePassword3 = document.getElementById('togglePassword3');
    const password3 = document.querySelector('#password3');
    togglePassword3.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
        password3.setAttribute('type', type);
        // toggle the eye slash icon
        togglePassword3.classList.toggle('fa-eye-slash');
    });
}
