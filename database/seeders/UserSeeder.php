<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Check if the user already exists to prevent duplicate insertion issues in SQL Server
        if (!User::where('email', 'admin@hrm.com')->exists()) {
            User::create([
                'name' => 'System Administrator',
                'email' => 'admin@hrm.com',
                'password' => Hash::make('@#$%^&'), // Change this in production!

            ]);
        }
        $shifts = [
            // Evening Shifts (E Prefix)
            ['shiftName' => 'E-1', 'startTime' => '13:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '12:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'E-2', 'startTime' => '14:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '12:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'E-3', 'startTime' => '15:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '13:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'E-4', 'startTime' => '16:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '14:00:00', 'dayhour' => 12.00],

            // Morning Shifts (M Prefix)
            ['shiftName' => 'M-1', 'startTime' => '06:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '05:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'M-2', 'startTime' => '07:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '05:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'M-3', 'startTime' => '08:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '05:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'M-4', 'startTime' => '09:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '08:20:00', 'dayhour' => 12.00],
            ['shiftName' => 'M-5', 'startTime' => '10:00:00', 'workinghour' => 540.00, 'ysnActive' => 1, 'daystart' => '05:00:00', 'dayhour' => 12.00],

            // Night Shifts (N Prefix)
            ['shiftName' => 'N-1', 'startTime' => '22:00:00', 'workinghour' => 480.00, 'ysnActive' => 1, 'daystart' => '20:00:00', 'dayhour' => 12.00],
            ['shiftName' => 'N-2', 'startTime' => '23:00:00', 'workinghour' => 480.00, 'ysnActive' => 1, 'daystart' => '20:00:00', 'dayhour' => 12.00],
        ];

        foreach ($shifts as $shift) {
            DB::table('tblShift')->updateOrInsert(
                ['shiftName' => $shift['shiftName']],
                $shift
            );
        }

        // 2. Seed Clean Departments Data into tblDepartmentOrder
        $departments = [
            ['departmentName' => 'Human Resources', 'order_by' => 1],
            ['departmentName' => 'Information Technology', 'order_by' => 2],
            ['departmentName' => 'Production Department', 'order_by' => 3],
            ['departmentName' => 'Finance & Accounts', 'order_by' => 4],
        ];
        foreach ($departments as $dept) {
            DB::table('tblDepartmentOrder')->updateOrInsert(['departmentName' => $dept['departmentName']], $dept);
        }

        // 3. Seed Clean Designations Data into tblDeignationOrder
        $designations = [
            ['designation' => 'Software Engineer', 'numOrder' => 1],
            ['designation' => 'HR Officer', 'numOrder' => 2],
            ['designation' => 'Floor Supervisor', 'numOrder' => 3],
            ['designation' => 'Accountant', 'numOrder' => 4],
        ];
        foreach ($designations as $desig) {
            DB::table('tblDesignationOrder')->updateOrInsert(['designation' => $desig['designation']], $desig);
        }

        // 4. Seed Dynamic Interlinked Employee Testing Records into tblEmpInfo using valid Shifts from above
        $employees = [
            [
                'User_id' => '10001',
                'card_number' => 'CARD-8812',
                'strName' => 'Justin Mason',
                'strdepartment' => '1',
                'strdesignation' => '1',
                'ysnactive' => 1,
                'RelioGion' => 'Christianity',
                'bloodGroup' => 'O+',
                'Gender' => 'Male',
                'ysnAdmin' => 1,
                'shiftName' => '1', // Mapped cleanly to M-3 Morning Shift
                'orderNumber' => 1,
                'ysnRoster' => 0,
                'cmpID' => 1,
                'entryBy' => 'sa',
                'entryDate' => now(),
                'reporting_boss' => '1',
                'email' => 'justin.mason@corporate.com',
                'mobile_no' => '+15550192',
                'join_Date' => '2024-01-15'
            ],
            [
                'User_id' => '10002',
                'card_number' => 'CARD-4421',
                'strName' => 'Anika Rahman',
                'strdepartment' => '2',
                'strdesignation' => '2',
                'ysnactive' => 1,
                'RelioGion' => 'Islam',
                'bloodGroup' => 'A+',
                'Gender' => 'Female',
                'ysnAdmin' => 0,
                'shiftName' => '2', // Mapped cleanly to M-4 Morning Shift
                'orderNumber' => 2,
                'ysnRoster' => 0,
                'cmpID' => 1,
                'entryBy' => 'sa',
                'entryDate' => now(),
                'reporting_boss' => '2',
                'email' => 'anika.rahman@corporate.com',
                'mobile_no' => '+15550193',
                'join_Date' => '2025-03-01'
            ]
        ];

        foreach ($employees as $emp) {
            DB::table('tblEmpInfo')->updateOrInsert(['User_id' => $emp['User_id']], $emp);
        }
    }
}
