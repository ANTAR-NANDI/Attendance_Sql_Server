<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = DB::table('tblShift')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store Employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'shiftName' => 'required',
            'startTime' => 'required',
            'workinghour' => 'required'
        ]);

        try {
            DB::table('tblShift')->insert([
                'shiftName' => $request->shiftName,
                'startTime' => $request->startTime,
                'workinghour' => $request->workinghour,
                'daystart' => $request->daystart,
                'dayhour' => $request->dayhour,
            ]);

            return redirect()
                ->route('shifts.index')
                ->with('success', 'Shift Added Successfully');
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
        $shift = DB::table('tblShift')
            ->where('id', $id)
            ->first();

        if (!$shift) {
            abort(404);
        }
        return view('shifts.edit', compact(
            'shift'
        ));
    }

    /**
     * Update Employee
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'shiftName' => 'required'
        ]);

        try {

            $shift = DB::table('tblShift')
                ->where('id', $id)
                ->first();

            if (!$shift) {
                return back()->with('error', 'Shift not found');
            }



            DB::table('tblShift')
                ->where('id', $id)
                ->update([
                    'shiftName' => $request->shiftName,
                    'startTime' => $request->startTime,
                    'workinghour' => $request->workinghour,
                    'daystart' => $request->daystart,
                    'dayhour' => $request->dayhour,
                ]);

            return redirect()
                ->route('shifts.index')
                ->with('success', 'Shift Updated Successfully');
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

            DB::table('tblShift')
                ->where('id', $id)
                ->delete();

            return redirect()
                ->route('shifts.index')
                ->with('success', 'Shift Deleted Successfully');
        } catch (Exception $e) {

            return redirect()
                ->route('shifts.index')
                ->with('error', 'Unable to delete Shift.');
        }
    }
}
