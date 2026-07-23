<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusPelajarController extends Controller
{
    public function index(Request $request)
    {
        $selectedSemester = $request->input('semester');
        $selectedCourse = $request->input('course');

        $courses = $this->getPrograms();

        $semesters = $this->getSemesters();

        $stats = DB::connection('sqlsrv')
            ->select("select c.sesName + ' '  + CAST(c.semNo as varchar)kemasukan,  
            d.courseCode, c.sesSemNo, b.status, count(*) jumlah
            from main a
            join stu b on b.sturef = a.sturef
            join SesSem c on c.sessemno = b.courseSesSemNo
            join course d on d.coursecode = b.courseCode
            where b.courseSesSemNo = ? and b.courseCode = ?
            group by sesname, semno, c.sesSemNo, d.courseCode, b.status", [$selectedSemester, trim($selectedCourse)]);

        $registered = sizeof($stats);

        return view('status-pelajar', compact('stats', 'courses', 'semesters', 'registered', 'selectedCourse', 'selectedSemester'));
    }

    protected function getPrograms()
    {
        return DB::connection('sqlsrv')
            ->select("
                select *
                from Course a
                where exists (
                    select *
                    from Stu
                    where courseCode = a.courseCode
                )
                order by a.courseCode
            ");
    }

    protected function getSemesters()
    {
        return DB::connection('sqlsrv')
            ->select("
                select *
                from SesSem a
                where exists (
                    select *
                    from Stu
                    where courseSesSemNo = a.sesSemNo
                )
                order by sesName desc, semNo
            ");
    }
}
