<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'AZRI BIN ABDUL HAMID', 'employee_no' => 'PS0939', 'email' => 'azrihamid@utmspace.edu.my', 'position' => 'EKSEKUTIF (E10)'],
            ['name' => 'NOR AZLIANA BINTI RAMALI', 'employee_no' => 'PS0065', 'email' => 'azliana@utmspace.edu.my', 'position' => 'EKSEKUTIF KANAN (E8)'],
            ['name' => 'MOHD IZWAN BIN SALLEH', 'employee_no' => 'PS0066', 'email' => 'izwan@utmspace.edu.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'NOOR AZIDAH BINTI AHMAD', 'employee_no' => 'PS0011', 'email' => 'azidah@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'ZULKIFLI BIN OSMAN', 'employee_no' => 'PS0012', 'email' => 'zulkifli@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'NURUL AIN BINTI AHMAD LUTFI', 'employee_no' => 'PS0015', 'email' => 'nurulain@utmspace.edu.my', 'position' => 'PENOLONG PENGURUS (E6)'],
            ['name' => 'KARTIKA ISTA BINTI MOHAMED SHAH', 'employee_no' => 'PS0018', 'email' => 'kartika@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'ROSNIZAM BIN MAAROF', 'employee_no' => 'PS0019', 'email' => 'rosnizam@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'AZREENA BINTI ZAINAL ABIDIN', 'employee_no' => 'PS0022', 'email' => 'azreena@utmspace.edu.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'NORULHUDA BINTI ZAKARIA', 'employee_no' => 'PS0048', 'email' => 'norulhuda@utmspace.edu.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'NORIMALIZA BINTI MAMAT', 'employee_no' => 'PS0050', 'email' => 'norimaliza@utmspace.edu.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'NURUL \'IZZATI BINTI MOHD HASHIM', 'employee_no' => 'PS0080', 'email' => 'izzati@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'MOHD ZAINI BIN AZIZAN', 'employee_no' => 'PS0084', 'email' => 'zaini@utmspace.edu.my', 'position' => 'PENGURUS (E3)'],
            ['name' => 'SUHAILI BINTI MAZLAN HUZAIRI', 'employee_no' => 'PS0017', 'email' => 'suhaili@utmspace.edu.my', 'position' => 'PENGURUS KANAN (E1)'],
            ['name' => 'MOHD NOOR FAIROS BIN MOHD NAWAWI', 'employee_no' => 'PS0071', 'email' => 'fairos@utmspace.edu.my', 'position' => 'PENGURUS (E3)'],
            ['name' => 'NUR HAKIMI BINTI KARSONO', 'employee_no' => 'PS0164', 'email' => 'nurhakimi@ic.utm.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'RUZANA BINTI ISHAK', 'employee_no' => 'PS0469', 'email' => 'ruzana@ic.utm.my', 'position' => 'TIMBALAN PENGARAH'],
            ['name' => 'NUR FATIN NABILAH BINTI AHMAD FAUZI', 'employee_no' => 'PS0744', 'email' => 'nurfatin@utmspace.edu.my', 'position' => 'PENGURUS (E3)'],
            ['name' => 'ARBA\'IAH BINTI INN', 'employee_no' => 'KJ0009', 'email' => 'arbaiah@ic.utm.my', 'position' => 'PENGURUS AKADEMIK PROGRAM LUAR'],
            ['name' => 'TS. NIK MARIA BINTI NIK MAHAMOOD', 'employee_no' => 'PS0562', 'email' => 'nik.maria@utmspace.edu.my', 'position' => 'PENGARAH & TIMBALAN DEKAN SPACE UTM'],
            ['name' => 'ASHRAF BIN ZAINAL MOKHTAR', 'employee_no' => 'PS0629', 'email' => 'ashraf@utmspace.edu.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'DR. SITI MUNIRA BINTI JAMIL', 'employee_no' => 'PS0726', 'email' => 'sitimunira@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'ZAREENA BINTI OMAR', 'employee_no' => 'PS0768', 'email' => 'zareena@utmspace.edu.my', 'position' => 'PENGARAH'],
            ['name' => 'SITI KHATIJAH BINTI HAMZAH', 'employee_no' => 'PS0773', 'email' => 'khatijah@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'PROF. DR NAZRI BIN ALI', 'employee_no' => 'PS0798', 'email' => 'nazriali@utmspace.edu.my', 'position' => 'KETUA PEGAWAI EKSEKUTIF DAN PENGARAH URUSAN / PENGERUSI SPACE UTM (M1)'],
            ['name' => 'TS. NORHASLINDA BINTI HARUN', 'employee_no' => 'PS0805', 'email' => 'norhaslindaharun@utmspace.edu.my', 'position' => 'PENGURUS BESAR'],
            ['name' => 'PROF. MADYA DR. YUSRI BIN KAMIN', 'employee_no' => 'PS0918', 'email' => 'yusri@utmspace.edu.my', 'position' => 'PENGARAH'],
            ['name' => 'PROF. DR. MOHD SHAHRIZAL BIN SUNAR', 'employee_no' => 'PS0945', 'email' => 'shahrizal@utmspace.edu.my', 'position' => 'DEKAN'],
            ['name' => 'PROF. MADYA DR. KAMALUDIN BIN MOHAMAD YUSOF', 'employee_no' => 'PS0951', 'email' => 'kamalmy@utmspace.edu.my', 'position' => 'PENGARAH & TIMBALAN DEKAN SPACE UTM'],
            ['name' => 'IDHAM BIN MIAN', 'employee_no' => 'PS0952', 'email' => 'idhammian@utmspace.edu.my', 'position' => 'PENGURUS (E2)'],
            ['name' => 'FAIZUL AZLI BIN ABDUL RIDZAB @ HASSAN', 'employee_no' => 'PS0981', 'email' => 'faizul.kl@utm.my', 'position' => 'PENGURUS BESAR'],
        ];


        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'name'            => $user['name'],
                    'employee_no'     => $user['employee_no'],
                    'position'        => $user['position'],
                    'role_id'         => 3,
                    'department_id'   => 1,
                    'password'        => Hash::make('password'),
                    'active'          => true,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]
            );
        }
    }
}
