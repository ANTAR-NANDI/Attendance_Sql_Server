<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = DB::table('tblDesignationOrder')
            ->select(
                'tblDesignationOrder.*'
            )
            ->orderBy('tblDesignationOrder.id', 'DESC')
            ->paginate(10);

        return view('designations.index', compact('designations'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('designations.create');
    }

    /**
     * Store Employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'strName' => 'required',
        ]);

        try {
            DB::table('tblDesignationOrder')->insert([
                'departmentName' => $request->strName
            ]);

            return redirect()
                ->route('designations.index')
                ->with('success', 'Department Added Successfully');
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
        $designation = DB::table('tblDesignationOrder')
            ->where('id', $id)
            ->first();

        if (!$designation) {
            abort(404);
        }
        return view('designations.edit', compact(
            'designation'
        ));
    }

    /**
     * Update Employee
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'strName' => 'required'
        ]);

        try {

            $designation = DB::table('tblDesignationOrder')
                ->where('id', $id)
                ->first();

            if (!$designation) {
                return back()->with('error', 'Designation not found');
            }



            DB::table('tblDesignationOrder')
                ->where('id', $id)
                ->update([
                    'designation' => $request->strName
                ]);

            return redirect()
                ->route('designations.index')
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

            DB::table('tblDesignationOrder')
                ->where('id', $id)
                ->delete();

            return redirect()
                ->route('designations.index')
                ->with('success', 'Designation Deleted Successfully');
        } catch (Exception $e) {

            return redirect()
                ->route('designations.index')
                ->with('error', 'Unable to delete Designation.');
        }
    }
}
