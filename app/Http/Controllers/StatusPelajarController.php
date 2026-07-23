<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusPelajarController extends Controller
{
    public function index()
    {
        $courses = $this->getPrograms();

        $stats = DB::connection('sqlsrv')
            ->select("select c.sesName + ' '  + CAST(c.semNo as varchar)kemasukan,  
            d.courseCode, b.status, count(*) jumlah
            from main a
            join stu b on b.sturef = a.sturef
            join SesSem c on c.sessemno = b.courseSesSemNo
            join course d on d.coursecode = b.courseCode
            group by sesname, semno, d.courseCode, b.status");

        return view('status-pelajar', compact('stats', 'courses'));
    }

    protected function getPrograms()
    {
        return DB::connection('sqlsrv')
            ->select("select * from Course a where exists (select * from Stu where courseCode = a.courseCode)");
    }

    protected function getSemesters()
    {
        return DB::connection('sqlsrv')
            ->select("select * from SesSem a where exists (select * from Stu where courseSesSemNo = a.sesSemNo)");
    }
}
