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
            ->orderBy('id', 'ASC')
            ->paginate(3);
        // Query live configuration structures using your exact SSMS columns
        $departments = DB::select("SELECT departmentName FROM tblDepartmentOrder ORDER BY order_by ASC");
        $designations = DB::select("SELECT designation FROM tblDesignationOrder ORDER BY numOrder ASC");
        $shifts = DB::select("SELECT shiftName FROM tblShift WHERE ysnActive = 1");

        // Populate the "Reporting To" option selector using active profiles
        $supervisors = DB::select("SELECT User_id, strName FROM tblEmpInfo WHERE ysnactive = 1 ORDER BY strName ASC");

        return view('employees.setup', compact('employees', 'departments', 'designations', 'shifts', 'supervisors'));
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

            return response()->json(['success' => true, 'message' => 'Employee profile successfully saved to database.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Insertion Exception: ' . $e->getMessage()]);
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

            return response()->json(['success' => true, 'message' => 'Employee profile successfully updated.']);
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
