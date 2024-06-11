<?php

namespace App\Services;

use App\Models\SchoolSetting;
use App\Models\SessionYear;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class SchoolDataService {

    public function preSettingsSetup($schoolData) {

        $this->createPreSetupRole($schoolData);
        $sessionYear = SessionYear::updateOrCreate([
            'name'      => Carbon::now()->format('Y'),
            'school_id' => $schoolData->id
        ],
            ['default'    => 1,
             'start_date' => Carbon::now()->startOfYear()->format('Y-m-d'),
             'end_date'   => Carbon::now()->endOfYear()->format('Y-m-d'),
            ]);
        // Add School Setting Data
        $schoolSettingData = array(
            [
                'name'      => 'school_name',
                'data'      => $schoolData->name,
                'type'      => 'string',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'school_email',
                'data'      => $schoolData->support_email,
                'type'      => 'string',
                'school_id' => $schoolData->id
            ],
            [
                'name'      => 'school_phone',
                'data'      => $schoolData->support_phone,
                'type'      => 'number',
                'school_id' => $schoolData->id
            ],
            [
                'name'      => 'school_tagline',
                'data'      => $schoolData->tagline,
                'type'      => 'string',
                'school_id' => $schoolData->id
            ],
            [
                'name'      => 'school_address',
                'data'      => $schoolData->address,
                'type'      => 'string',
                'school_id' => $schoolData->id
            ],
            [
                'name'      => 'session_year',
                'data'      => $sessionYear->id,
                'type'      => 'number',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'horizontal_logo',
                'data'      => '',
                'type'      => 'file',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'vertical_logo',
                'data'      => '',
                'type'      => 'file',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'timetable_start_time',
                'data'      => '09:00:00',
                'type'      => 'time',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'timetable_end_time',
                'data'      => '18:00:00',
                'type'      => 'time',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'timetable_duration',
                'data'      => '01:00:00',
                'type'      => 'time',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'auto_renewal_plan',
                'data'      => '1',
                'type'      => 'integer',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'currency_code',
                'data'      => 'INR',
                'type'      => 'string',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'currency_symbol',
                'data'      => '₹',
                'type'      => 'string',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'date_format',
                'data'      => 'd-m-Y',
                'type'      => 'string',
                'school_id' => $schoolData->id,
            ],
            [
                'name'      => 'time_format',
                'data'      => 'h:i A',
                'type'      => 'string',
                'school_id' => $schoolData->id,
            ],

        );
        SchoolSetting::upsert($schoolSettingData, ["name", "school_id"], ["data", "type"]);
    }

    public function createPreSetupRole($school) {
        Role::updateOrCreate(['name' => 'Guardian', 'school_id' => $school->id], ['custom_role' => 0, 'editable' => 0]);
        Role::updateOrCreate(['name' => 'Student', 'school_id' => $school->id], ['custom_role' => 0, 'editable' => 0]);

        //Add Teacher Role
        $teacher_role = Role::updateOrCreate(['name' => 'Teacher', 'school_id' => $school->id, 'custom_role' => 0, 'editable' => 1]);
        $TeacherHasAccessTo = [
            'student-list',
            'timetable-list',
            //            'attendance-list',
            //            'attendance-create',
            //            'attendance-edit',
            //            'attendance-delete',
            'holiday-list',
            'announcement-list',
            'announcement-create',
            'announcement-edit',
            'announcement-delete',
            'assignment-create',
            'assignment-list',
            'assignment-edit',
            'assignment-delete',
            'assignment-submission',
            'lesson-list',
            'lesson-create',
            'lesson-edit',
            'lesson-delete',
            'topic-list',
            'topic-create',
            'topic-edit',
            'topic-delete',
            'class-section-list',
            'online-exam-create',
            'online-exam-list',
            'online-exam-edit',
            'online-exam-delete',
            'online-exam-questions-create',
            'online-exam-questions-list',
            'online-exam-questions-edit',
            'online-exam-questions-delete',
            'online-exam-result-list',
            
            'leave-list',
            'leave-create',
            'leave-edit',
            'leave-delete',
        ];
        $teacher_role->syncPermissions($TeacherHasAccessTo);
    }
}
