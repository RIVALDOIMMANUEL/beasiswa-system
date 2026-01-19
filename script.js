// Ambil elemen
const passwordInput = document.getElementById('password');
const toggleIcon = document.getElementById('toggleIcon');
const showPasswordCheckbox = document.getElementById('showPassword');

// Fungsi untuk mengubah tipe input password
function togglePassword(show) {
    if (show) {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-lock');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-lock');
    }
}

// Toggle password via icon
toggleIcon.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    togglePassword(isPassword);
    // Sinkronkan checkbox dengan icon
    showPasswordCheckbox.checked = isPassword;
});

// Toggle password via checkbox
showPasswordCheckbox.addEventListener('change', () => {
    togglePassword(showPasswordCheckbox.checked);
});
