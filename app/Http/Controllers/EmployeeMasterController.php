<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EmployeeMasterController extends Controller
{
    /**
     * Display the main workplace frame containing live lookup variables.
     */
    public function index()
    {
        $employees = DB::table('tblEmpInfo')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('employees.index', compact('employees'));
    }
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
            ->get();

        $supervisors = DB::table('tblEmpInfo')
            ->where('ysnactive', 1)
            ->get();

        return view(
            'employees.create',
            compact(
                'departments',
                'designations',
                'shifts',
                'supervisors'
            )
        );
    }
    public function edit($id)
    {
        $employee = DB::table('tblEmpInfo')
            ->where('User_id', $id)
            ->first();

        $departments = DB::table('tblDepartmentOrder')
            ->orderBy('order_by')
            ->get();

        $designations = DB::table('tblDesignationOrder')
            ->orderBy('numOrder')
            ->get();

        $shifts = DB::table('tblShift')
            ->where('ysnActive', 1)
            ->get();

        $supervisors = DB::table('tblEmpInfo')
            ->where('ysnactive', 1)
            ->get();

        return view(
            'employees.edit',
            compact(
                'employee',
                'departments',
                'designations',
                'shifts',
                'supervisors'
            )
        );
    }

    /**
     * Retrieve an individual employee data profile via AJAX.
     */
    public function show($id)
    {
        $employee = DB::selectOne("SELECT * FROM tblEmpInfo WHERE User_id = ?", [$id]);

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee record not found.'], 404);
        }

        return response()->json(['success' => true, 'data' => $employee]);
    }

    /**
     * Commit a fresh employee record registration step to SQL Server.
     */
    public function store(Request $request)
    {
        try {
            $exists = DB::selectOne("SELECT User_id FROM tblEmpInfo WHERE User_id = ?", [$request->User_id]);
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'User ID matches an existing profile registry entry.']);
            }

            $photoBase64 = null;
            if ($request->hasFile('image_file')) {
                $photoBase64 = 'data:' . $request->file('image_file')->getMimeType() . ';base64,' . base64_encode($request->file('image_file')->get());
            }

            DB::insert("INSERT INTO tblEmpInfo 
                (User_id, card_number, strName, strdepartment, strdesignation, join_Date, RelioGion, bloodGroup, Gender, ysnAdmin, shiftName, reporting_boss, empType, workStation, ysnactive, entryDate, image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, GETDATE(), ?)", [
                $request->User_id,
                $request->card_number,
                $request->strName,
                $request->strdepartment,
                $request->strdesignation,
                $request->join_Date,
                $request->RelioGion,
                $request->bloodGroup,
                $request->Gender,
                $request->ysnAdmin ?? 0,
                $request->shiftName,
                $request->reporting_boss,
                $request->empType,
                $request->workStation,
                $photoBase64
            ]);

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee added successfully');
        } catch (Exception $e) {
            return redirect()
                ->route('employees.index')
                ->with('error', 'Failed to add Employee');
        }
    }

    /**
     * Update an existing employee profile row entry.
     */
    public function update(Request $request, $id)
    {
        try {
            $photoBase64 = $request->existing_image_data;
            if ($request->hasFile('image_file')) {
                $photoBase64 = 'data:' . $request->file('image_file')->getMimeType() . ';base64,' . base64_encode($request->file('image_file')->get());
            }

            DB::update("UPDATE tblEmpInfo SET 
                card_number = ?, strName = ?, strdepartment = ?, strdesignation = ?, join_Date = ?, RelioGion = ?, 
                bloodGroup = ?, Gender = ?, ysnAdmin = ?, shiftName = ?, reporting_boss = ?, 
                empType = ?, workStation = ?, ysnactive = ?, inactiveReason = ?, image = ?, ModifyDate = GETDATE() 
                WHERE User_id = ?", [
                $request->card_number,
                $request->strName,
                $request->strdepartment,
                $request->strdesignation,
                $request->join_Date,
                $request->RelioGion,
                $request->bloodGroup,
                $request->Gender,
                $request->ysnAdmin ?? 0,
                $request->shiftName,
                $request->reporting_boss,
                $request->empType,
                $request->workStation,
                $request->ysnactive,
                $request->inactiveReason,
                $photoBase64,
                $id
            ]);

            return redirect()
                ->route('employees.index')
                ->with('success', 'Employee updated successfully');
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Update Exception: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove an individual entry row from the registry table.
     */
    public function destroy($id)
    {
        try {
            DB::delete("DELETE FROM tblEmpInfo WHERE User_id = ?", [$id]);
            return response()->json(['success' => true, 'message' => 'Employee record removed from system registry.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Purge Conflict: This record is currently linked to log values.']);
        }
    }
}
