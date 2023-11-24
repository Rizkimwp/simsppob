// Fungsi Melihat Password
const passwordInput1 = document.getElementById('passwordInput1');
const togglePassword1 = document.getElementById('togglePassword1');
const passwordInput2 = document.getElementById('passwordInput2');
const togglePassword2 = document.getElementById('togglePassword2');

togglePassword1.addEventListener('click', function () {

    if (passwordInput1.type === 'password') {
        passwordInput1.type = 'text';
        togglePassword1.innerHTML = '<i class="fs-4 bi bi-eye-slash"></i>';
    } else {
        passwordInput1.type = 'password';
        togglePassword1.innerHTML = '<i class="fs-4 bi bi-eye"></i>';
    }
});


togglePassword2.addEventListener('click', function () {

    if (passwordInput2.type === 'password') {
        passwordInput2.type = 'text';
        togglePassword2.innerHTML = '<i class="fs-4 bi bi-eye-slash"></i>';
    } else {
        passwordInput2.type = 'password';
        togglePassword2.innerHTML = '<i class="fs-4 bi bi-eye"></i>';
    }
});