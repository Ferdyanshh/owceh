## Skenario Uji Dusk - EAD Library

Skenario pengujian end-to-end berbasis Laravel Dusk untuk aplikasi CRUD buku dengan autentikasi.

### Prasyarat

1. Database testing siap digunakan.
2. Browser driver untuk Dusk sudah dikonfigurasi.
3. Jalankan migration dan seed jika dibutuhkan.
4. Jalankan test dari root project.

### Daftar Skenario

| No | Skenario | Tujuan | Langkah | Ekspektasi |
| --- | --- | --- | --- | --- |
| 1 | Registrasi Berhasil | Memastikan user baru bisa register dan diarahkan ke dashboard buku. | 1. Buka halaman `/register`.<br>2. Isi nama, email unik, password, konfirmasi password.<br>3. Klik tombol `Register`. | 1. Berpindah ke path `/books`.<br>2. Muncul pesan `Registrasi berhasil.`.<br>3. Halaman menampilkan `Daftar Buku`. |
| 2 | Login Berhasil | Memastikan user terdaftar bisa login. | 1. Buka halaman `/login`.<br>2. Isi email dan password valid.<br>3. Klik tombol `Login`. | 1. Berpindah ke path `/books`.<br>2. Muncul pesan `Login berhasil.`.<br>3. Halaman menampilkan daftar buku. |
| 3 | Tambah Buku Berhasil | Memastikan alur create data buku berjalan. | 1. Siapkan user via `User::factory()` dan login dengan helper `loginAs($user)`.<br>2. Buka `/books` lalu klik menu `Tambah Buku` pada navbar.<br>3. Isi form buku lengkap.<br>4. Klik `Simpan Buku`. | 1. Data buku tersimpan.<br>2. Muncul pesan `Buku berhasil ditambahkan.`.<br>3. Judul buku terlihat pada halaman hasil. |
| 4 | Lihat Detail Buku | Memastikan halaman detail bisa diakses melalui navigasi UI. | 1. Siapkan user via `User::factory()` dan login dengan helper `loginAs($user)`.<br>2. Buka `/books`, klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Klik tombol `Kembali` ke daftar buku.<br>4. Klik link `Detail` pada baris buku yang dimaksud. | 1. Judul buku tampil pada halaman detail.<br>2. Penulis buku tampil pada halaman detail. |
| 5 | Update Buku - Penulis Mengandung Angka (Negatif) | Memvalidasi form update menolak nama penulis yang mengandung angka. | 1. Siapkan user via `User::factory()` dan login dengan helper `loginAs($user)`.<br>2. Buka `/books`, klik menu `Tambah Buku`, isi form (penulis tanpa angka) lalu klik `Simpan Buku`.<br>3. Pada halaman detail, klik tombol `Edit Buku`.<br>4. Ubah field `Penulis` menjadi nilai yang mengandung angka (misal `Penulis 123`).<br>5. Klik `Perbarui Buku`. | 1. Validasi gagal sehingga update tidak diproses.<br>2. Muncul pesan error `Penulis tidak boleh mengandung angka.`.<br>3. Data buku tidak berubah (penulis lama tetap muncul di daftar, penulis baru bernilai angka tidak muncul). |
| 6 | Hapus Buku Berhasil | Memastikan alur delete dengan konfirmasi berjalan. | 1. Siapkan user via `User::factory()` dan login dengan helper `loginAs($user)`.<br>2. Buka `/books`, klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Klik tombol `Kembali` ke halaman `/books`.<br>4. Klik tombol hapus (ikon trash) pada baris buku.<br>5. Konfirmasi dialog hapus. | 1. Muncul pesan `Buku berhasil dihapus.`.<br>2. Data buku tidak tampil lagi di tabel. |
| 7 | Logout Berhasil | Memastikan user bisa logout setelah login. | 1. Siapkan user via `User::factory()` dan login dengan helper `loginAs($user)`, lalu buka `/books`.<br>2. Buka menu user (ikon user) di navbar.<br>3. Klik tombol `Logout`. | 1. Redirect ke `/login`.<br>2. Muncul pesan `Logout berhasil.`. |

### Test Scenarios (English)

| No | Scenario | Objective | Steps | Expectations |
| --- | --- | --- | --- | --- |
| 1 | Successful Registration | Ensure a new user can register and is redirected to the books dashboard. | 1. Open the `/register` page.<br>2. Fill in name, unique email, password, and password confirmation.<br>3. Click the `Register` button. | 1. Redirected to the `/books` path.<br>2. Message `Registrasi berhasil.` appears.<br>3. The page displays `Daftar Buku`. |
| 2 | Successful Login | Ensure a registered user can log in. | 1. Open the `/login` page.<br>2. Fill in valid email and password.<br>3. Click the `Login` button. | 1. Redirected to the `/books` path.<br>2. Message `Login berhasil.` appears.<br>3. The page displays the book list. |
| 3 | Successful Add Book | Ensure the book creation flow works. | 1. Prepare a user via `User::factory()` and log in using the `loginAs($user)` helper.<br>2. Open `/books` and click the `Tambah Buku` menu in the navbar.<br>3. Fill in the complete book form.<br>4. Click `Simpan Buku`. | 1. Book data is saved.<br>2. Message `Buku berhasil ditambahkan.` appears.<br>3. The book title is visible on the result page. |
| 4 | View Book Detail | Ensure the detail page can be accessed through UI navigation. | 1. Prepare a user via `User::factory()` and log in using the `loginAs($user)` helper.<br>2. Open `/books`, click the `Tambah Buku` menu, fill the form, and click `Simpan Buku`.<br>3. Click the `Kembali` button to return to the book list.<br>4. Click the `Detail` link on the target book row. | 1. The book title appears on the detail page.<br>2. The book author appears on the detail page. |
| 5 | Update Book - Author Containing Digits (Negative) | Validate that the update form rejects author names containing digits. | 1. Prepare a user via `User::factory()` and log in using the `loginAs($user)` helper.<br>2. Open `/books`, click the `Tambah Buku` menu, fill the form (author without digits), and click `Simpan Buku`.<br>3. On the detail page, click the `Edit Buku` button.<br>4. Change the `Penulis` field to a value containing digits (e.g. `Penulis 123`).<br>5. Click `Perbarui Buku`. | 1. Validation fails so the update is not processed.<br>2. Error message `Penulis tidak boleh mengandung angka.` appears.<br>3. Book data is unchanged (the old author still appears in the list, the new author with digits does not appear). |
| 6 | Successful Delete Book | Ensure the delete flow with confirmation works. | 1. Prepare a user via `User::factory()` and log in using the `loginAs($user)` helper.<br>2. Open `/books`, click the `Tambah Buku` menu, fill the form, and click `Simpan Buku`.<br>3. Click the `Kembali` button to return to the `/books` page.<br>4. Click the delete button (trash icon) on the book row.<br>5. Confirm the delete dialog. | 1. Message `Buku berhasil dihapus.` appears.<br>2. The book data no longer appears in the table. |
| 7 | Successful Logout | Ensure a user can log out after logging in. | 1. Prepare a user via `User::factory()` and log in using the `loginAs($user)` helper, then open `/books`.<br>2. Open the user menu (user icon) in the navbar.<br>3. Click the `Logout` button. | 1. Redirected to `/login`.<br>2. Message `Logout berhasil.` appears. |

> Note: flash messages (`Registrasi berhasil.`, `Login berhasil.`, etc.) are kept in Indonesian because they are the literal strings shown in the UI and asserted by the test cases.

> Catatan: hanya skenario 1 (Registrasi) dan 2 (Login) yang melakukan login melalui form UI — keduanya memang menguji flow tersebut. Skenario 3–7 mempersiapkan user lewat `User::factory()` dan masuk dengan helper Dusk `loginAs($user)` agar fokus uji tetap pada fitur yang relevan.
>
> Note: only scenarios 1 (Registration) and 2 (Login) sign in through the UI form — those flows are exactly what the tests are verifying. Scenarios 3–7 prepare a user via `User::factory()` and authenticate with the Dusk `loginAs($user)` helper so each test stays focused on the feature under test.

### Perintah Eksekusi

Menjalankan satu skenario tertentu:

```bash
php artisan dusk --filter=Test
```

Menjalankan seluruh skenario Dusk:

```bash
php artisan dusk
```
