<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $departments = DB::select("SELECT departmentName FROM tblDepartmentOrder ORDER BY order_by ASC");
        $designations = DB::select("SELECT designation FROM tblDesignationOrder ORDER BY numOrder ASC");
        $shifts = DB::select("SELECT shiftName FROM tblShift WHERE ysnActive = 1");

        // Populate the "Reporting To" option selector using active profiles
        $supervisors = DB::select("SELECT User_id, strName FROM tblEmpInfo WHERE ysnactive = 1 ORDER BY strName ASC");

        return view('dashboard', compact('departments', 'designations', 'shifts', 'supervisors'));
    }
}
