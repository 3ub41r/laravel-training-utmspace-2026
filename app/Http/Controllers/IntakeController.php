<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Intake;


class IntakeController extends Controller
{

    public function getSemesters(Request $request)
    {
        $courseLevel = $request->query('courseLevel');

        $semestersQuery = Intake::select('semester_name')
            ->distinct()
            ->orderBy('semester_name', 'desc');

        if ($courseLevel) {
            if ($courseLevel === 'NULL') {
                $semestersQuery->whereNull('course_level');
            } else {
                $semestersQuery->where('course_level', $courseLevel);
            }
        }

        $semesters = $semestersQuery->pluck('semester_name');

        return response()->json($semesters);
    }

    public function tinjauanAkademik()
    {
        return view('tinjauan-akademik');
    }

    // public function ringkasanEksekutif(Request $request)
    // {
    //     $from = 2023;
    //     $to = 2025;

    //     // Fetch grouped data from DB
    //     $kemasukanPelajars = Intake::query()
    //     ->whereBetween('semester_year', [$from, $to])
    //     ->whereNotNull('semester_year')   // semester_year tidak null
    //     ->whereNotNull('course_level')    // course_level tidak null
    //     ->select('semester_year', 'course_level', DB::raw('COUNT(*) as total'))
    //     ->groupBy('semester_year', 'course_level')
    //     ->get();


    //     // Get unique years and course levels
    //     $years = $kemasukanPelajars->pluck('semester_year')->unique();
    //     $courseLevels = $kemasukanPelajars->pluck('course_level')->unique();

    //     // Build data array for Google Charts
    //     $dataArray = [];
    //     $header = array_merge(['Year'], $courseLevels->toArray());
    //     $dataArray[] = $header;

    //     foreach ($years as $year) {
    //         $row = [$year];
    //         foreach ($courseLevels as $level) {
    //             $total = $kemasukanPelajars->firstWhere(function ($item) use ($year, $level) {
    //                 return $item->semester_year == $year && $item->course_level == $level;
    //             });
    //             $row[] = $total ? (int)$total->total : 0;
    //         }
    //         $dataArray[] = $row;
    //     }

    //     return view('ringkasan-eksekutif', compact('dataArray'));
    // }




    public function kemasukanPelajar(Request $request)
    {
        $semesterName = $request->input('semesterName');
        $courseLevel = $request->input('courseLevel');

        $semesters = Intake::select('semester_name')->distinct()->orderBy('semester_name', 'desc')->pluck('semester_name');
        $courseLevels = Intake::select('course_level')->distinct()->orderBy('course_level', 'asc')->pluck('course_level');

        $query = Intake::query()
            ->when($semesterName, fn($q) => $q->where('semester_name', $semesterName))
            ->when($courseLevel, fn($q) => $q->where('course_level', $courseLevel));

        $actionCounts = (clone $query)
            ->select('action', DB::raw('COUNT(*) as total'))
            ->groupBy('action')
            ->pluck('total', 'action');

        $registered = $actionCounts->get('Registered', 0);

        $qualifications = (clone $query)
            ->select('qualification', DB::raw('COUNT(*) as total'))
            ->groupBy('qualification')
            ->pluck('total', 'qualification');

        $genders = (clone $query)
            ->select('gender', DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender');

        $courses = (clone $query)
            ->selectRaw("COALESCE(course, 'Tiada Data') as course")
            ->selectRaw('COUNT(id) as total')
            ->groupBy('course')
            ->pluck('total', 'course')
            ->sortKeys();

        $faculties = (clone $query)
            ->select('faculty', DB::raw('COUNT(*) as total'))
            ->groupBy('faculty')
            ->pluck('total', 'faculty')
            ->sortKeys();

        $faculties = (clone $query)
            ->select('faculty', DB::raw('COUNT(*) as total'))
            ->groupBy('faculty')
            ->pluck('total', 'faculty')
            ->sortKeys();

        $countries = (clone $query)
            ->select(DB::raw('COALESCE(country, "Tiada Data") as country'), DB::raw('COUNT(*) as total'))
            ->groupBy('country')
            ->pluck('total', 'country')
            ->sortKeys();

        $maritalStatuses = (clone $query)
            ->select('marital_status', DB::raw('COUNT(*) as total'))
            ->groupBy('marital_status')
            ->pluck('total', 'marital_status')
            ->sortKeys();


        return view('kemasukan-pelajar', compact(
            'registered',
            'semesterName',
            'qualifications',
            'semesters',
            'courseLevels',
            'courseLevel',
            'courses',
            'faculties',
            'countries',
            'genders',
            'maritalStatuses'
        ));
    }
}
