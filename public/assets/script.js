// Fungsi Melihat Password
const passwordInput1 = document.getElementById('passwordInput1');
const togglePassword1 = document.getElementById('togglePassword1');
const passwordInput2 = document.getElementById('passwordInput2');
const togglePassword2 = document.getElementById('togglePassword2');

togglePassword1.addEventListener('click', function () {

    if (passwordInput1.type === 'password') {
        passwordInput1.type = 'text';
        togglePassword1.innerHTML = '<i class="fs-5 bi bi-eye-slash"></i>';
    } else {
        passwordInput1.type = 'password';
        togglePassword1.innerHTML = '<i class="fs-5 bi bi-eye"></i>';
    }
});

// Password Sembunyi dan Munculkan
togglePassword2.addEventListener('click', function () {

    if (passwordInput2.type === 'password') {
        passwordInput2.type = 'text';
        togglePassword2.innerHTML = '<i class="fs-5 bi bi-eye-slash"></i>';
    } else {
        passwordInput2.type = 'password';
        togglePassword2.innerHTML = '<i class="fs-5 bi bi-eye"></i>';
    }
});

// Close Alert
function closeAlert() {
    // Mengambil elemen alert
    const alert = document.querySelector('.alert');

    // Menyembunyikan atau menghapus alert saat tombol Close ditekan
    alert.style.display = 'none'; // Menggunakan 'display: none;' untuk menyembunyikan alert
    // Jika ingin menghapus sepenuhnya dari DOM, Anda dapat menggunakan alert.remove()
}

function editProfile() {
    // Mengaktifkan input dan tombol Simpan
    document.getElementById('email').removeAttribute('disabled');
    document.getElementById('first_name').removeAttribute('disabled');
    document.getElementById('last_name').removeAttribute('disabled');
    document.querySelector('button[type="submit"]').removeAttribute('hidden');

    // Menghilangkan tombol "Edit Profile"
    document.querySelector('.edit-profile-btn').style.display = 'none';

    // Menghilangkan tombol "Logout"
    document.querySelector('.logout-btn').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const editIcon = document.querySelector('.edit-icon');
    const profileImageInput = document.getElementById('profileImageInput');
    const imageUploadForm = document.getElementById('imageUploadForm');

    // Ketika ikon edit diklik
    editIcon.addEventListener('click', function() {
        // Munculkan jendela untuk memilih gambar saat ikon edit diklik
        profileImageInput.click();
    });

    // Ketika gambar dipilih
    profileImageInput.addEventListener('change', function() {
        // Simpan gambar yang dipilih dengan melakukan submit pada form
        imageUploadForm.submit();
    });
});
