// Fungsi untuk logout otomatis setelah tidak ada aktivitas
let timeout;
const timeoutDuration = 100000; // 10 menit tanpa aktivitas

function resetTimeout() {
    clearTimeout(timeout); // Hapus timer yang lama
    timeout = setTimeout(() => {
        // Logout otomatis setelah waktu yang ditentukan
        window.location.href = 'logout.php'; // Arahkan ke logout
    }, timeoutDuration);
}

// Deteksi aktivitas mouse atau keyboard
document.onmousemove = resetTimeout;
document.onkeypress = resetTimeout;

// Reset timeout saat halaman dimuat
window.onload = resetTimeout;
