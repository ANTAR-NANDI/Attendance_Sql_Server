<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EmployeeMasterController extends Controller
{
    /**
     * Render the unified setup workspace view.
     */
    public function index()
    {
        // Query live SQL Server lookup datasets for dropdown menus
        $shifts = DB::select("SELECT autoID, ShiftName FROM tblShift");
        $departments = DB::select("SELECT DeptID, DeptName FROM tblDepartmentOrder ORDER BY SortOrder ASC");
        $designations = DB::select("SELECT DesigID, DesigName FROM tblDesignationOrder ORDER BY SortOrder ASC");

        // Fetch supervisors for the "Reporting To" selection
        $supervisors = DB::select("SELECT User_id, Name FROM tblEmpInfo WHERE IsActive = 1");

        return view('employees.setup', compact('shifts', 'departments', 'designations', 'supervisors'));
    }

    /**
     * Fetch a specific employee record via AJAX for editing or viewing.
     */
    public function show($id)
    {
        // Use your legacy primary identity key matching your database structure (e.g., User_id)
        $employee = DB::selectOne("SELECT * FROM tblEmpInfo WHERE User_id = ?", [$id]);

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee record not found.'], 404);
        }

        return response()->json(['success' => true, 'data' => $employee]);
    }

    /**
     * Store a new employee record (Natively mimicking the "Save" desktop button).
     */
    public function store(Request $request)
    {
        try {
            // Check for existing User ID to mirror legacy database constraints
            $exists = DB::selectOne("SELECT User_id FROM tblEmpInfo WHERE User_id = ?", [$request->user_id]);
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'User ID already exists in the system.']);
            }

            // Handle optional image parsing and store path reference
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('employees', 'public');
            }

            // Direct INSERT execution targeting your legacy table architecture
            DB::insert("INSERT INTO tblEmpInfo 
                (User_id, FC_id, Name, DeptID, DesigID, JoinDate, Religion, BloodGroup, Gender, IsAdmin, ShiftID, ReportingTo, IsActive, InActiveReason, PhotoPath) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                $request->user_id,
                $request->fc_id,
                $request->name,
                $request->department_id,
                $request->designation_id,
                $request->join_date,
                $request->religion,
                $request->blood_group,
                $request->gender,
                $request->is_admin,
                $request->shift_id,
                $request->reporting_to,
                1,
                null,
                $photoPath
            ]);

            return response()->json(['success' => true, 'message' => 'Employee profile successfully saved to SQL Server.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Database Exception: ' . $e->getMessage()]);
        }
    }

    /**
     * Update an existing employee record (Mimicking the "Edit" save state).
     */
    public function update(Request $request, $id)
    {
        try {
            $photoPath = $request->existing_photo_path;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('employees', 'public');
            }

            DB::update("UPDATE tblEmpInfo SET 
                FC_id = ?, Name = ?, DeptID = ?, DesigID = ?, JoinDate = ?, Religion = ?, 
                BloodGroup = ?, Gender = ?, IsAdmin = ?, ShiftID = ?, ReportingTo = ?, 
                IsActive = ?, InActiveReason = ?, PhotoPath = ? 
                WHERE User_id = ?", [
                $request->fc_id,
                $request->name,
                $request->department_id,
                $request->designation_id,
                $request->join_date,
                $request->religion,
                $request->blood_group,
                $request->gender,
                $request->is_admin,
                $request->shift_id,
                $request->reporting_to,
                $request->status == 'Active' ? 1 : 0,
                $request->inactive_reason,
                $photoPath,
                $id
            ]);

            return response()->json(['success' => true, 'message' => 'Employee profile successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Database Update Exception: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete an employee record (Mimicking the "Delete" desktop button action).
     */
    public function destroy($id)
    {
        try {
            DB::delete("DELETE FROM tblEmpInfo WHERE User_id = ?", [$id]);
            return response()->json(['success' => true, 'message' => 'Employee record removed from the master registry.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'The record cannot be deleted due to existing attendance log references. Consider setting the status to Inactive instead.']);
        }
    }
}
