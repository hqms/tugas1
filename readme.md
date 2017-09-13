# SecureApp

SecureApp adalah aplikasi untuk menyajikan menu online :D. Aplikasi ini dibuat sebagai contoh aplikasi web yang akan digunakan untuk melakukan percobaan hacking dengan menggunakan metode Injection.

Aplikasi ini mempunyai beberapa module:
* Halaman Utama
* List Menu (untuk umum)
* Autentikasi
* Manajemen Menu (CRUD)
* Manajemen Pengguna (CRUD)
* Pencarian

Untuk menjalankan aplikasi ini dibutuhkan PHP dan MySQL server sebagai databasenya. Struktur tabel dan beberapa row contoh dapat dilihat pada file data.sql

## Attack 1
Pada serangan ini Attacker akan coba mengubah query yang dijalankan dengan memberikan parameter lebih pada input, baik itu POST (dari form) maupun GET (dari query string)

Dengan menggunakan form search Attacker akan mencoba mendaftarkan user baru dan digunakan untuk masuk ke sistem

Input yang akan dimasukkan dimasukkan pada form search adalah sebagai berikut

```
"; INSERT INTO user SET username="hacker", password="password rahasia"; --
```

pada halaman hasil pencarian tidak akan berubah apa-apa, akan tetapi secara diam-diam Attacker sudah dapat login ke sistem dengan username dan password tersebut diatas.

### Patch 1
Serangan pertama tadi dapat diatas dengan mengabaikan quotes atau kutip dimana serangan tersebut dimulai. 

Query yang dijalankan pada serangan diatas adalah sebagai berikut:

```
SELECT * FROM menus WHERE name LIKE "%"; INSERT INTO user SET username="hacker", password="password rahasia"; --%"
```

Pada patch ini query yang dijalankan harusnya adalah sebagai berikut:
```
SELECT * FROM menus WHERE name LIKE "%\"; INSERT INTO user SET username=\"hacker\", password=\"password rahasia\"; --%"
```
