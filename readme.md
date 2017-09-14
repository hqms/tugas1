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
"; INSERT INTO user SET username="hacker", password="password rahasia";
```

pada halaman pencarian tidak akan merubah apa-apa, akan tetapi secara diam-diam Attacker sudah dapat login ke sistem dengan username dan password tersebut diatas.


## Attack 3
Serangan berikutnya adalah memanfaatkan database yang tidak terkelola penggunanya dengan baik. Dengan menggunakan satu user, maka semua orang bisa mengakses dan memodifikasi table dengan mudah. 

Pada kasus ini, Attacker masih menggunakan celah keamanan (search form ataupun query string) untuk memodifikasi data (pada Attack 1) ataupun menghapus table yang ada (pada Attack 3).

