# Dokumentasi Teknis dan Fungsional Viviashop

## 1. Ringkasan Eksekutif

Viviashop adalah aplikasi monolitik Laravel yang telah berkembang dari toko online standar menjadi sistem operasional retail yang mencakup:

- katalog dan penjualan online,
- order admin/offline store,
- manajemen produk varian,
- pembelian dari supplier,
- audit dan mutasi stok,
- layanan print service berbasis sesi dan upload file,
- tracking performa karyawan,
- integrasi Midtrans, RajaOngkir/Binderbyte, Cloudinary, dan Instagram,
- reporting bisnis serta export PDF/Excel.

Secara bisnis, aplikasi ini bukan hanya storefront. Ia sudah berfungsi sebagai kombinasi antara:

- ecommerce frontend,
- backoffice admin,
- sistem inventori,
- procurement/pembelian,
- modul print production workflow,
- dan kanal promosi sosial.

Hasil inspeksi source code pada repository ini menunjukkan permukaan aplikasi yang cukup besar:

- 46 controller yang terdeteksi,
- 22 controller admin,
- 7 controller frontend,
- 34 model Eloquent,
- 5 service class utama,
- 73 migration,
- 183 view PHP/Blade,
- 228 pemanggilan route di `routes/web.php`,
- 11 pemanggilan route di `routes/api.php`.

Kesimpulan utama: Viviashop adalah aplikasi yang kaya fitur dan sangat operasional, tetapi juga membawa jejak evolusi yang panjang. Kekuatan utamanya ada pada keluasan modul bisnis dan fleksibilitas. Risiko utamanya ada pada kompleksitas controller/route, coexistence beberapa pola lama dan baru, serta coverage test otomatis yang sangat minim.

---

## 2. Basis Analisis

Dokumen ini disusun dari inspeksi langsung terhadap kode sumber, terutama area berikut:

- manifest dependency: `composer.json`, `package.json`,
- permukaan route: `routes/web.php`, `routes/api.php`,
- controller inti frontend, admin, procurement, dan print service,
- model domain utama,
- service layer stok, varian, dan print,
- migration historis,
- file konfigurasi integrasi eksternal,
- inventaris command dan testing surface.

Dokumen ini bertujuan memberi gambaran teknis dan fungsional yang akurat berdasarkan implementasi yang ada saat ini, bukan berdasarkan README lama atau asumsi desain awal proyek.

---

## 3. Teknologi, Framework, dan Dependensi

### 3.1 Backend Utama

| Komponen | Versi/Library | Peran |
| --- | --- | --- |
| PHP | `^8.1` | Runtime utama aplikasi |
| Laravel | `^10.0` | Framework backend utama |
| Eloquent ORM | Built-in Laravel | Model, relasi, query builder |
| Laravel UI | `^4.0` | Auth scaffolding klasik |
| Laravel Sanctum | `^3.2` | Proteksi endpoint API tertentu |
| Laravel Tinker | `^2.8` | Tooling interaktif developer |

### 3.2 Frontend dan Asset Pipeline

| Komponen | Versi/Library | Peran |
| --- | --- | --- |
| Vite | `^4.0.0` | Build tool frontend |
| Sass | `^1.56.1` | Styling preprocessor |
| Bootstrap | `~4.6.1` | UI framework klasik |
| jQuery | `^3.3.1` | DOM scripting legacy/classic |
| Axios | `^1.1.2` | HTTP request dari frontend |
| Lodash | `^4.17.21` | Utility frontend |

### 3.3 Integrasi Bisnis dan Eksternal

| Komponen | Versi/Library | Peran |
| --- | --- | --- |
| Midtrans PHP | `^2.6` | Payment gateway otomatis |
| Guzzle | `^7.9` | HTTP client untuk integrasi |
| Laravel Socialite | `^5.19` | OAuth login/connection Instagram |
| Socialite Instagram Providers | `^5.1` / `^4.2` | Provider Instagram |
| Cloudinary Laravel | `^2.3` | Upload media ke Cloudinary |
| RajaOngkir/Binderbyte | wrapper custom via `rajaongkir_komerce.php` | Provinsi, kota, kecamatan, ongkir |
| Shoppingcart | `hardevine/shoppingcart` | Keranjang belanja |
| DOMPDF | `barryvdh/laravel-dompdf` | PDF invoice/laporan/barcode |
| Laravel Excel | `maatwebsite/excel` | Import/export Excel |
| Milon Barcode | `^12.0` | Barcode produk |
| Simple QR Code | `^4.2` | QR code untuk sesi print service |
| Yajra Datatables | `^10.3.1` | Data table server-side |
| SweetAlert | `^7.2` | Alert UI admin |
| Eloquent Sluggable | `^10.0` | Slug produk/kategori |

### 3.4 Dependensi Developer dan Kualitas Kode

| Komponen | Peran |
| --- | --- |
| Laravel Pint | formatter/code style |
| PHPUnit 10 | unit/feature test framework |
| Laravel Debugbar | debugging lokal |
| Collision | output error CLI |
| Laravel Sail | opsi container/dev environment |
| Larastarters | starter/dev tooling |

### 3.5 Konfigurasi Penting

File konfigurasi yang berperan langsung terhadap runtime aplikasi:

- `config/midtrans.php`: server key, client key, mode production, sanitization, 3DS.
- `config/ongkir.php`: Binderbyte + RajaOngkir Komerce endpoint dan API key.
- `config/services.php`: Socialite/Instagram dan service credentials umum.
- `config/instagram.php`: access token, verify token, redirect URI, API URL.
- `config/cloudinary.php`: Cloudinary cloud URL dan upload preset.

---

## 4. Gambaran Arsitektur Aplikasi

### 4.1 Tipe Arsitektur

Arsitektur aplikasi adalah monolith Laravel berbasis MVC, dengan service layer yang dipakai terutama untuk domain yang lebih kompleks:

- `ProductVariantService` untuk manajemen produk configurable dan variant logic,
- `StockManagementService` untuk stok print service,
- `StockService` untuk pencatatan mutasi stok lintas domain,
- `PrintService` untuk lifecycle print order dan file,
- `SmartPrintVariantService` untuk auto-fix dan auto-creation varian print.

Secara struktural, arsitektur aplikasi dapat dibaca sebagai berikut:

```text
Browser / Admin UI / Print UI
        |
        v
routes/web.php dan routes/api.php
        |
        v
Controller
        |
        +--> Eloquent Model
        |
        +--> Service Layer (varian, stok, print)
        |
        +--> Integrasi eksternal (Midtrans, RajaOngkir, Cloudinary, Instagram)
        |
        v
Database + Storage + Third Party APIs
```

### 4.2 Pembagian Area Aplikasi

#### Area publik / customer

- homepage,
- katalog produk,
- detail produk,
- cart,
- wishlist,
- checkout,
- order history,
- invoice,
- payment redirect/result,
- print service customer session.

#### Area admin

Semua route admin dibungkus oleh group berikut:

- middleware: `auth`, `is_admin`
- prefix: `admin`
- route name prefix: `admin.`

Area ini mencakup:

- dashboard,
- user/profile/settings,
- category/attribute/option management,
- product CRUD + import + barcode,
- order administration,
- shipment,
- reporting,
- supplier/pembelian,
- stock card,
- print service backoffice,
- smart print tools,
- employee performance dan bonus,
- slideshow/testimonial management.

#### Area API

`routes/api.php` relatif sempit dan fokus pada domain varian produk:

- ambil varian per produk,
- ambil opsi atribut,
- cari varian berdasarkan kombinasi atribut,
- cek stok varian,
- update stok varian,
- bulk update stok,
- low stock variants.

Endpoint mutasi stok dilindungi `auth:sanctum`.

### 4.3 Pola Layering yang Dipakai

#### Pola yang baik dan modern

- Service layer dipakai pada beberapa domain kompleks.
- Transaksi database (`DB::transaction`) dipakai di area penting seperti variant creation, print checkout, purchase finalization, dan beberapa flow admin order.
- Relasi Eloquent cukup kaya dan merepresentasikan domain dengan baik.

#### Pola yang masih campuran/legacy

- Banyak controller masih sangat gemuk dan menampung business logic langsung.
- `routes/web.php` sangat besar dan memuat route publik, admin, callback, test, dan debug dalam satu file.
- Ada coexistence pola lama dan baru untuk varian serta stok.

---

## 5. Struktur Modul dan Domain Utama

### 5.1 Domain Katalog Produk

Entity utama:

- `Product`
- `Category`
- `Brand`
- `ProductImage`
- `ProductCategory`
- `Attribute`
- `AttributeVariant`
- `AttributeOption`
- `ProductAttributeValue`
- `ProductVariant`
- `VariantAttribute`
- `ProductInventory`

Hal penting pada domain ini:

1. Produk mendukung dua tipe utama:
   - `simple`
   - `configurable`

2. Ada dua pendekatan varian yang hidup bersamaan:
   - pola lama berbasis `products.parent_id` via relasi `variants()` pada model `Product`,
   - pola baru berbasis tabel `product_variants` via relasi `productVariants()`.

3. Model `Product` memiliki helper untuk:
   - status,
   - tipe,
   - price label/range,
   - total stock,
   - opsi varian,
   - update base price.

4. `ProductVariantService` menangani:
   - create configurable product,
   - generate SKU varian,
   - generate barcode varian,
   - normalize print attributes,
   - base price aggregation,
   - inventory report per produk configurable.

5. Produk print service memiliki perlakuan khusus untuk atribut seperti:
   - `paper_size`
   - `print_type`

### 5.2 Domain Order dan Pembayaran

Entity utama:

- `Order`
- `OrderItem`
- `Payment`
- `Shipment`
- `WishList`

Karakteristik order system:

- support user order online,
- support order admin/offline store,
- support self pickup dan courier,
- support pembayaran manual, otomatis Midtrans, COD, dan pembayaran toko,
- support soft delete order,
- support invoice PDF,
- support attachment dan payment slip,
- support shipping cost adjustment,
- support order completion dari user maupun admin,
- support payment reconciliation via callback dan status polling.

Model `Order` juga sudah memiliki helper bisnis penting seperti:

- `isPaid()`, `isCompleted()`, `isCancelled()`, `isDelivered()`,
- `isOfflineStoreOrder()`,
- `needsShipment()`,
- `adjustShippingCost()`,
- `getShippingCostDifference()`.

### 5.3 Domain Supplier dan Pembelian

Entity utama:

- `Supplier`
- `Pembelian`
- `PembelianDetail`

Domain ini menangani:

- master supplier,
- draft pembelian,
- detail item pembelian,
- dukungan produk simple maupun variant,
- update harga beli/harga jual dari konteks pembelian,
- realtime projected stock saat purchase sedang disusun,
- finalisasi pembelian yang memicu update stok melalui `StockService`.

### 5.4 Domain Inventori dan Audit Stok

Entity utama:

- `ProductInventory`
- `StockMovement`
- `RekamanStok`

Ada dua lapisan stok yang hidup berdampingan:

- stok produk sederhana pada `product_inventories.qty`,
- stok varian pada `product_variants.stock`.

`StockMovement` berfungsi sebagai audit trail dengan reason seperti:

- order confirmed,
- order cancelled,
- purchase confirmed,
- purchase cancelled,
- print order,
- manual adjustment,
- inventory correction,
- synchronization,
- damage,
- return.

`StockService` menyediakan fungsi penting:

- `recordMovement()`
- `recordSimpleProductMovement()`
- `processPurchaseStockUpdate()`
- `reversePurchaseStockUpdate()`
- `synchronizeStockTables()`
- `validateStockConsistency()`

Ini menunjukkan bahwa aplikasi sadar ada risiko inkonsistensi stok antar tabel dan sudah menyediakan mekanisme sinkronisasi.

### 5.5 Domain Print Service / Smart Print

Entity utama:

- `PrintSession`
- `PrintOrder`
- `PrintFile`
- `PaperType`
- `PrintType`

Komponen ini adalah salah satu domain paling khas dalam aplikasi.

Fitur utamanya:

- generate sesi print dengan token acak,
- QR code menuju halaman customer print service,
- upload multi-file,
- hitung halaman berdasarkan tipe file,
- kalkulasi harga print berdasarkan varian kertas,
- checkout order print,
- metode pembayaran toko/manual/automatic,
- queue printing,
- status workflow printing,
- cleanup file setelah order selesai,
- stock check dan stock reduction/restoration untuk media cetak.

`PrintSession` mempunyai lifecycle step:

- `upload`
- `select`
- `payment`
- `print`
- `complete`

Dan sesi aktif memiliki expiry 24 jam.

### 5.6 Domain Employee Performance

Entity utama:

- `EmployeePerformance`
- `EmployeeBonus`

Kapabilitas:

- mencatat siapa karyawan yang menangani order,
- mencatat nilai transaksi per order,
- menampilkan ranking dan histori performa,
- mengelola bonus,
- menampilkan bonus history dan detail per karyawan.

Ini menunjukkan aplikasi bukan hanya sistem penjualan, tetapi sudah mendukung pelacakan operasional SDM.

### 5.7 Domain Marketing dan Konten

Entity utama:

- `Slide`
- `Testimonial`
- integrasi `Instagram`

Kegunaan:

- hero/banner homepage,
- testimoni pelanggan,
- posting produk ke Instagram,
- membaca feed Instagram,
- OAuth Instagram callback dan webhook verification.

### 5.8 Domain Pengaturan dan Konfigurasi

Entity utama:

- `Setting`
- `User`

Kegunaan:

- pengaturan global tampilan/bisnis,
- pengelolaan user admin,
- profil admin/user,
- beberapa view frontend berbagi `Setting` dan count cart secara manual dari controller.

### 5.9 Domain Pengeluaran

Terdapat `PengeluaranController` dan model `Pengeluaran`, dan data pengeluaran dipakai di logika laporan revenue pada frontend/reporting. Namun dari permukaan route web yang diinspeksi, modul ini belum terlihat diroute ke `routes/web.php`.

Artinya, saat ini domain pengeluaran kemungkinan berada pada salah satu kondisi berikut:

- modul internal yang belum diekspos,
- fitur yang pernah dipakai lalu terlepas dari route,
- atau fitur yang sedang/akan dihidupkan kembali.

Ini penting karena secara kode domainnya ada, tetapi secara permukaan aplikasi publik/admin yang aktif belum terlihat lengkap.

---

## 6. Fitur Aplikasi Secara Detail

## 6.1 Fitur Frontend Customer

### Homepage

Homepage memuat:

- produk aktif,
- kategori,
- jumlah total produk,
- jumlah total order paid,
- slide aktif,
- popular product section,
- shared setting dan jumlah cart.

### Shop / Katalog

Fitur katalog meliputi:

- listing produk,
- filter kategori,
- kategori khusus cetak (`shopCetak`),
- sorting nama/harga/terbaru,
- pencarian exact word,
- fallback substring search,
- fallback fuzzy search berbasis:
  - Levenshtein,
  - Jaro-Winkler,
  - substring similarity.

Ini adalah fitur yang cukup maju untuk storefront skala UMKM/operasional, karena pencarian tidak hanya exact match.

### Detail Produk

Detail produk mendukung:

- produk simple,
- produk configurable,
- redirect dari child product lama ke parent product,
- load variant attributes,
- opsi varian,
- price range minimum-maksimum,
- pengamanan fallback saat data varian inkonsisten.

Catatan penting: controller frontend secara eksplisit mengakui adanya kemungkinan "simple products with variants" sebagai inkonsistensi data legacy, dan memilih mengabaikan varian untuk simple product demi stabilitas tampilan.

### Cart

Fitur cart mendukung:

- wajib login untuk add to cart,
- penanganan item simple dan configurable secara berbeda,
- validasi stok sebelum insert ke cart,
- penyimpanan atribut varian ke options cart,
- update quantity,
- remove item.

### Wishlist

Fitur wishlist mendukung:

- list wishlist user,
- add by product slug,
- pencegahan duplikasi favorite,
- delete wishlist.

### Checkout Online

Checkout customer adalah salah satu modul paling besar dan kaya fitur. Kapabilitasnya meliputi:

- validasi profil pembeli,
- metode pengiriman:
  - self pickup,
  - courier,
- metode pembayaran:
  - manual,
  - automatic,
  - COD,
  - toko,
- upload attachment,
- upload payment slip,
- kalkulasi total berat,
- ongkir berdasarkan kecamatan,
- penyimpanan shipment,
- resume unpaid order,
- return JSON untuk AJAX checkout,
- redirect ke halaman received order.

### Shipping / Ongkir

Shipping memakai kombinasi:

- wrapper `RajaOngkirKomerce` custom,
- Binderbyte untuk wilayah,
- RajaOngkir Komerce untuk kalkulasi ongkir.

Endpoint yang tersedia:

- provinces,
- cities,
- districts,
- shipping cost,
- set shipping.

### Riwayat Order dan Status

Customer dapat:

- melihat daftar order,
- search dan sort order,
- melihat detail order,
- melihat invoice PDF,
- melihat status pembayaran dan status order,
- melakukan complete order ketika sudah delivered,
- upload bukti pembayaran manual,
- melihat halaman received order yang menyertakan data Midtrans Snap bila perlu.

### Midtrans Customer Flow

Flow payment otomatis customer mencakup:

- generate Snap token,
- notification handler,
- finish redirect,
- unfinish redirect,
- error redirect,
- status reconciliation via polling `Midtrans\Transaction::status()`.

---

## 6.2 Fitur Admin / Backoffice

### Dashboard

Dashboard admin memuat metrik yang cukup lengkap:

- revenue hari ini, minggu ini, bulan ini, tahun ini,
- pending payments,
- net profit bulanan,
- revenue growth,
- order metrics,
- conversion rate,
- average order value,
- inventory metrics,
- top selling product,
- employee metrics,
- chart data,
- recent activities,
- low stock products,
- dead stock products,
- supplier performance,
- category performance,
- shipping method statistics.

Secara bisnis, ini sudah lebih dari sekadar dashboard CRUD. Ia sudah berfungsi sebagai operations cockpit.

### Master Data Admin

Admin memiliki CRUD untuk:

- users,
- profile,
- setting,
- categories,
- attributes,
- attribute variants,
- attribute options,
- slides,
- testimonials,
- paper types,
- print types,
- shipments.

### Product Management

Modul produk mendukung:

- list produk dengan relasi brand, inventory, variant,
- create/edit product,
- configurable attributes,
- import produk via Excel,
- export template produk,
- lookup barcode,
- barcode generation massal dan satuan,
- barcode preview landscape/portrait,
- barcode print,
- variant option lookup,
- delete variants,
- nested product images resource,
- datatable endpoint.

### Brand dan Slug

Meskipun controller brand tidak terlihat pada permukaan route yang terbaca di sini, model `Brand` dan relasi pada `Product` sudah ada. Produk juga memakai slug otomatis lewat `cviebrock/eloquent-sluggable`.

### Order Management Admin

Fitur admin order sangat luas:

- list order,
- detail order,
- invoice,
- create order admin/offline,
- generate payment token,
- terima payment notification,
- callback finish/unfinish/error,
- cancel order,
- restore soft-deleted order,
- complete order,
- self pickup confirmation,
- employee tracking,
- toggle tracking,
- adjust shipping.

Order admin mendukung payment method:

- qris,
- midtrans,
- toko,
- transfer.

### Offline Store / Admin Order

Ini adalah capability penting yang menandakan Viviashop mendukung channel penjualan offline.

Admin dapat:

- membuat order manual dari panel admin,
- memilih simple/configurable product,
- memilih variant bila diperlukan,
- memvalidasi stok saat membuat order,
- menunda pengurangan stok sampai order completion,
- menghasilkan payment token bila payment method digital dipilih.

### Shipment Management

Admin dapat mengelola shipment sebagai entitas tersendiri, dan model `Shipment` terhubung ke `Order`.

### Reporting

Modul report mencakup empat domain utama:

- revenue,
- product,
- inventory,
- payment.

Fitur report:

- date range,
- validasi range maksimal 31 hari pada beberapa report,
- export Excel,
- export PDF,
- query raw SQL untuk agregasi laporan.

### Employee Performance dan Bonus

Admin dapat:

- melihat leaderboard performa karyawan,
- melihat data detail per karyawan,
- membuka form bonus,
- membuat bonus,
- melihat daftar bonus,
- melihat detail bonus,
- edit bonus,
- hapus bonus,
- melihat histori bonus.

---

## 6.3 Fitur Procurement dan Supplier

### Supplier

Fitur:

- CRUD supplier,
- endpoint datatable supplier.

### Pembelian

Fitur:

- membuat draft pembelian dari supplier,
- detail item pembelian,
- invoice PDF pembelian,
- edit pembayaran pembelian,
- finalisasi pembelian,
- catat total item/total harga/diskon/bayar,
- set payment method pembelian,
- simpan note pembelian,
- memicu stock update setelah pembelian selesai.

### Pembelian Detail

Fitur:

- add item ke pembelian,
- dukungan variant pada item pembelian,
- realtime projected stock,
- load form total/diskon/bayar,
- edit kuantitas,
- hapus item,
- ambil daftar variant per produk.

Catatan penting sesuai implementasi:

- `harga_beli` pada detail pembelian diperlakukan sebagai unit price,
- `subtotal` dihitung sebagai `harga_beli * jumlah`,
- update stok tidak dilakukan per perubahan draft item, melainkan saat pembelian dikonfirmasi/final.

Ini merupakan desain yang lebih aman dibanding mengubah stok setiap draft berubah.

---

## 6.4 Fitur Stok dan Audit Inventori

### Stock Card dan Movement Report

Admin memiliki area `stock` yang mendukung:

- index stok,
- daftar movement,
- data movement untuk datatable,
- stock card per variant,
- stock card per product,
- stock report.

### Low Stock dan Duplicate Variant Detection

`StockManagementService` menyediakan:

- low stock variants,
- sort by stock,
- duplicate print variant detection,
- pencegahan duplicate print variants.

### Synchronization Tooling

`StockService::synchronizeStockTables()` menunjukkan bahwa sistem memiliki mekanisme rekonsiliasi antara:

- `product_inventories.qty`, dan
- `product_variants.stock`.

Ini penting karena artinya stok tidak dijaga hanya pada satu tabel saja.

---

## 6.5 Fitur Print Service / Smart Print

### Customer Print Service

Permukaan customer print service mendukung:

- generate session,
- QR code session,
- upload file,
- delete file,
- preview/download file,
- load print products,
- kalkulasi harga,
- checkout,
- cek status,
- trigger print,
- mark complete,
- Midtrans callback,
- payment finish/unfinish/error.

### File Type Support

Print service menerima beragam tipe file:

- `pdf`
- `doc`, `docx`
- `xls`, `xlsx`, `ods`
- `ppt`, `pptx`
- `jpg`, `jpeg`, `png`
- `txt`, `csv`, `log`
- `rtf`, `odt`

### Page Counting Strategy

Penentuan jumlah halaman tidak seragam, tetapi heuristik berdasarkan tipe file:

- PDF dihitung dari pattern `/Page`,
- dokumen office diestimasi dari size,
- text/csv/log diestimasi dari jumlah baris,
- image diasumsikan 1 halaman.

Ini praktis, tetapi juga berarti akurasi page count bergantung tipe file.

### Print Payment Modes

Metode pembayaran print service:

- `toko`: menunggu konfirmasi di toko,
- `manual`: upload bukti pembayaran,
- `automatic`: Midtrans Snap.

### Print Backoffice

Admin print service mendukung:

- queue,
- sessions,
- orders,
- reports,
- stock management,
- stock report,
- confirm payment,
- print order,
- print files,
- complete order,
- cancel order,
- download payment proof,
- view uploaded file.

### Smart Print Tools

Ada dua tool khusus yang cukup menonjol:

#### Smart Print Converter

Dipakai untuk mengubah produk regular menjadi produk smart print dengan:

- set `is_print_service = true`,
- set `is_smart_print_enabled = true`,
- auto-create variant `BW` dan `Color` bila belum ada,
- bulk convert banyak produk sekaligus.

#### Smart Print Variant Manager

Dipakai untuk:

- mendeteksi varian print yang belum punya `paper_size` atau `print_type`,
- auto-fix field print berdasarkan nama varian,
- membuat varian smart print default untuk produk yang belum punya varian.

---

## 6.6 Fitur Instagram dan Media

### Instagram OAuth dan Feed

Fitur yang tersedia:

- redirect ke OAuth Instagram,
- callback dan token exchange ke long-lived token,
- simpan token ke user,
- get Instagram feed,
- webhook verification,
- webhook receive stub.

### Posting Manual dan Post dari Produk

Admin dapat:

- upload gambar + caption lalu publish ke Instagram,
- publish post langsung dari product images,
- membuat single image post atau carousel tergantung jumlah gambar produk.

### Cloudinary sebagai Media Bridge

Sebelum post ke Instagram, gambar diupload ke Cloudinary untuk memperoleh URL publik yang bisa dikonsumsi Graph API Instagram.

---

## 6.7 Fitur API

API saat ini fokus pada varian produk, bukan keseluruhan domain ecommerce.

Endpoint utama:

- get variants by product,
- get variant options,
- get attribute options,
- get variant by selected attributes,
- create variant,
- check stock,
- get low stock variants,
- update stock,
- bulk update stock.

Ini berarti API app saat ini lebih bersifat internal/supporting API dibanding public headless ecommerce API.

---

## 7. Workflow Bisnis Kunci

## 7.1 Workflow Belanja Online Reguler

1. User login.
2. User browse katalog, cari produk, pilih detail.
3. Jika configurable, user pilih variant.
4. Item masuk ke cart setelah stok tervalidasi.
5. User checkout dengan self pickup atau courier.
6. Ongkir dihitung bila courier.
7. Order dan order item disimpan.
8. Pada flow frontend, stok sudah direkam/dikurangi saat `_saveOrderItems()` dijalankan.
9. Jika automatic payment, token Midtrans dibuat.
10. Midtrans callback / redirect / polling mengubah status payment/order.
11. User melihat halaman received order dan order history.

Catatan penting: frontend dan admin tidak memakai momen pengurangan stok yang sama. Ini dibahas lagi pada bagian kelemahan/risiko.

## 7.2 Workflow Order Admin / Offline Store

1. Admin membuat order dari panel admin.
2. Admin memilih produk dan quantity.
3. Sistem hanya memvalidasi stok saat creation.
4. Stok belum dikurangi saat order dibuat.
5. Jika payment digital dipilih, token dapat dibuat.
6. Saat order dianggap selesai/paid/completed atau pickup dikonfirmasi, `recordOrderStockMovements()` baru dijalankan.
7. Employee performance dapat dicatat bila tracking diaktifkan.

Ini membuat order admin lebih cocok untuk penjualan toko fisik yang perlu kontrol manual lebih besar.

## 7.3 Workflow Pembelian Supplier

1. Admin pilih supplier.
2. Sistem membuat draft pembelian.
3. Admin menambahkan item pembelian.
4. Untuk produk variant, admin bisa memilih variant spesifik.
5. Realtime projected stock dihitung.
6. Finalisasi pembelian akan memanggil `StockService::processPurchaseStockUpdate()`.
7. Stock movement tercatat sebagai purchase confirmed.

## 7.4 Workflow Print Service

1. Sistem generate `PrintSession` baru.
2. QR/session token diberikan ke customer.
3. Customer upload file.
4. Sistem menghitung pages_count per file.
5. Customer memilih variant print (paper size / print type).
6. Sistem cek stok media cetak.
7. Sistem membuat `PrintOrder`.
8. Pembayaran diproses sesuai mode.
9. Setelah pembayaran confirmed, stok kertas dikurangi.
10. Order masuk queue print.
11. Admin print, complete, dan file dibersihkan.
12. Session ditutup/inactive.

## 7.5 Workflow Employee Tracking

1. Admin mengaktifkan tracking pada order.
2. Nama karyawan penanggung jawab disimpan ke order.
3. Saat order selesai, `EmployeePerformance` diupdate/create.
4. Admin dapat melihat ranking, transaksi, total revenue, average transaction, dan bonus history.

---

## 8. Keunggulan Aplikasi

### 8.1 Cakupan Bisnis Sangat Luas

Viviashop bukan aplikasi satu domain. Dalam satu codebase, ia sudah mencakup:

- ecommerce frontend,
- penjualan toko/offline,
- procurement,
- inventory audit,
- print service,
- employee incentive tracking,
- social posting.

Untuk bisnis yang butuh satu sistem terpadu, ini nilai besar.

### 8.2 Dukungan Produk Configurable Relatif Matang

Adanya `ProductVariantService`, variant attributes, variant API, dan support detail frontend menunjukkan bahwa produk configurable sudah menjadi kapabilitas inti, bukan add-on tipis.

### 8.3 Stok Sudah Memiliki Audit Trail

Keberadaan `StockMovement` dan service terkait adalah keunggulan besar, karena banyak aplikasi toko kecil hanya menyimpan angka stok final tanpa histori mutasi.

### 8.4 Print Service Sangat Spesifik dan Bernilai Tinggi

Fitur print service dengan session token, QR code, file counting, payment mode, dan queue admin adalah diferensiasi kuat yang jarang ada di Laravel ecommerce umum.

### 8.5 Reporting Cukup Lengkap

Revenue, product, inventory, payment, dashboard metrics, supplier performance, dan employee metrics membuat aplikasi ini cukup matang untuk kebutuhan operasional harian.

### 8.6 Integrasi Eksternal Sudah Kaya

Integrasi Midtrans, RajaOngkir, Cloudinary, dan Instagram menunjukkan aplikasi ini sudah didorong ke use case nyata, bukan hanya CRUD internal.

### 8.7 Ada Upaya Menjaga Konsistensi Data

Beberapa sinyal positif:

- penggunaan transaksi DB,
- service sync stok,
- anti duplicate upload pada print session,
- duplicate variant detection,
- payment status reconciliation ke Midtrans.

---

## 9. Kelemahan, Risiko, dan Technical Debt

## 9.1 Route Web Sangat Gemuk dan Campur Aduk

`routes/web.php` memuat terlalu banyak concern sekaligus:

- public routes,
- auth routes,
- payment callbacks,
- admin routes,
- print service routes,
- test/debug routes.

Dampaknya:

- onboarding lebih sulit,
- risiko konflik route lebih tinggi,
- review perubahan lebih berat,
- sulit menerapkan boundary yang tegas antar domain.

## 9.2 Banyak Route Debug/Test Masih Hidup di Web Surface

Route seperti berikut masih terlihat pada permukaan route utama:

- `debug-order`,
- `debug-view-error`,
- `debug-midtrans`,
- banyak `test-*` employee performance/payment/checkout route,
- `stress-test-employee-performance`.

Sebagian ada dalam local guard, tetapi banyak yang tampak tidak dibatasi `app()->environment('local')`.

Risiko:

- noise di route surface produksi,
- attack surface bertambah,
- kebocoran info/debug behavior,
- maintainability menurun.

## 9.3 Controller Besar dan Memuat Banyak Logic

Controller seperti berikut sudah berperan sangat besar:

- `Frontend\OrderController`
- `Admin\OrderController`
- `Admin\ProductController`
- `Frontend\HomepageController`

Beberapa logic yang idealnya dipisah ke service masih berada di controller, misalnya:

- payment flow,
- shipment save,
- cart-to-order materialization,
- search algorithm,
- status reconciliation,
- admin order orchestration.

## 9.4 Arsitektur Stok Masih Hibrida dan Berisiko

Sistem menyimpan stok pada dua tempat:

- `product_inventories.qty`,
- `product_variants.stock`.

Selain itu, timing pengurangan stok berbeda antar flow:

- frontend checkout mengurangi stok saat order item disimpan,
- admin order baru mengurangi stok saat completion,
- print order mengurangi stok saat payment confirmed.

Artinya, invariant stok sistem bergantung pada konteks flow, bukan satu aturan tunggal.

Konsekuensi teknis:

- lebih sulit reason tentang stok final,
- rawan double deduction/restore salah,
- perlu sync tools seperti `synchronizeStockTables()`.

## 9.5 Transisi Sistem Varian Belum Sepenuhnya Bersih

Codebase masih membawa dua paradigma varian:

- legacy child product (`products.parent_id`),
- modern `product_variants` + `variant_attributes`.

Frontend bahkan punya branch khusus untuk mengabaikan varian pada simple product jika datanya inkonsisten.

Ini indikasi kuat bahwa migrasi ke sistem varian baru belum sepenuhnya selesai dibersihkan.

## 9.6 Flow Pembayaran Terduplikasi di Banyak Tempat

Flow Midtrans dan status payment tersebar di:

- `Frontend\OrderController`,
- `Admin\OrderController`,
- `PrintServiceController`,
- `PrintService`.

Masalahnya bukan sekadar ada banyak flow, tetapi logika yang mirip hidup di banyak tempat. Ini meningkatkan risiko divergensi behavior saat ada perubahan payment policy.

## 9.7 Testing Otomatis Sangat Minim

Permukaan test yang terdeteksi hanya:

- `tests/Feature/ExampleTest.php`
- `tests/Unit/ExampleTest.php`

Artinya, sebagian besar stabilitas sistem saat ini bergantung pada:

- testing manual,
- route debug/test,
- custom artisan/console command,
- dan pengalaman operator/developer.

Untuk aplikasi dengan domain sekompleks ini, coverage tersebut sangat rendah.

## 9.8 README Lama Tidak Mewakili Sistem Saat Ini

README repository masih menggambarkan aplikasi sebagai Laravel app yang fokus pada Instagram integration dan homepage sederhana. Itu sudah jauh tertinggal dari implementasi aktual yang mencakup procurement, stock, print service, employee performance, variant system, dan payment gateway kompleks.

## 9.9 Banyak Artefak Lama / Backup File

Ditemukan artefak seperti:

- `app/Http/Controllers/Frontend/CartController.php.bak`
- `app/Http/Controllers/Frontend/CartControllerNew.php`

Ini bukan error runtime langsung, tetapi merupakan sinyal code hygiene yang bisa membingungkan saat maintenance.

## 9.10 Pengaturan Shared View Belum Terpusat

Banyak controller secara manual melakukan:

- `view()->share('setting', $setting)`
- `view()->share('countCart', $cart)`

Ini berarti concern global view state belum dipusatkan via view composer/service provider, sehingga kode berulang di banyak controller.

## 9.11 Operational Automation Masih Tipis

`app/Console/Kernel.php` menunjukkan ada schedule untuk `print:fix-storage`, tetapi masih di-comment. Ini menandakan automation operasional sudah dipikirkan, namun belum diaktifkan penuh.

## 9.12 Modul Pengeluaran Tampak Orphaned

`PengeluaranController` ada dan logic pengeluaran dipakai untuk laporan, tetapi route web-nya tidak terlihat aktif. Ini bisa menandakan fitur belum selesai, tidak dipakai, atau sempat terlepas saat refactor.

---

## 10. Kualitas Teknis dan Maintainability

### 10.1 Apa yang Sudah Baik

- Domain model cukup kaya dan tidak tipis.
- Service layer mulai digunakan pada area kompleks.
- Ada histori stok.
- Ada transaksi DB pada beberapa titik penting.
- Integrasi payment dan shipping nyata.
- Sistem mendukung banyak channel bisnis.

### 10.2 Apa yang Paling Perlu Diwaspadai

- konsistensi stok,
- konsistensi status order antar flow,
- refactor besar di controller order,
- cleanup route debug/test,
- finalisasi migrasi varian legacy ke varian baru,
- penambahan test otomatis sebelum perubahan besar.

---

## 11. Rekomendasi Prioritas

### Prioritas 1: Stabilitas Inti

1. Rapikan policy stok menjadi satu aturan yang konsisten lintas frontend/admin/print.
2. Tambahkan test otomatis untuk flow berikut:
   - checkout frontend,
   - admin order completion,
   - purchase finalization,
   - print service payment confirmation,
   - employee tracking.
3. Pisahkan dan nonaktifkan route debug/test dari `routes/web.php` produksi.

### Prioritas 2: Kebersihan Arsitektur

1. Pecah `routes/web.php` menjadi file per domain.
2. Pindahkan logic berat dari controller order/product/homepage ke service/action layer.
3. Pusatkan shared view data (`setting`, `countCart`) ke view composer atau service provider.

### Prioritas 3: Konsolidasi Domain

1. Finalkan migrasi dari legacy product-child variants ke `product_variants` tunggal.
2. Review modul orphan seperti `PengeluaranController` dan file backup lama.
3. Konsolidasikan payment orchestration agar Midtrans logic tidak tersebar terlalu luas.

### Prioritas 4: Dokumentasi dan Operasional

1. Gantikan README lama dengan dokumentasi yang merepresentasikan sistem aktual.
2. Dokumentasikan flow stok dan payment sebagai source of truth internal.
3. Evaluasi aktivasi scheduled task operasional yang sudah disiapkan.

---

## 12. Inventaris Teknis Ringkas

### 12.1 Controller Admin yang Terdeteksi

- `AttributeController`
- `AttributeOptionController`
- `AttributeVariantController`
- `CategoryController`
- `DashboardController`
- `EmployeePerformanceController`
- `OrderController`
- `PaperTypeController`
- `PrintServiceController`
- `PrintTypeController`
- `ProductController`
- `ProductImageController`
- `ProductVariantController`
- `ProfileController`
- `ReportController`
- `ShipmentController`
- `SlideController`
- `SmartPrintConverterController`
- `SmartPrintVariantController`
- `StockCardController`
- `TestimonialsController`
- `UserController`

### 12.2 Controller Frontend yang Terdeteksi

- `CartController`
- `CartControllerNew`
- `HomepageController`
- `OrderController`
- `PaymentController`
- `ProductController`
- `WishListController`

### 12.3 Service yang Terdeteksi

- `PrintService`
- `ProductVariantService`
- `SmartPrintVariantService`
- `StockManagementService`
- `StockService`

### 12.4 Model Penting yang Terdeteksi

#### Katalog dan varian

- `Product`
- `ProductVariant`
- `ProductImage`
- `ProductInventory`
- `Brand`
- `Category`
- `ProductCategory`
- `Attribute`
- `AttributeOption`
- `AttributeVariant`
- `VariantAttribute`
- `ProductAttributeValue`

#### Order dan customer

- `Order`
- `OrderItem`
- `Payment`
- `Shipment`
- `WishList`
- `User`

#### Procurement dan inventori

- `Supplier`
- `Pembelian`
- `PembelianDetail`
- `Pengeluaran`
- `RekamanStok`
- `StockMovement`

#### Print service

- `PrintSession`
- `PrintOrder`
- `PrintFile`
- `PaperType`
- `PrintType`

#### Operasional lain

- `EmployeePerformance`
- `EmployeeBonus`
- `Setting`
- `Slide`
- `Testimonial`

### 12.5 Evolusi Skema dari Migration

#### Fase awal 2023

- users/auth,
- categories,
- products,
- attributes,
- product inventories,
- product categories,
- product images,
- orders,
- order items,
- payments,
- wishlist,
- shipments,
- slides.

#### Fase 2024

- payment slip,
- payment method order,
- order attachments,
- supplier,
- rekaman stok,
- setting,
- pengeluaran,
- pembelian dan detail pembelian.

#### Fase 2025

- testimonial,
- instagram tables,
- shopping cart table,
- barcode product,
- variant system baru,
- district user,
- brand,
- product variants,
- variant attributes,
- employee tracking dan bonuses,
- print service product flags,
- print sessions/orders/files,
- stock movements,
- shipping adjustment,
- paper types,
- print types.

### 12.6 Command-Line Tooling yang Terlihat Penting

Ada banyak artisan command custom untuk debugging, migration, dan stress test, misalnya:

- `FixPrintFileStorage`
- `MigrateToNewVariantSystem`
- `StressDualInputSystemCommand`
- `TestPrintServiceFlow`
- berbagai command employee performance/debug.

Ini menunjukkan tim sebelumnya aktif menggunakan CLI untuk diagnosis dan migrasi sistem.

### 12.7 Testing Surface Saat Ini

- Unit test: hanya `ExampleTest`
- Feature test: hanya `ExampleTest`

Artinya automated regression safety net masih sangat tipis.

---

## 13. Penilaian Akhir

Secara keseluruhan, Viviashop adalah aplikasi Laravel operasional yang sudah berkembang jauh melampaui toko online sederhana. Dari sisi capability bisnis, aplikasi ini kuat dan kaya domain. Dari sisi arsitektur, aplikasi ini fungsional tetapi menanggung technical debt evolusioner yang cukup nyata.

Jika aplikasi ini dipertahankan sebagai platform utama bisnis, maka prioritas teknis paling penting bukan menambah fitur baru sebanyak mungkin, tetapi:

- menstabilkan invariants stok,
- merapikan surface route/controller,
- mengurangi duplikasi flow pembayaran,
- dan membangun test coverage minimal untuk domain paling kritikal.

Selama empat hal itu tidak dibereskan, perubahan besar pada modul order, stok, print service, atau varian akan tetap berisiko tinggi. Namun bila dibersihkan bertahap, fondasi domain bisnisnya sudah cukup kaya untuk dikembangkan lebih lanjut tanpa perlu rewrite total.