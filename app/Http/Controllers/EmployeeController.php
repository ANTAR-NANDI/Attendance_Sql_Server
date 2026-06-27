<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display Employee List
     */
    public function index()
    {
        $employees = DB::table('tblEmpInfo as e')
            ->leftJoin('tblDepartmentOrder as d', 'e.strdepartment', '=', 'd.id')
            ->leftJoin('tblDesignationOrder as des', 'e.strdesignation', '=', 'des.id')
            ->leftJoin('tblShift as s', 'e.shiftName', '=', 's.id')
            ->leftJoin('tblEmpInfo as boss', 'e.reporting_boss', '=', 'boss.id')
            ->select(
                'e.*',
                'd.departmentName',
                'des.designation',
                's.shiftName',
                'boss.strName as reportingBoss'
            )
            ->orderBy('e.id', 'DESC')
            ->paginate(20);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        $departments = DB::table('tblDepartmentOrder')
            ->orderBy('order_by')
            ->get();

        $designations = DB::table('tblDesignationOrder')
            ->orderBy('numOrder')
            ->get();

        $shifts = DB::table('tblShift')
            ->where('ysnActive', 1)
            ->orderBy('shiftName')
            ->get();

        $supervisors = DB::table('tblEmpInfo')
            ->where('ysnactive', 1)
            ->orderBy('strName')
            ->get();

        return view('employees.create', compact(
            'departments',
            'designations',
            'shifts',
            'supervisors'
        ));
    }

    /**
     * Store Employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'User_id' => 'required|unique:tblEmpInfo,User_id',
            'strName' => 'required',
            'strdepartment' => 'required',
            'strdesignation' => 'required',
        ]);

        try {

            $photo = null;

            if ($request->hasFile('image_file')) {
                $photo = 'data:' . $request->image_file->getMimeType() . ';base64,' . base64_encode(file_get_contents($request->image_file));
            }

            DB::table('tblEmpInfo')->insert([

                'User_id' => $request->User_id,
                'card_number' => $request->card_number,
                'strName' => $request->strName,
                'strdepartment' => $request->strdepartment,
                'strdesignation' => $request->strdesignation,
                'join_Date' => $request->join_Date,
                'RelioGion' => $request->RelioGion,
                'bloodGroup' => $request->bloodGroup,
                'Gender' => $request->Gender,
                'ysnAdmin' => $request->ysnAdmin ?? 0,
                'shiftName' => $request->shiftName,
                'reporting_boss' => $request->reporting_boss,
                'empType' => $request->empType,
                'workStation' => $request->workStation,
                'ysnactive' => $request->ysnactive ?? 1,
                'inactiveReason' => $request->inactiveReason,
                'image' => $photo,
                'entryDate' => now(),
            ]);

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee Added Successfully');
        } catch (Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show Edit Form
     */
    public function edit($id)
    {
        $employee = DB::table('tblEmpInfo')
            ->where('id', $id)
            ->first();

        if (!$employee) {
            abort(404);
        }

        $departments = DB::table('tblDepartmentOrder')
            ->orderBy('order_by')
            ->get();

        $designations = DB::table('tblDesignationOrder')
            ->orderBy('numOrder')
            ->get();

        $shifts = DB::table('tblShift')
            ->where('ysnActive', 1)
            ->orderBy('shiftName')
            ->get();

        $supervisors = DB::table('tblEmpInfo')
            ->where('ysnactive', 1)
            ->orderBy('strName')
            ->get();

        return view('employees.edit', compact(
            'employee',
            'departments',
            'designations',
            'shifts',
            'supervisors'
        ));
    }

    /**
     * Update Employee
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'strName' => 'required',
            'strdepartment' => 'required',
            'strdesignation' => 'required',
        ]);

        try {

            $employee = DB::table('tblEmpInfo')
                ->where('id', $id)
                ->first();

            if (!$employee) {
                return back()->with('error', 'Employee not found');
            }

            $photo = $employee->image;

            if ($request->hasFile('image_file')) {
                $photo = 'data:' . $request->image_file->getMimeType() . ';base64,' . base64_encode(file_get_contents($request->image_file));
            }

            DB::table('tblEmpInfo')
                ->where('User_id', $id)
                ->update([

                    'card_number' => $request->card_number,
                    'strName' => $request->strName,
                    'strdepartment' => $request->strdepartment,
                    'strdesignation' => $request->strdesignation,
                    'join_Date' => $request->join_Date,
                    'RelioGion' => $request->RelioGion,
                    'bloodGroup' => $request->bloodGroup,
                    'Gender' => $request->Gender,
                    'ysnAdmin' => $request->ysnAdmin ?? 0,
                    'shiftName' => $request->shiftName,
                    'reporting_boss' => $request->reporting_boss,
                    'empType' => $request->empType,
                    'workStation' => $request->workStation,
                    'ysnactive' => $request->ysnactive,
                    'inactiveReason' => $request->inactiveReason,
                    'image' => $photo,
                    'ModifyDate' => now(),

                ]);

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee Updated Successfully');
        } catch (Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Delete Employee
     */
    public function destroy($id)
    {
        try {

            DB::table('tblEmpInfo')
                ->where('User_id', $id)
                ->delete();

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee Deleted Successfully');
        } catch (Exception $e) {

            return redirect()
                ->route('employees.index')
                ->with('error', 'Unable to delete employee.');
        }
    }
}
