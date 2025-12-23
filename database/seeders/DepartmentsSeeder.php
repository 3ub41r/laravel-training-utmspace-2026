<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $departments = [
            ['name' => 'BAHAGIAN TEKNOLOGI DIGITAL', 'code' => 'BTED'],
            ['name' => 'PEJABAT PEMBELAJARAN SEPANJANG HAYAT', 'code' => 'PPSH'],
            ['name' => 'BAHAGIAN HAL EHWAL ANTARABANGSA', 'code' => 'BHEA'],
            ['name' => 'BAHAGIAN REKRUTMEN DAN PENGAMBILAN PELAJAR', 'code' => 'SRAD'],
            ['name' => 'BAHAGIAN PENGURUSAN KUALITI DAN RISIKO', 'code' => 'BPKR'],
            ['name' => 'BAHAGIAN PEMASARAN DAN PERHUBUNGAN PELANGGAN', 'code' => 'BPPP'],
            ['name' => 'BAHAGIAN KEWANGAN', 'code' => 'BKW'],
            ['name' => 'PUSAT PENGAJIAN IJAZAH DAN ASASI', 'code' => 'PPI'],
            ['name' => 'PUSAT PENGAJIAN SEPARUH MASA', 'code' => 'PPSM'],
            ['name' => 'PUSAT PENDIDIKAN DAN LATIHAN TEKNIKAL DAN VOKASIONAL TERMAJU NASIONAL', 'code' => 'A-TVET'],
            ['name' => 'BAHAGIAN PENGURUSAN AKADEMIK', 'code' => 'BPA'],
            ['name' => 'BAHAGIAN HAL EHWAL PELAJAR DAN ALUMNI', 'code' => 'BHEPA'],
            ['name' => 'BAHAGIAN ASET DAN FASILITI', 'code' => 'BAF'],
            ['name' => 'PUSAT PENGAJIAN DIPLOMA', 'code' => 'PPD'],
            ['name' => 'BAHAGIAN PENTADBIRAN', 'code' => 'BP'],
            ['name' => 'PUSAT PENDIDIKAN PROFESIONAL BERTERUSAN', 'code' => 'PPPB'],
            ['name' => 'PEJABAT PEMBANGUNAN / TIMBALAN PENGERUSI (PEMBANGUNAN) SPACE UTM', 'code' => 'PP'],
            ['name' => 'PEJABAT HAL EHWAL AKADEMIK / TIMBALAN PENGERUSI (AKADEMIK) SPACE UTM', 'code' => 'PHEA'],
            ['name' => 'PEJABAT DEKAN (SPACE UTM)', 'code' => 'P. DEKAN'],
            ['name' => 'BAHAGIAN UNDANG-UNDANG DAN INTEGRITI', 'code' => 'BUI'],
            ['name' => 'PEJABAT KETUA PEGAWAI EKSEKUTIF', 'code' => 'PCEO'],
            ['name' => 'PUSAT PROGRAM EKSEKUTIF', 'code' => 'PPE'],
            ['name' => 'UNIT PENTADBIRAN DAN PENGURUSAN FASILITI (KL)', 'code' => 'UPPF (KL)'],
            ['name' => 'PUSAT PROGRAM KERJASAMA', 'code' => 'PPK'],
            ['name' => 'UNIT PENGURUSAN MODAL INSAN (KL)', 'code' => 'UPMI(KL)'],
            ['name' => 'BAHAGIAN PENGURUSAN SUMBER MANUSIA', 'code' => 'HRM'],
            ['name' => 'BAHAGIAN PENGURUSAN DAN PEMBANGUNAN SUMBER MANUSIA', 'code' => 'BPPSM'],
            ['name' => 'BAHAGIAN PENGURUSAN PENYELIDIKAN DAN SUMBER PEMBELAJARAN', 'code' => 'BPSP'],
            ['name' => 'UTMSPACE SERVICES SDN BHD', 'code' => 'USSB'],
            ['name' => 'PEJABAT PEMBANGUNAN BISNES', 'code' => 'PPB'],
            ['name' => 'PEJABAT OPERASI DAN SUMBER MANUSIA', 'code' => 'POSM'],
            ['name' => 'BAHAGIAN KOMUNIKASI KORPORAT', 'code' => 'BKK'],
        ];

        $departments = array_map(function ($department) use ($now) {
            return array_merge($department, [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }, $departments);

        DB::table('departments')->insert($departments);
    }
}
