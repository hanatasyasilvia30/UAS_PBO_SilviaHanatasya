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

    public function hitungTagihanSemester(): float {
        return $this->tarifUktNominal * 0.5;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== SPESIFIKASI AKADEMIK: MAHASISWA PRESTASI ===<br>";
        echo "ID Mahasiswa      : " . $this->idMahasiswa . "<br>";
        echo "Nama              : " . $this->namaMahasiswa . "<br>";
        echo "NIM               : " . $this->nim . "<br>";
        echo "Semester          : " . $this->semester . "<br>";
        echo "Instansi Beasiswa : " . $this->namaInstansiBeasiswa . "<br>";
        echo "Syarat Minimal IPK: " . $this->minimalIpkSyarat . "<br>";
        echo "Total Tagihan     : Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . " (Potongan Beasiswa)<br>";
        echo "------------------------------------------------<br><br>";
    }
}