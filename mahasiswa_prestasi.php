<?php
// mahasiswa_prestasi.php
require_once 'mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private string $namaInstansiBeasiswa;
    private float $minimalIpkSyarat;

    public function __construct(int $idMahasiswa, string $namaMahasiswa, string $nim, int $semester, 
                                float $tarifUktNominal, string $namaInstansiBeasiswa, float $minimalIpkSyarat) {
        parent::__construct($idMahasiswa, $namaMahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // OVERRIDING: Cukup membayar 25% (Mendapat potongan beasiswa 75%)
    public function hitungTagihanSemester(): float {
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== SPESIFIKASI AKADEMIK: MAHASISWA PRESTASI ===<br>";
        echo "ID Mahasiswa      : " . $this->idMahasiswa . "<br>";
        echo "Nama              : " . $this->namaMahasiswa . "<br>";
        echo "NIM               : " . $this->nim . "<br>";
        echo "Semester          : " . $this->semester . "<br>";
        echo "Instansi Beasiswa : " . $this->namaInstansiBeasiswa . "<br>";
        echo "Syarat Minimal IPK: " . $this->minimalIpkSyarat . "<br>";
        echo "Tarif Asli UKT    : Rp " . number_format($this->tarifUktNominal, 2, ',', '.') . "<br>";
        echo "Diskon Beasiswa   : 75%<br>";
        echo "Total Tagihan     : Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . " (Cukup bayar 25%)<br>";
        echo "------------------------------------------------<br><br>";
    }
}