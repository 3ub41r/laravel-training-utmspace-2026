<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncIntake extends Command
{
    protected $signature = 'app:sync-intake';
    protected $description = 'Sync intake data from source to dashboard database';

    public function handle()
    {

        DB::connection('mysql')->table('intakes')->truncate();

        $batchSize = 1000;

        DB::connection('mysql_intake')
            ->table('applications as a')
            ->leftJoin('profiles as p', 'a.profile_id', '=', 'p.id')
            ->leftJoin('marital_statuses as ms', 'p.marital_status_id', '=', 'ms.id')
            ->leftJoin('nationalities as n', 'p.nationality_id', '=', 'n.id')
            ->leftJoin('place_of_births as pob', 'p.place_of_birth_id', '=', 'pob.id')
            ->leftJoin('races as r', 'p.race_id', '=', 'r.id')
            ->leftJoin('religions as rel', 'p.religion_id', '=', 'rel.id')
            ->leftJoin('salary_ranges as sr', 'p.salary_range_id', '=', 'sr.id')
            ->leftJoin('disabilities as dis', 'p.disability_id', '=', 'dis.id')
            ->leftJoin('countries as pcountry', 'p.permanent_country_id', '=', 'pcountry.id')
            ->leftJoin('states as pstate', 'p.permanent_state_id', '=', 'pstate.id')
            ->leftJoin('cities as pcity', 'p.permanent_city_id', '=', 'pcity.id')
            ->leftJoin('countries as ccountry', 'p.correspondence_country_id', '=', 'ccountry.id')
            ->leftJoin('states as cstate', 'p.correspondence_state_id', '=', 'cstate.id')
            ->leftJoin('cities as ccity', 'p.correspondence_city_id', '=', 'ccity.id')
            ->leftJoin('semesters as s', 'a.semester_id', '=', 's.id')
            ->leftJoin('course_offers as offered_co', 'a.offered_course_offer_id', '=', 'offered_co.id')
            ->leftJoin('course_offers as first_co', 'a.first_course_offer_id', '=', 'first_co.id')
            ->leftJoin('courses as cou', 'offered_co.course_id', '=', 'cou.id')
            ->leftJoin('faculties as fac', 'cou.faculty_id', '=', 'fac.id')
            ->leftJoin('course_levels as clv', 'cou.course_level_id', '=', 'clv.id')
            ->leftJoin('actions as act', 'a.action_id', '=', 'act.id')
            ->leftJoin('course_level_entry_groups as cleg', 'a.course_level_entry_group_id', '=', 'cleg.id')
            ->leftJoin('qualifications as q', 'a.qualification_id', '=', 'q.id')
            ->whereNotNull('clv.name')
            ->where('s.year', '>=', '2023')
            ->whereIn('act.slug', [
                'registered',
            ])
            ->select(
                's.name as semester_name',
                's.year as semester_year',
                'p.gender',
                'ms.name as marital_status',
                'r.name as race',
                'rel.name as religion',
                'pstate.name as state',
                'ccountry.name as country',
                'p.household_income',
                'q.id as qualification',
                'act.name as action',
                'cou.name as course',
                'clv.name as course_level',
                'fac.short_name as faculty',
            )
            ->orderBy('s.year', 'ASC')
            ->chunk($batchSize, function ($records) {
                $batch = [];
                $now = now();

                foreach ($records as $record) {
                    $batch[] = [
                        'semester_name' => $record->semester_name,
                        'semester_year' => $record->semester_year,
                        'gender' => $record->gender,
                        'marital_status' => $record->marital_status,
                        'race' => $record->race,
                        'religion' => $record->religion,
                        'state' => $record->state,
                        'country' => $record->country,
                        'household_income' => $record->household_income,
                        'qualification' => $record->qualification,
                        'action' => $record->action,
                        'course' => $record->course,
                        'course_level' => $record->course_level,
                        'faculty' => $record->faculty,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                DB::connection('mysql')->table('intakes')->insert($batch);

                $this->info("Inserted batch of " . count($batch) . " records.");
            });

        $this->info('Sync completed!');
    }
}
