@extends('layouts.master')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-xs flex justify-between items-center h-14">
        <div class="flex items-center space-x-2 text-sm font-bold text-slate-700">
            <span>⚙️ Setup Workspace</span>
            <span class="text-slate-300">/</span>
            <span class="text-indigo-600">Employee Management Control</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <div class="lg:col-span-7 bg-slate-200/80 border border-slate-300 rounded-xl p-5 shadow-inner flex flex-col justify-between min-h-[580px]">
            <form id="employeeForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" id="form_mode" value="CREATE"> <div class="bg-slate-300/60 p-3 rounded-lg text-center border-b border-slate-400/50 mb-2">
                    <h3 class="text-base font-black text-slate-800 tracking-wide uppercase">Employee Information</h3>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">User ID</label>
                    <div class="col-span-6 flex gap-1">
                        <input type="text" id="user_id" name="user_id" required class="w-full bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden focus:border-indigo-600">
                        <button type="button" onclick="searchEmployee()" class="bg-white hover:bg-slate-50 border border-slate-400 text-slate-700 font-bold px-4 py-1 text-xs rounded-sm shadow-xs transition shrink-0 cursor-pointer">Search</button>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">F/C ID</label>
                    <input type="text" id="fc_id" name="fc_id" class="col-span-6 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Name</label>
                    <input type="text" id="name" name="name" required class="col-span-8 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Department</label>
                    <select id="department_id" name="department_id" required class="col-span-6 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="">Select Department...</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->DeptID }}">{{ $dept->DeptName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Designation</label>
                    <select id="designation_id" name="designation_id" required class="col-span-6 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="">Select Designation...</option>
                        @foreach($designations as $desig)
                            <option value="{{ $desig->DesigID }}">{{ $desig->DesigName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Join Date</label>
                    <input type="date" id="join_date" name="join_date" value="{{ date('Y-m-d') }}" class="col-span-3 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                    
                    <label class="col-span-2 text-xs font-bold text-slate-700 text-right pr-2">Religion</label>
                    <select id="religion" name="religion" class="col-span-3 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="Islam">Islam</option>
                        <option value="Hinduism">Hinduism</option>
                        <option value="Christianity">Christianity</option>
                        <option value="Buddhism">Buddhism</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Blood Group</label>
                    <select id="blood_group" name="blood_group" class="col-span-3 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="A+">A+</option>
                        <option value="O+">O+</option>
                        <option value="B+">B+</option>
                        <option value="AB+">AB+</option>
                        <option value="A-">A-</option>
                    </select>

                    <label class="col-span-2 text-xs font-bold text-slate-700 text-right pr-2">Gender</label>
                    <select id="gender" name="gender" class="col-span-3 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Is Admin</label>
                    <select id="is_admin" name="is_admin" class="col-span-3 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>

                    <label class="col-span-2 text-xs font-bold text-slate-700 text-right pr-2">Shift Name</label>
                    <select id="shift_id" name="shift_id" required class="col-span-3 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="">Select Shift...</option>
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->ShiftID }}">{{ $shift->ShiftName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Reporting To</label>
                    <select id="reporting_to" name="reporting_to" class="col-span-4 bg-white border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                        <option value="">Select Supervisor...</option>
                        @foreach($supervisors as $sup)
                            <option value="{{ $sup->User_id }}">{{ $sup->Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center pt-2 border-t border-slate-300">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Status</label>
                    <select id="status" name="status" disabled class="col-span-3 bg-slate-100 border border-slate-400 rounded-sm px-2 py-1 text-xs font-bold focus:outline-hidden">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-3 items-center">
                    <label class="col-span-3 text-xs font-bold text-slate-700 text-right pr-2">Inactive Reason</label>
                    <input type="text" id="inactive_reason" name="inactive_reason" disabled class="col-span-8 bg-slate-100 border border-slate-400 rounded-sm px-2 py-1 text-xs font-semibold focus:outline-hidden">
                </div>
            </form>

            <div class="grid grid-cols-5 gap-2 pt-4 mt-6 border-t border-slate-400">
                <button type="button" onclick="resetFormState()" class="bg-white hover:bg-slate-50 border border-slate-400 text-slate-800 py-2 text-xs font-bold rounded-sm shadow-xs transition cursor-pointer">New</button>
                <button type="button" onclick="submitForm()" class="bg-white hover:bg-slate-50 border border-slate-400 text-slate-800 py-2 text-xs font-bold rounded-sm shadow-xs transition cursor-pointer">Save</button>
                <button type="button" onclick="enableEditMode()" class="bg-white hover:bg-slate-50 border border-slate-400 text-slate-800 py-2 text-xs font-bold rounded-sm shadow-xs transition cursor-pointer">Edit</button>
                <button type="button" onclick="deleteEmployeeRecord()" class="bg-white hover:bg-slate-50 border border-slate-400 text-rose-700 py-2 text-xs font-bold rounded-sm shadow-xs transition cursor-pointer">Delete</button>
                <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" class="bg-white hover:bg-slate-50 border border-slate-400 text-slate-800 py-2 text-xs font-bold rounded-sm shadow-xs transition cursor-pointer">Close</button>
            </div>
        </div>

        <div class="lg:col-span-5 bg-slate-300/40 border border-slate-200 rounded-xl p-6 flex flex-col items-center justify-start space-y-4">
            <div class="w-full bg-slate-400/40 p-2 rounded-md text-center font-bold text-xs text-slate-700 uppercase tracking-wider">
                Employee Profile Image
            </div>
            
            <div class="h-56 w-52 bg-slate-100 border border-slate-400 shadow-inner flex flex-col items-center justify-center relative rounded-xs overflow-hidden">
                <img id="profile_img_preview" src="" class="hidden w-full h-full object-cover">
                <div id="profile_avatar_placeholder" class="text-4xl text-slate-300 select-none">👤</div>
            </div>

            <input type="file" id="photo" class="hidden" accept="image/*" onchange="previewSelectedImage(this)">
            <button type="button" onclick="document.getElementById('photo').click()" class="bg-white hover:bg-slate-50 border border-slate-400 text-slate-700 font-bold px-6 py-2 text-xs rounded-sm shadow-xs transition cursor-pointer">
                Add Image
            </button>
        </div>

    </div>
</div>

<script>
    /**
     * Clears form data fields to prepare for a new entry ("New" state).
     */
    function resetFormState() {
        document.getElementById('employeeForm').reset();
        document.getElementById('form_mode').value = 'CREATE';
        
        // Reset field accessibility constraints
        document.getElementById('user_id').disabled = false;
        document.getElementById('status').disabled = true;
        document.getElementById('inactive_reason').disabled = true;
        
        // Clean image frame preview canvas
        document.getElementById('profile_img_preview').classList.add('hidden');
        document.getElementById('profile_avatar_placeholder').classList.remove('hidden');
        alert('Form cleared. Ready to add a new employee profile.');
    }

    /**
     * Preview user selected photo locally before DB transmission.
     */
    function previewSelectedImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile_img_preview').src = e.target.result;
                document.getElementById('profile_img_preview').classList.remove('hidden');
                document.getElementById('profile_avatar_placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    /**
     * Queries the SQL Server via AJAX to pull a profile record based on the User ID ("Search" state).
     */
    function searchEmployee() {
        var id = document.getElementById('user_id').value;
        if(!id) return alert('Please input a valid User ID to initiate record searching.');

        fetch(`/setup/employees/${id}`)
            .then(res => res.json())
            .then(response => {
                if(response.success) {
                    var emp = response.data;
                    
                    // Map legacy table schema columns to form fields
                    document.getElementById('name').value = emp.Name;
                    document.getElementById('fc_id').value = emp.FC_id;
                    document.getElementById('department_id').value = emp.DeptID;
                    document.getElementById('designation_id').value = emp.DesigID;
                    document.getElementById('join_date').value = emp.JoinDate;
                    document.getElementById('religion').value = emp.Religion;
                    document.getElementById('blood_group').value = emp.BloodGroup;
                    document.getElementById('gender').value = emp.Gender;
                    document.getElementById('is_admin').value = emp.IsAdmin;
                    document.getElementById('shift_id').value = emp.ShiftID;
                    document.getElementById('reporting_to').value = emp.ReportingTo;
                    document.getElementById('status').value = emp.IsActive == 1 ? 'Active' : 'Inactive';
                    document.getElementById('inactive_reason').value = emp.InActiveReason || '';

                    // Update functional mode to update path targeting
                    document.getElementById('form_mode').value = 'EDIT';
                    document.getElementById('user_id').disabled = true;
                    
                    alert('Employee record successfully loaded from master registry.');
                } else {
                    alert(response.message);
                }
            });
    }

    /**
     * Activates status modification switches ("Edit" state).
     */
    function enableEditMode() {
        if(document.getElementById('form_mode').value !== 'EDIT') {
            return alert('Please search and load an existing employee record before enabling edit mode.');
        }
        document.getElementById('status').disabled = false;
        document.getElementById('inactive_reason').disabled = false;
        alert('Edit mode activated. You can now modify status flags and save changes.');
    }

    /**
     * Determines operation type and posts payload to the SQL Server database ("Save" state).
     */
    function submitForm() {
        var form = document.getElementById('employeeForm');
        if(!form.checkValidity()) return form.reportValidity();

        var formData = new FormData(form);
        var fileInput = document.getElementById('photo');
        if(fileInput.files[0]) {
            formData.append('photo', fileInput.files[0]);
        }

        var mode = document.getElementById('form_mode').value;
        var url = '/setup/employees';
        
        // Append spoofed method overrides if processing an update operations step
        if(mode === 'EDIT') {
            var id = document.getElementById('user_id').value;
            url = `/setup/employees/${id}`;
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success && mode === 'CREATE') resetFormState();
        });
    }

    /**
     * Dispatches a native DELETE request against the employee ID ("Delete" state).
     */
    function deleteEmployeeRecord() {
        if(document.getElementById('form_mode').value !== 'EDIT') {
            return alert('Please search and load an existing profile record before executing delete actions.');
        }

        if(!confirm('Are you absolutely certain you want to purge this record from the database? This action cannot be undone.')) return;

        var id = document.getElementById('user_id').value;
        
        fetch(`/setup/employees/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success) resetFormState();
        });
    }
</script>
@endsection