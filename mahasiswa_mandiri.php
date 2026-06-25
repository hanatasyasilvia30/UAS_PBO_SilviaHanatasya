<?php
// mahasiswa_mandiri.php
require_once 'mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    private string $golonganUkt;
    private string $namaWali;

    public function __construct(int $idMahasiswa, string $namaMahasiswa, string $nim, int $semester, 
                                float $tarifUktNominal, string $golonganUkt, string $namaWali) {
        parent::__construct($idMahasiswa, $namaMahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    public function hitungTagihanSemester(): float {
        return $this->tarifUktNominal;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== SPESIFIKASI AKADEMIK: MAHASISWA MANDIRI ===<br>";
        echo "ID Mahasiswa : " . $this->idMahasiswa . "<br>";
        echo "Nama         : " . $this->namaMahasiswa . "<br>";
        echo "NIM          : " . $this->nim . "<br>";
        echo "Semester     : " . $this->semester . "<br>";
        echo "Golongan UKT : " . $this->golonganUkt . "<br>";
        echo "Nama Wali    : " . $this->namaWali . "<br>";
        echo "Total Tagihan: Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . "<br>";
        echo "------------------------------------------------<br><br>";
    }
}