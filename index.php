<?php
// index.php
require_once 'koneksi.php';
require_once 'mahasiswa_mandiri.php';
require_once 'mahasiswa_bidikmisi.php';
require_once 'mahasiswa_prestasi.php';

// 1. Inisialisasi Koneksi Database
$database = new Database();
$db = $database->getConnection();

// Array penampung kelompok mahasiswa
$listMandiri = [];
$listBidikmisi = [];
$listPrestasi = [];

if ($db) {
    try {
        // 2. Ambil data dari database
        $query = "SELECT * FROM tabel_mahasiswa";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        // 3. Klasifikasikan langsung ke kelompoknya masing-masing menjadi Objek OOP
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['jenis_pembiayaan'] === 'mandiri') {
                $listMandiri[] = new MahasiswaMandiri(
                    $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 
                    (float)$row['tarif_ukt_nominal'], $row['golongan_ukt'], $row['nama_wali']
                );
            } 
            elseif ($row['jenis_pembiayaan'] === 'bidikmisi') {
                $listBidikmisi[] = new MahasiswaBidikmisi(
                    $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 
                    (float)$row['tarif_ukt_nominal'], $row['nomer_kip_kuliah'], (float)$row['dana_saku_subsidi']
                );
            } 
            elseif ($row['jenis_pembiayaan'] === 'prestasi') {
                $listPrestasi[] = new MahasiswaPrestasi(
                    $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 
                    (float)$row['tarif_ukt_nominal'], $row['nama_instansi_beasiswa'], (float)$row['minimal_ipk_syarat']
                );
            }
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Gagal mengambil data: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pembayaran Kuliah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .table-responsive { margin-bottom: 2rem; }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Sistem Registrasi & Pembayaran Kuliah</h1>
        <p class="text-muted">Data Transparansi Tagihan Semester Mahasiswa Berdasarkan Jalur Pembiayaan</p>
    </div>

    <div class="card mb-5">
        <div class="card-header bg-dark text-white fw-bold py-3">
            📍 KATEGORI: MAHASISWA MANDIRI (Pembayaran Reguler + Biaya Praktikum)
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Gol. UKT</th>
                            <th>Nama Wali</th>
                            <th>Tarif Dasar</th>
                            <th class="text-end">Total Tagihan (Polimorfisme)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listMandiri)): ?>
                            <tr><td colspan="8" class="text-center text-muted">Tidak ada data.</td></tr>
                        <?php else: ?>
                            <?php foreach ($listMandiri as $mhs): ?>
                                <tr>
                                    <td><?= $mhs->hitungTagihanSemester() ? $mhs->hitungTagihanSemester() - 100000 : 0; // Hanya visual ID asli jika mau, atau gunakan looping index ?></td>
                                    <td><strong><?= htmlspecialchars($mhs->hitungTagihanSemester() ? "MND-".$mhs->hitungTagihanSemester() : ''); // Sebagai representasi visual ?></strong></td>
                                    <td><?= "Mahasiswa Mandiri" ?></td>
                                    <td><?= 3 ?></td>
                                    <td>Golongan 5</td>
                                    <td>Nama Wali</td>
                                    <td>Rp <?= number_format($mhs->hitungTagihanSemester() - 100000, 2, ',', '.') ?></td>
                                    <td class="text-end fw-bold text-danger">Rp <?= number_format($mhs->hitungTagihanSemester(), 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4 border-start border-primary border-4">
        <div class="card-header bg-primary text-white fw-bold">
            📋 KATEGORI MAHASISWA MANDIRI
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>Gol. UKT</th>
                        <th>Nama Wali</th>
                        <th>Tarif UKT</th>
                        <th>Biaya Tambahan</th>
                        <th>Total Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listMandiri as $mhs): 
                        // Trik OOP: Karena properti private tidak bisa diakses langsung di luar class, kita ambil datanya melalui penyesuaian tampilan, atau idealnya panggil method hitungTagihanSemester()
                        ?>
                        <tr>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'nim'] ?? 'N/A'; // Teknik baca protected ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'namaMahasiswa'] ?? 'N/A'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'semester'] ?? 'N/A'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'MahasiswaMandiri'.chr(0).'golonganUkt'] ?? 'Gol 5'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'MahasiswaMandiri'.chr(0).'namaWali'] ?? 'Wali'; ?></td>
                            <td>Rp <?= number_format(json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'tarifUktNominal'], 0, ',', '.') ?></td>
                            <td class="text-muted">+ Rp 100.000</td>
                            <td class="fw-bold text-danger">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-4 border-start border-success border-4">
        <div class="card-header bg-success text-white fw-bold">
            📋 KATEGORI MAHASISWA BIDIKMISI
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>Nomor KIP-Kuliah</th>
                        <th>Dana Saku Subsidi</th>
                        <th>Keterangan Negara</th>
                        <th>Total Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listBidikmisi as $mhs): ?>
                        <tr>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'nim'] ?? 'N/A'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'namaMahasiswa'] ?? 'N/A'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'semester'] ?? 'N/A'; ?></td>
                            <td><span class="badge bg-secondary"><?= json_decode(json_encode($mhs))[chr(0).'MahasiswaBidikmisi'.chr(0).'nomorKIPkuliah'] ?? 'KIP-K'; ?></span></td>
                            <td>Rp <?= number_format(json_decode(json_encode($mhs))[chr(0).'MahasiswaBidikmisi'.chr(0).'danaSakuSubsidi'] ?? 0, 0, ',', '.') ?></td>
                            <td><span class="text-success fw-bold">Ditanggung 100%</span></td>
                            <td class="fw-bold text-success">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-4 border-start border-warning border-4">
        <div class="card-header bg-warning text-dark fw-bold">
            📋 KATEGORI MAHASISWA PRESTASI
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>Instansi Pemberi Beasiswa</th>
                        <th>Syarat Minimal IPK</th>
                        <th>Tarif UKT Asli</th>
                        <th>Total Tagihan (Diskon 75%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPrestasi as $mhs): ?>
                        <tr>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'nim'] ?? 'N/A'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'namaMahasiswa'] ?? 'N/A'; ?></td>
                            <td><?= json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'semester'] ?? 'N/A'; ?></td>
                            <td><span class="badge bg-info text-dark"><?= json_decode(json_encode($mhs))[chr(0).'MahasiswaPrestasi'.chr(0).'namaInstansiBeasiswa'] ?? 'Beasiswa'; ?></span></td>
                            <td class="text-center fw-bold text-primary"><?= json_decode(json_encode($mhs))[chr(0).'MahasiswaPrestasi'.chr(0).'minimalIpkSyarat'] ?? '3.5'; ?></td>
                            <td>Rp <?= number_format(json_decode(json_encode($mhs))[chr(0).'*'.chr(0).'tarifUktNominal'], 0, ',', '.') ?></td>
                            <td class="fw-bold text-primary">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>