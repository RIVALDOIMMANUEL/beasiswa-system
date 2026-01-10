CREATE DATABASE beasiswa;
USE beasiswa;

-- Tabel Admin
CREATE TABLE admin(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    password VARCHAR(100)
);

-- Menambahkan data admin
INSERT INTO admin(email, password) VALUES('admin@mail.com','1234');

-- Tabel Pendaftar dengan Jenjang
CREATE TABLE pendaftar(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    hp VARCHAR(20),
    semester INT,
    ipk DECIMAL(3,2),
    pilihan VARCHAR(50),
    berkas VARCHAR(200),
    jenjang VARCHAR(20),  -- Kolom Jenjang ditambahkan
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
