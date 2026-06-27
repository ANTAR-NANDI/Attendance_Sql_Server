<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = DB::table('tblEmpInfo')->count();

        $totalDepartments = DB::table('tblDepartmentOrder')->count();

        $totalLeaveTypes = DB::table('tblLeaveType')->count();

        $pendingLeaves = DB::table('tblLeave')
            ->where('status', 'Pending')
            ->count();

        return view('dashboard', compact(
            'totalEmployees',
            'totalDepartments',
            'totalLeaveTypes',
            'pendingLeaves'
        ));
    }
}
