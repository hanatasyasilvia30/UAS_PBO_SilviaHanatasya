<?php
// mahasiswa_bidikmisi.php
require_once 'mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private string $nomorKIPkuliah;
    private float $danaSakuSubsidi;

    public function __construct(int $idMahasiswa, string $namaMahasiswa, string $nim, int $semester, 
                                float $tarifUktNominal, string $nomorKIPkuliah, float $danaSakuSubsidi) {
        parent::__construct($idMahasiswa, $namaMahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKIPkuliah = $nomorKIPkuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    public function hitungTagihanSemester(): float {
        return 0.00;
    }

    public function tampilkanSpesifikasiAkademik(): void {
        echo "=== SPESIFIKASI AKADEMIK: MAHASISWA BIDIKMISI ===<br>";
        echo "ID Mahasiswa   : " . $this->idMahasiswa . "<br>";
        echo "Nama           : " . $this->namaMahasiswa . "<br>";
        echo "NIM            : " . $this->nim . "<br>";
        echo "Semester       : " . $this->semester . "<br>";
        echo "Nomor KIP-K    : " . $this->nomorKIPkuliah . "<br>";
        echo "Dana Saku/Bulan: Rp " . number_format($this->danaSakuSubsidi, 2, ',', '.') . "<br>";
        echo "Total Tagihan  : Rp " . number_format($this->hitungTagihanSemester(), 2, ',', '.') . " (Disubsidi Penuh)<br>";
        echo "------------------------------------------------<br><br>";
    }
}