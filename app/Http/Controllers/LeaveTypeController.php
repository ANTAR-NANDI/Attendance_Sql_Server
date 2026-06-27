<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leave_types = DB::table('tblLeaveType')
            ->select(
                'tblLeaveType.*'
            )
            ->orderBy('tblLeaveType.id', 'DESC')
            ->paginate(10);

        return view('leave_types.index', compact('leave_types'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('leave_types.create');
    }

    /**
     * Store Employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'LeaveName' => 'required',
        ]);

        try {
            DB::table('tblLeaveType')->insert([
                'name' => $request->LeaveName,
                'days' => $request->AllowedDays,
                'IsPaid' => $request->IsPaid,
                'Remarks' => $request->Remarks
            ]);

            return redirect()
                ->route('leave_types.index')
                ->with('success', 'Leave Type Added Successfully');
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
        $leave_type = DB::table('tblLeaveType')
            ->where('id', $id)
            ->first();

        if (!$leave_type) {
            abort(404);
        }
        return view('leave_types.edit', compact(
            'leave_type'
        ));
    }

    /**
     * Update Employee
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'LeaveName' => 'required'
        ]);

        try {

            $leave_type = DB::table('tblLeaveType')
                ->where('id', $id)
                ->first();

            if (!$leave_type) {
                return back()->with('error', 'Leave Type not found');
            }



            DB::table('tblLeaveType')
                ->where('id', $id)
                ->update([
                    'name' => $request->LeaveName,
                    'days' => $request->AllowedDays,
                    'IsPaid' => $request->IsPaid,
                    'Remarks' => $request->Remarks
                ]);

            return redirect()
                ->route('leave_types.index')
                ->with('success', 'Designation Updated Successfully');
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

            DB::table('tblLeaveType')
                ->where('id', $id)
                ->delete();

            return redirect()
                ->route('leave_types.index')
                ->with('success', 'Designation Deleted Successfully');
        } catch (Exception $e) {

            return redirect()
                ->route('leave_types.index')
                ->with('error', 'Unable to delete Designation.');
        }
    }
}
