<?php
// mahasiswa.php

abstract class Mahasiswa {
    protected int $idMahasiswa;
    protected string $namaMahasiswa;
    protected string $nim;
    protected int $semester;
    protected float $tarifUktNominal;

    public function __construct(int $idMahasiswa, string $namaMahasiswa, string $nim, int $semester, float $tarifUktNominal) {
        $this->idMahasiswa = $idMahasiswa;
        $this->namaMahasiswa = $namaMahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    abstract public function hitungTagihanSemester(): float;
    abstract public function tampilkanSpesifikasiAkademik(): void;
}