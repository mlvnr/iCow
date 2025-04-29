CREATE DATABASE IF NOT EXISTS sistem_pakar_sapi;
USE sistem_pakar_sapi;

CREATE TABLE hasil_diagnosa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
  gejala_terpilih TEXT,
  penyakit VARCHAR(100),
  persentase INT
);