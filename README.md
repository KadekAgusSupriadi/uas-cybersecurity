# UAS Cyber Security – Kerentanan Website PHP

## Nama Kelompok :
- Kadek Agus Supriadi (2201010332)
- Ni Nyoman Ayumi Widiyani (2301010084)
- Ida Ayu Putu Diah Wahyuni (2301010184)
- Saverius Gagut ( 2301010626)

Project ini dibuat untuk memenuhi tugas UAS Cyber Security berupa website PHP yang memiliki:
- SQL Injection (versi rentan)
- Upload file rentan
- Brute force attack
- Versi perbaikan (secure)

Aplikasi dijalankan secara **lokal** menggunakan **PHP Built-in Server**.

---

## 📁 Struktur Project
```
uascyber/
│── config.php
│── login.php
│── proses_login.php
│── dashboard.php
│── logout.php
│── database.sql
│── uploads/
│ └── .gitkeep
```
---

## ⚙️ Cara Menjalankan Aplikasi

### 1 Pastikan Software Terinstall
- PHP 7.4+  
- MySQL / phpMyAdmin  
- Git (opsional)

### 2 Import Database
jalankan baris kode pada file/import "database.sql" di MySQL/phpMyAdmin

### 3 Jalankan Aplikasi
```
cd C:\Users\kadek\Documents\uascyber

php -S localhost:8000
```

Akses di browser:

```
http://localhost:8000/login.php
```

---

### 4 Akun Login
Bisa Gunakan yang mana saja untuk uji coba

| Username | Password |
| -------- | -------- |
| admin    | admin |
| secureadmin | admin123  |

---

## Mode Rentan

- **SQLi :** login dengan  admin' OR '1'='1`
- **Bruteforce :** login berkali kali dengan password salah
- **Upload :** Upload file selain jpg, jpeg, png

## Akses Mode Rentan/Secure

pada config.php ganti kode :

define("SECURE_MODE", true);

- true = mode secure
- false = mode rentan
