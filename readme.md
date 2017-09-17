# SecureApp

SecureApp adalah aplikasi untuk menyajikan menu online :sunglasses:. Aplikasi ini dibuat sebagai contoh aplikasi web yang akan digunakan untuk melakukan percobaan hacking dengan menggunakan metode Injection.

Aplikasi ini mempunyai beberapa module:
* Halaman Utama
* List Menu (untuk umum)
* Autentikasi
* Manajemen Menu (CRUD)
* Manajemen Pengguna (CRUD)
* Pencarian

Untuk menjalankan aplikasi ini dibutuhkan PHP dan MySQL server sebagai databasenya. Struktur tabel dan beberapa row contoh dapat dilihat pada file data.sql

## Attack 1
Pada serangan ini Attacker akan coba mengubah SQL Statement yang dijalankan dengan memberikan parameter lebih pada input, baik itu POST (dari form) maupun GET (dari query string)

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

Di tahap ini refactoring dilakukan pada fungsi query, dari yang semula hanya bertugas menjalankan query menjadi fungsi yang harus menyiapkan statement sampai dengan mengeksekusinya


## Attack 2
Serangan berikutnya adalah dengan memanfaatkan input yang tidak ditentukan tipe datanya. 

Attacker akan menggunakan query string pada pilihan category menu sebagai berikut:

```
http://localhost:8000/index.php?m=menu&a=cat_id&id=1
```

bila link tersebut diubah secara manual pada query stringnya, maka akan mempengaruhi SQL statement yang akan dijalankan. Contoh query string yang diganti menjadi:

```
http://localhost:8000/index.php?m=menu&a=cat_id&id=1;DROP TABLE user;
```

serangan ini dimaksudkan untuk mengganti nilai yang ada pada input dengan SQL Statement lain

## Patch 2
Setiap input yang diterima oleh aplikasi (pada aplikasi ini didapat dari variable `$_REQUEST`) harus divalidasi. Pada PHP dapat menggunakan fungsi-fungsi typecasting sehingga hasilnya sudah sesuai dengan yang diinginkan. 

Sebagai contoh, field `ID` di setiap table menggunakan tipe data integer, dengan meng-casting nilai dari `$_REQUEST['id']` maka akan didapatkan tipe data integer dari variable tersebut

```php
(int)$_REQUEST['id'];  // hasilnya akan diubah menjadi integer
```


## Attack 3
Serangan berikutnya adalah memanfaatkan database yang tidak terkelola penggunanya dengan baik. Dengan menggunakan satu user, maka semua orang bisa mengakses dan memodifikasi table dengan mudah. 

Pada kasus ini, Attacker masih menggunakan celah keamanan (search form ataupun query string) untuk memodifikasi data (pada Attack 1) ataupun menghapus table yang ada (pada Attack 3).

Dengan memetakan table-table yang tersedia, maka dapat ditentukan hak akses untuk setiap module, atau biasa disebut dengan ACL (Access Control List)

Module name | Admin | User
------------|-------|-------
user | CRUD   | R
categories | CRUD | CRU
menus | CRUD | CRU


C: Create
R: Read
U: Update
D: Delete

## Patch 3
Untuk mengatasi serangan ini user yang digunakan untuk mengakses database disesuaikan dengan group dari user yang login ke database. Sehingga setiap user yang login hanya akan mendapatkan hak sesuai dengan ACL di atas.


## Server Side Injection Attack 
Attack ini memanfaatkan form yang mempunyai input file, pada aplikasi ini file upload digunakan untuk memberikan image pada menu, sehingga file yang diupload bukan dari url lagi.

Attacker akan coba mengupload file yang dapat dijalankan pada server (pada kasus ini file berekstensi php), isi file tersebut adalah sebagai berikut:

```php
<?php

include_once "../index.php";

$vars = get_defined_vars();
foreach($vars as $k=>$v){
	echo $k;
	var_dump($v);
}

```

bila setiap file yang diupload akan diletakkan di folder `/images/` maka script tersebut akan dapat diakses di `http://localhost:8000/images/attack.php`


## Patch SSI
Untuk memperbaiki celah keamanan ini maka diperlukan validasi terhadap file yang diupload.
