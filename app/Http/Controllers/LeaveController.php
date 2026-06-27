<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('tblLeave as l')
            ->join('tblEmpInfo as e', 'e.id', '=', 'l.empID')
            ->join('tblLeaveType as lt', 'lt.id', '=', 'l.leave_type_id')
            ->select('l.*', 'e.strName', 'lt.name');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('e.strName', 'like', '%' . $request->search . '%')
                    ->orWhere('l.empID', 'like', '%' . $request->search . '%');
            });
        }
        $leaves = $query->orderByDesc('l.leave_from')->paginate(10);
        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        $employees = DB::table('tblEmpInfo')->where('ysnactive', 1)->orderBy('strName')->get();
        $leaveTypes = DB::table('tblLeaveType')->orderBy('id')->get();

        return view('leaves.create', compact('employees', 'leaveTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empID'         => 'required|exists:tblEmpInfo,id',
            'leave_type_id' => 'required|exists:tblLeaveType,id',
            'leave_from'    => 'required|date',
            'leave_to'      => 'required|date|after_or_equal:leave_from',
            'reason'        => 'nullable|string',
        ]);

        $employee = DB::table('tblEmpInfo')
            ->where('id', $validated['empID'])
            ->first();

        $totalDays = Carbon::parse($validated['leave_from'])
            ->diffInDays(Carbon::parse($validated['leave_to'])) + 1;

        DB::table('tblLeave')->insert([
            'empID'         => $employee->id,
            'empType'       => $employee->EmpType ?? null,
            'leave_type_id' => $validated['leave_type_id'],
            'leave_from'    => $validated['leave_from'],
            'leave_to'      => $validated['leave_to'],
            'total_days'    => $totalDays,
            'reason'        => $validated['reason'],
            'status'        => 'Pending',
            'approved_by'   => null,
            'approved_at'   => null,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave application submitted successfully.');
    }

    public function edit($id)
    {
        $leave = DB::table('tblLeave')->where('id', $id)->first();
        abort_if(!$leave, 404);

        $employees = DB::table('tblEmpInfo')->where('ysnactive', 1)->orderBy('strName')->get();
        $leaveTypes = DB::table('tblLeaveType')->orderBy('id')->get();

        return view('leaves.edit', compact('leave', 'employees', 'leaveTypes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'empID'         => 'required|exists:tblEmpInfo,User_id',
            'empType'       => 'nullable|string|max:50',
            'leave_type_id' => 'required|exists:tblLeaveType,id',
            'leave_from'    => 'required|date',
            'leave_to'      => 'required|date|after_or_equal:leave_from',
            'total_days'    => 'required|integer|min:1',
            'reason'        => 'nullable|string',
            'status'        => 'required|in:Pending,Approved,Rejected',
            'approved_by'   => 'nullable|string',
        ]);

        $leave = DB::table('tblLeave')->where('id', $id)->first();
        abort_if(!$leave, 404);

        DB::table('tblLeave')->where('id', $id)->update([
            'empID'         => $validated['empID'],
            'empType'       => $validated['empType'],
            'leave_type_id' => $validated['leave_type_id'],
            'leave_from'    => $validated['leave_from'],
            'leave_to'      => $validated['leave_to'],
            'total_days'    => $validated['total_days'],
            'reason'        => $validated['reason'],
            'status'        => $validated['status'],
            'approved_by'   => $validated['status'] !== 'Pending'
                ? ($validated['approved_by'] ?? $leave->approved_by ?? auth()->user()->name ?? null)
                : null,
            'approved_at'   => $validated['status'] !== 'Pending'
                ? ($leave->approved_at ?? Carbon::now())
                : null,
            'updated_at'    => now(),
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave application updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('tblLeave')->where('id', $id)->delete();
        return redirect()->route('leaves.index')->with('success', 'Leave record deleted successfully.');
    }
}
