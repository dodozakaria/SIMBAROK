<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Tahfidz;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $userCreate = new User();
        $userCreate->nama = 'Administrator';
        $userCreate->email = 'admin@gmail.com';
        $userCreate->roles = 'ADMIN';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'Operator';
        $userCreate->email = 'operator@gmail.com';
        $userCreate->roles = 'OPERATOR';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'SAEKHUDIN';
        $userCreate->email = 'saekhudin@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'AHMAD AGUS SALIM';
        $userCreate->email = 'ahmad@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'NURFATHI';
        $userCreate->email = 'nurfathi@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'MUHAMAD RIFAI';
        $userCreate->email = 'rifai@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'MUHAMAD HOLIL';
        $userCreate->email = 'holil@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'MUSDALIFAH';
        $userCreate->email = 'musdalifah@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'NUR INDAH RAHMAWATI';
        $userCreate->email = 'indah@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $userCreate = new User();
        $userCreate->nama = 'NUR HIDAYATUN';
        $userCreate->email = 'hidayatun@gmail.com';
        $userCreate->roles = 'GURU';
        $userCreate->status = '1';
        $userCreate->password = Hash::make('12345678');
        $userCreate->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'DIKA HERIYANTO';
        $tahfidzs->alamat = 'RT 003 RW 003 KELURAHAN CENGKARENG BARAT KEC CENGKARENG';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2009-12-18';
        $tahfidzs->nama_ayah = 'SUHERMAN';
        $tahfidzs->nama_ibu = 'DIRAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ALFARIDHO NUZULUL QUR AN';
        $tahfidzs->alamat = 'DK. COCOK RT 017 RW03 DESA LUWIJAWA KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2006-09-17';
        $tahfidzs->nama_ayah = 'CRISNA ARIES SURATNO';
        $tahfidzs->nama_ibu = 'KIA KARNITI';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'REDIKA ARDI SALAM';
        $tahfidzs->alamat = 'DK. KRAJAN RT 005 RW 002 DESA LEMBASARI KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2007-10-13';
        $tahfidzs->nama_ayah = 'ZAENAL ARIFIN';
        $tahfidzs->nama_ibu = 'DAROZATUN';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ARIS SETIAWAN SAPUTRA';
        $tahfidzs->alamat = 'DK. LEMAH GUGUR RT 001 RW 001 DESA LEMBASARI KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2006-12-17';
        $tahfidzs->nama_ayah = 'SARYO';
        $tahfidzs->nama_ibu = 'FATMAWATI';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'MUCH. BAHTIAR';
        $tahfidzs->alamat = 'KP. BABAKAN POCIS RT 001 RW 001 KELURAHAN BAKTI JAYA TANGSEL';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2007-01-01';
        $tahfidzs->nama_ayah = 'ANDIAWAN';
        $tahfidzs->nama_ibu = 'SITI ANITAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'FAIZUN ADITIA SAPUTRA';
        $tahfidzs->alamat = 'RT 007 RW 001 DESA KREMAN KEC. WARUREJA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-05-14';
        $tahfidzs->nama_ayah = 'PURWANTO';
        $tahfidzs->nama_ibu = 'TOANAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'MEIDY FACHRIL AL NEZAM';
        $tahfidzs->alamat = 'RT 003 RW 002 DESA KREMAN KEC. WARUREJA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-05-27';
        $tahfidzs->nama_ayah = 'KASMU';
        $tahfidzs->nama_ibu = 'BAROKAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'AHMAD MAULID ASSOLEH';
        $tahfidzs->alamat = 'RT 004 RW 001 DESA KREMAN KEC. WARUREJA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2012-02-13';
        $tahfidzs->nama_ayah = 'AHMAD SOLIHIN';
        $tahfidzs->nama_ibu = 'ELI ERNAWATI';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'RIZQI SYAHRU RAMADHANI';
        $tahfidzs->alamat = 'RT 003 RW 002 DESA KREMAN KEC. WARUREJA';
        $tahfidzs->jenis_kelamin = 'L';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-08-09';
        $tahfidzs->nama_ayah = 'SUPRIYANTO';
        $tahfidzs->nama_ibu = 'MURINAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ISNAENI HIDAYATI';
        $tahfidzs->alamat = 'DUKUH TENGAH RT 010 RW 002 DESA GANTUNGAN KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2002-11-25';
        $tahfidzs->nama_ayah = 'NUR ASKURI';
        $tahfidzs->nama_ibu = 'MUTOLAAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'MAULA ZIMATUL ULYA';
        $tahfidzs->alamat = 'DUSUN KRAJAN RT 026 RW 006 DESA MERENG KEC. WARUNGPRING';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2007-05-31';
        $tahfidzs->nama_ayah = 'NURIDIN';
        $tahfidzs->nama_ibu = 'SYAFAAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'FATIMAH RO IKHATUZZAHRO';
        $tahfidzs->alamat = 'RT 006 RW 003 DESA LEMBASARI  KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-04-04';
        $tahfidzs->nama_ayah = 'SUHARJO';
        $tahfidzs->nama_ibu = 'SITI KHOFIYAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'NAELATUL HIDAYAH';
        $tahfidzs->alamat = 'KELURAHAN GONDRONG RT 008 RW 004 KEC. CIPONDOH';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-05-27';
        $tahfidzs->nama_ayah = 'ALI SOBIRIN';
        $tahfidzs->nama_ibu = 'SITI MINHAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'AISYA QORIHAFIDZAH';
        $tahfidzs->alamat = 'TR 001 RW 001 TRIDAYASAKTI KEC. TAMBUN SELATAN';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-11-07';
        $tahfidzs->nama_ayah = 'MOCH. KHAFID';
        $tahfidzs->nama_ibu = 'SIRI NURMANIH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'QONITA AZZARIA';
        $tahfidzs->alamat = 'RT 006 RW 003 DESA LEMBASARI KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-12-14';
        $tahfidzs->nama_ayah = 'KARMO';
        $tahfidzs->nama_ibu = 'SITI MASTUROH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'NUR OCTAVIANI';
        $tahfidzs->alamat = 'RT 007 RW 001 DESA KREMAN KEC. WARUREJA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-10-27';
        $tahfidzs->nama_ayah = 'SUJAK';
        $tahfidzs->nama_ibu = 'CHOTIJAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'NAJMI ZAENURANI';
        $tahfidzs->alamat = 'DK. KRAJAN RT 010 RW 002 DESA GANTUNGAN KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-06-18';
        $tahfidzs->nama_ayah = 'ARIF ZAENURANI';
        $tahfidzs->nama_ibu = 'SLAMET SABAROH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'LUTFI HILMA AL IJAD';
        $tahfidzs->alamat = 'RT 006 RW 002 DESA LEMBASARI KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-11-20';
        $tahfidzs->nama_ayah = 'NASIRUN';
        $tahfidzs->nama_ibu = 'SAETUL KHOPIYAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'LULU SYIFA MAULIDA';
        $tahfidzs->alamat = 'RT 001 RW 004 DESA BANTAR BOLANG KEC. BANTAR BOLANG';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-03-06';
        $tahfidzs->nama_ayah = 'SUHADI';
        $tahfidzs->nama_ibu = 'WANISAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ADISTINA ROSADI ';
        $tahfidzs->alamat = 'PERUM ORCHID GREEN PARK BLOK K/9A TANGGERANG';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-09-30';
        $tahfidzs->nama_ayah = 'ROSAD QOMARUDIN';
        $tahfidzs->nama_ibu = 'KHOLIDAH SUCI SAFITRI';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ISNAENI KHORUNNISA';
        $tahfidzs->alamat = 'JL. WIJAYA KUSUMA RT 01 RW 04 DESA BANTAR BOLANG PEMALANG';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-04-06';
        $tahfidzs->nama_ayah = 'SANURI';
        $tahfidzs->nama_ibu = 'SRIYATUN';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'NUR MAULIDA INDRIYANI ';
        $tahfidzs->alamat = 'RT 012 RW 003 DESA LUWIJAWA KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2011-03-03';
        $tahfidzs->nama_ayah = 'SUKHIP ISYANTO';
        $tahfidzs->nama_ibu = 'SITI ROKHANAH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'DINDA LESTARI';
        $tahfidzs->alamat = 'DK. COCOK RT 017 RW 003 DESA LUWIJAWA KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2007-11-26';
        $tahfidzs->nama_ayah = 'SUMARNO';
        $tahfidzs->nama_ibu = 'ITA PURNAMASARI';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ANGGI PUTRI SOLEHA';
        $tahfidzs->alamat = 'DUKUH KRAJAN RT 06 RW 02 JATINEGARA TEGAL';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2013-04-18';
        $tahfidzs->nama_ayah = 'SUNARTO';
        $tahfidzs->nama_ibu = 'SUMAROH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'YURIKO QIARA KURNIAWAN';
        $tahfidzs->alamat = 'DESA JATINEGARA KEC. JATINEGARA KAB. TEGAL';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2012-08-20';
        $tahfidzs->nama_ayah = 'HADI MAS KURNIAWAN';
        $tahfidzs->nama_ibu = 'ALFITRI PRIYATIN';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'ZAETUN FATMAH';
        $tahfidzs->alamat = 'DUKUH COCOK RT 017 RW O3 DESA LUWIJAWA KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-10-04';
        $tahfidzs->nama_ayah = '-';
        $tahfidzs->nama_ibu = 'HERNI SAPUROH';
        $tahfidzs->save();

        $tahfidzs = new Tahfidz();
        $tahfidzs->nama = 'AYU EMILIANA';
        $tahfidzs->alamat = 'DUKUH KRAJAN RT 003 RW 002 DESA LEMBASARI KEC. JATINEGARA';
        $tahfidzs->jenis_kelamin = 'P';
        $tahfidzs->kategori = 'ANAK_PONDOK';
        $tahfidzs->tgl_lahir = '2010-09-13';
        $tahfidzs->nama_ayah = 'AGUS SUSANTO';
        $tahfidzs->nama_ibu = 'WASRIYAH';
        $tahfidzs->save();


        $nama_surat = ['Al-Fatihah', 'Al-Baqarah', 'Al-Imran', 'An-Nisa', 'Al-Maidah', 'Al-Anam', 'Al-Araf', 'Al-Anfal', 'At-Tawbah', 'Yunus'];
        $tahfidzs = Tahfidz::all();
        $users = User::all();
        for ($i = 0; $i < 30; $i++) {
            $tahfidz = $tahfidzs->random();
            $user = $users->random();

            $nilai = new Nilai();
            $nilai->nama_surat = Arr::random($nama_surat);
            $nilai->total_ayat = rand(1, 286);
            $nilai->juz = rand(1, 30);
            $nilai->tahfidz_id = $tahfidz->id;
            $nilai->users_id = $user->id;
            $nilai->status = 1;
            $created_at = Carbon::now()->subMonths(rand(1, 12))->subDays(rand(0, 30))->subHours(rand(0, 24))->subMinutes(rand(0, 60))->subSeconds(rand(0, 60));
            $updated_at = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 24))->subMinutes(rand(0, 60))->subSeconds(rand(0, 60));

            $nilai->created_at = $created_at;
            $nilai->updated_at = $updated_at;
            $nilai->save();
        }
    }
}
