@extends('landingPage.layouts.child.main')

@section('content')
    <div class="container-fluid">
        <!-- Poin -->
        <div class="cardy">
            {{-- <div class="card-header">
                Featured
            </div> --}}
            <div class="cardy-body">
                <h3 class="kucing">Poin</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><th colspan="3">Kehadiran</th></tr>
                            <tr>
                                <td>1</td>
                                <td>Terlambat datang ke sekolah 15 menit setelah bel dibunyikan</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Terlambat masuk 15 menit setelah pergantian jam</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Terlambat masuk 15 menit setelah jam istirahat</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Tidak masuk sekolah tanpa berita/keterangan (alpa)</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Meninggalkan lingkungan sekolah/belanja<br>di luar sekolah tanpa izin guru</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Tidak mengikuti kegiatan yang ditugaskan sekolah</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Terlambat atau tidak mengikuti upacara</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Cabut</td>
                                <td>10</td>
                            </tr>
                            <tr><th colspan="3">Pakaian dan Kebersihan</th></tr>
                            <tr>
                                <td>1</td>
                                <td>Tidak memakai atribut yang telah ditetapkan sekolah (dasi, kacu, ring, lambang
                                    OSIS, lokasi sekolah, papan nama)</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tidak memakai tali pinggang ukuran standar/warna hitam</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Tidak memakai sepatu standar warna hitan/kaos kaki standar warna putih</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Baju keluar</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Berkuku panjang</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Memakai seragam lain/tidak sesuai jadwal yang telah ditetapkan sekolah</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Berambut panjang (putra)</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Memakai kalung/gelang/anting-anting (putra) </td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Memakai perhiasan berlebihan</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Memakai celana sempit, baju ketat dan rok sempit/pendek</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Mewarnai rambut</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Membuang sampah tidak pada tempatnya</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>Tidak melaksanakan piket kelas</td>
                                <td>10</td>
                            </tr>
                            <tr><th colspan="3">Proses Belajar Mengajar</th></tr>
                            <tr>
                                <td>1</td>
                                <td>Makan/minum pada saat kegiatan belajar di kelas</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tidak membuat/mengumpulkan pekerjaan rumah (PR)</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mempelajari mata pelajaran lain ketika belajar suatu mata pelajaran</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Memakai pakaian olahraga ketika belajar di kelas</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Tidak memiliki catatan pelajaran</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Tidak mengerjakan latihan yang ditugaskan oleh guru</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Duduk di tempat parkir/kantin/di luar kelas diwaktu proses belajar mengajar</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Terbukti mengaktifkan HP pada jam pelajaran berlangsung, maka HP tersebut
                                    akan ditahan sbb : ketangkap 1 kali ditahan 3 hari, ketangkap ke 2 kali ditahan 1
                                    bulan, ketangkap ke 3 kali ditahan 2 bulan dan lebih dari 3 kali akan
                                    dikembalikan setelah tamat atau pindah sekolah.</td>
                                <td>7</td>
                            </tr>
                            <tr><th colspan="3">Prilaku</th></tr>
                            <tr>
                                <td>1</td>
                                <td>Mengirimkan surat sakit/izin palsu</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Lompat pagar sekolah</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Memaki/mengejek teman/perundungan</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Merokok di lingkungan sekolah</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Tidak sopan terhadap kepala sekolah, guru & pelaksana sekolah lainnya</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Berkelahi tanpa alat</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Merusak/mencoret-coret sarana dan prasarana sekolah</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Terbukti melakukan adegan mesra di lingkungan sekolah</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Membawa senjata tajam ke sekolah</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Terlibat tawuran</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Terlibat pemerasan/pencurian/penipuan/tindakan asusila</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Melakukan tindakan yang mencemarkan nama baik sekolah</td>
                                <td>DO</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>Berkelahi menggunakan senjata tajam</td>
                                <td>DO</td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>Mengirim SMS menghina/menuduh kepala sekolah, majelis guru, staff tata
                                    usaha & pelaksana sekolah</td>
                                <td>DO</td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>Menyebarkan fitnah/memprovokasi yang menyebabkan unjuk rasa </td>
                                <td>DO</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>Membawa/mengedar/memakai narkoba, minuman keras, majalah porno,
                                    VCD porno, HP bergambar/film porno, seks bebas dan sejenisnya</td>
                                <td>DO</td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td>Memukul dan menganiaya kepala sekolah, guru & pelaksana sekolah</td>
                                <td>DO</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Perhitungan Poin -->
        <div class="cardy">
            <div class="cardy-body">
                <h3 class="kucing">Perhitungan Poin</h3>
                <p class="cardy-text">
                    <ul>
                        <li><b>01 - 20 poin</b><br>Penanganan oleh Wali Kelas</li>
                        <li><b>21 - 30 poin</b><br>Penanganan oleh Wali Kelas didampingi Guru BP/BK</li>
                        <li><b>≥ 30 poin</b><br>Penanganan oleh Waka Kesiswaan</li>
                    </ul>
                </p>
                <!-- Pemanggilan Orang Tua/Wali -->
                <p class="cardy-text">
                    <h5>Tahapan Panggilan Orang Tua/Wali Tingkat:</h5>
                    <ul>
                        <li><b>Wali Kelas</b><br>Penanganan oleh Wali Kelas</li>
                        <li><b>Waka Kesiswaan</b><br>Penanganan oleh Wali Kelas didampingi Guru BP/BK</li>
                    </ul>
                </p>
                <!-- Sanksi/Hukuman Melanggar Peraturan Sekolah -->
                <p class="cardy-text">
                    <h5>Sanksi/Hukuman Melanggar Peraturan Sekolah</h5>
                    <ul>
                        <li><b>5 poin</b><br>Mencabut rumput (gulma) selama 3 hari</li>
                        <li><b>10 poin</b><br>Menyiram tanaman sekitaran tertentu di Sekolah selama 3 hari</li>
                        <li><b>15 poin</b><br>Membawa tanah hitam (2 bks)</li>
                        <li><b>20 poin</b><br>Membawa bibit tanaman hias (2 buah)  atau Buku Bacaan 1 Buah</li>
                    </ul>
                </p>
                <!-- Sanksi Langsung -->
                <p class="cardy-text">
                    <h5>Sanksi Langsung</h5>
                    <p>Bagi siswa yang terlambat atau yang tidak mengikuti upacara dapat diberikan hukuman/ sanksi menyiram tanaman, memungut sampah atau hukuman lain yang diberikan oleh petugas piket</p>
                </p>
                <!-- Penghargaan/Apresiasi Kejujuran Siswa -->
                <p class="cardy-text">
                    <h5>Sanksi/Hukuman Melanggar Peraturan Sekolah</h5>
                    <ul>
                        <li>Menemukan HP, uang dan barang berharga lainnya dikembalikan ke Sekolah, piket, walas</li>
                        <li>2.	Siswa yang menemukan temannya buang sampah sembarangan & dilaporkan ke pihak Sekolah, yang buang sampah, denda Rp50.000,00 yang melapor dapat penghargaan Rp50.000,00.</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
@endsection
