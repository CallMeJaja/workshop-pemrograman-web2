# 🧮 UTS Tipe D – Studi Kasus: Perhitungan Gaji Tim Software

## 📋 Kebutuhan Fungsional

1. **Data anggota tim**

   - Nama anggota tim tersimpan dalam array dan dapat ditampilkan melalui dropdown.
   - Jumlah anggota: **5 orang** (nama bebas).

2. **Data posisi tim**

   - Posisi disimpan dalam array dan dapat ditampilkan melalui dropdown.
   - Daftar posisi:
     - Lead Developer
     - QA Engineer
     - DevOps Engineer
     - Backend Dev
     - Frontend Dev

3. **Komponen gaji tim**

   - Upah kerja per jam
   - Upah lembur per jam
   - Fee project

4. **Perhitungan gaji**

   - Program harus dapat menghitung gaji setiap anggota tim sesuai ketentuan.

5. **Form input**

   - Nama anggota tim
   - Posisi
   - Jam kerja dalam 1 bulan
   - Jam lembur
   - Nilai harga project

6. **Output program**
   - Menampilkan rincian komponen gaji dan total gaji yang didapat oleh anggota tim.

---

## ⚙️ Batasan / Ketentuan

1. Perhitungan gaji dilakukan **setiap satu bulan**.
2. Anggota tim idealnya bekerja **40 jam per minggu**.
3. Kelebihan jam kerja ideal dihitung sebagai **upah lembur** sesuai ketentuan.
4. Upah per jam berdasarkan posisi:

| Posisi          | Upah per Jam |
| --------------- | ------------ |
| Lead Developer  | Rp 450.000   |
| QA Engineer     | Rp 250.000   |
| DevOps Engineer | Rp 350.000   |
| Backend Dev     | Rp 300.000   |
| Frontend Dev    | Rp 300.000   |

5. Upah lembur per jam dan fee project dihitung berdasarkan **persentase upah per jam posisi**:

| Posisi          | Upah Lembur (%) | Fee Project (%) |
| --------------- | --------------- | --------------- |
| Lead Developer  | 18%             | 5%              |
| QA Engineer     | 12%             | 1%              |
| DevOps Engineer | 10%             | 2.5%            |
| Backend Dev     | 15%             | 3%              |
| Frontend Dev    | 15%             | 3%              |
