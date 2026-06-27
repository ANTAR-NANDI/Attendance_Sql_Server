<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = DB::table('tblDepartmentOrder')
            ->select(
                'tblDepartmentOrder.*'
            )
            ->orderBy('tblDepartmentOrder.id', 'DESC')
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('departments.create');
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



            DB::table('tblDepartmentOrder')->insert([
                'departmentName' => $request->strName
            ]);

            return redirect()
                ->route('departments.index')
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
        $department = DB::table('tblDepartmentOrder')
            ->where('id', $id)
            ->first();

        if (!$department) {
            abort(404);
        }
        return view('departments.edit', compact(
            'department'
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

            $department = DB::table('tblDepartmentOrder')
                ->where('id', $id)
                ->first();

            if (!$department) {
                return back()->with('error', 'Department not found');
            }



            DB::table('tblDepartmentOrder')
                ->where('id', $id)
                ->update([
                    'departmentName' => $request->strName
                ]);

            return redirect()
                ->route('departments.index')
                ->with('success', 'Department Updated Successfully');
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

            DB::table('tblDepartmentOrder')
                ->where('id', $id)
                ->delete();

            return redirect()
                ->route('departments.index')
                ->with('success', 'Department Deleted Successfully');
        } catch (Exception $e) {

            return redirect()
                ->route('departments.index')
                ->with('error', 'Unable to delete Department.');
        }
    }
}
