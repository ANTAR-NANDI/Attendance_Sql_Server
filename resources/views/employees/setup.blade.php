@extends('layouts.master')

@section('content')
<div class="max-w-8xl mx-auto bg-slate-300/90 border border-slate-800 p-5 rounded-lg shadow-md font-mono">
    
     <div class="grid grid-cols-1 lg:grid-cols-22 gap-6">
        
        <div class="lg:col-span-8 space-y-3.5">
            <form id="employeeForm" class="space-y-3 text-xs font-bold text-slate-800">
                @csrf
                <input type="hidden" id="form_mode" value="CREATE">
                <input type="hidden" id="existing_image_data" name="existing_image_data">

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">User ID</label>
                    <div class="col-span-5 flex gap-1">
                        <input type="text" id="User_id" name="User_id" required class="w-full bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden focus:border-indigo-600">
                        <button type="button" onclick="searchEmployeeProfile()" class="bg-white hover:bg-slate-100 border border-slate-400 px-4 py-1 rounded-xs transition shadow-xs cursor-pointer">Search</button>
                    </div>
                    
                    <div class="col-span-4 flex items-center justify-end space-x-3 text-[11px]">
                        <label class="flex items-center space-x-1 cursor-pointer">
                            <input type="radio" name="filterType" value="All" checked class="cursor-pointer"> <span>All</span>
                        </label>
                        <label class="flex items-center space-x-1 cursor-pointer">
                            <input type="radio" name="filterType" value="Active" class="cursor-pointer"> <span>Active</span>
                        </label>
                        <label class="flex items-center space-x-1 cursor-pointer">
                            <input type="radio" name="filterType" value="Inactive" class="cursor-pointer"> <span>Inactive</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">F/C ID</label>
                    <input type="text" id="card_number" name="card_number" class="col-span-5 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                    <div class="col-span-4 flex justify-end gap-1">
                        <button type="button" class="bg-white border border-slate-400 px-4 py-0.5 rounded-xs text-[11px] cursor-pointer">Show</button>
                        <button type="button" class="bg-white border border-slate-400 px-4 py-0.5 rounded-xs text-[11px] cursor-pointer">Print</button>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Name</label>
                    <input type="text" id="strName" name="strName" required class="col-span-9 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Department</label>
                    <select id="strdepartment" name="strdepartment" required class="col-span-9 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="">Select Department...</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->departmentName }}">{{ $dept->departmentName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Designation</label>
                    <select id="strdesignation" name="strdesignation" required class="col-span-9 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="">Select Designation...</option>
                        @foreach($designations as $desig)
                            <option value="{{ $desig->designation }}">{{ $desig->designation }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Join Date</label>
                    <input type="date" id="join_Date" name="join_Date" value="{{ date('Y-m-d') }}" class="col-span-4 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                    
                    <label class="col-span-2 text-right pr-2">Religion</label>
                    <select id="RelioGion" name="RelioGion" class="col-span-3 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="Islam">Islam</option>
                        <option value="Hinduism">Hinduism</option>
                        <option value="Christianity">Christianity</option>
                        <option value="Buddhism">Buddhism</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Blood Group</label>
                    <select id="bloodGroup" name="bloodGroup" class="col-span-4 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="A+">A+</option>
                        <option value="O+">O+</option>
                        <option value="B+">B+</option>
                        <option value="AB+">AB+</option>
                        <option value="A-">A-</option>
                        <option value="B-">B-</option>
                    </select>

                    <label class="col-span-2 text-right pr-2">Gender</label>
                    <select id="Gender" name="Gender" class="col-span-3 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Is Admin</label>
                    <select id="ysnAdmin" name="ysnAdmin" class="col-span-4 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="0">False</option>
                        <option value="1">True</option>
                    </select>

                    <label class="col-span-2 text-right pr-2">Shift Name</label>
                    <select id="shiftName" name="shiftName" required class="col-span-3 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="">Select Shift...</option>
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->shiftName }}">{{ $shift->shiftName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Reporting To</label>
                    <select id="reporting_boss" name="reporting_boss" class="col-span-4 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="">Select Supervisor...</option>
                        @foreach($supervisors as $sup)
                            <option value="{{ $sup->strName }}">{{ $sup->strName }}</option>
                        @endforeach
                    </select>

                    <label class="col-span-2 text-right pr-2">Sp. Admin</label>
                    <select id="super_admin" name="super_admin" class="col-span-3 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="0">False</option>
                        <option value="1">True</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Emp Type</label>
                    <select id="empType" name="empType" class="col-span-4 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                        <option value="Permanent">Permanent</option>
                        <option value="Probationary">Probationary</option>
                        <option value="Temporary">Temporary</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">Com. Name</label>
                    <input type="text" id="workStation" name="workStation" placeholder="e.g. Chattogram Bandar Mohila College" class="col-span-9 bg-white border border-slate-400 rounded-xs px-2 py-1 focus:outline-hidden">
                </div>

                <div class="grid grid-cols-12 gap-2 items-center pt-2 border-t border-slate-400/60">
                    <label class="col-span-3 text-right pr-2">Status</label>
                    <select id="ysnactive" name="ysnactive" disabled class="col-span-4 bg-slate-100 border border-slate-400 rounded-xs px-2 py-0.5 focus:outline-hidden">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="grid grid-cols-12 gap-2 items-center">
                    <label class="col-span-3 text-right pr-2">InActive Resone</label>
                    <input type="text" id="inactiveReason" name="inactiveReason" disabled class="col-span-9 bg-slate-100 border border-slate-400 rounded-xs px-2 py-0.5 focus:outline-hidden">
                </div>
            </form>


            <div class="grid grid-cols-5 gap-1.5 pt-4 border-t border-slate-400">
                <button type="button" onclick="initializeWorkspace()" class="bg-white hover:bg-slate-100 border border-slate-400 py-1.5 text-xs font-bold rounded-xs shadow-xs cursor-pointer">New</button>
                <button type="button" onclick="persistFormData()" class="bg-white hover:bg-slate-100 border border-slate-400 py-1.5 text-xs font-bold rounded-xs shadow-xs cursor-pointer">Save</button>
                <button type="button" onclick="unlockEditParameters()" class="bg-white hover:bg-slate-100 border border-slate-400 py-1.5 text-xs font-bold rounded-xs shadow-xs cursor-pointer">Edit</button>
                <button type="button" onclick="dispatchDeleteRequest()" class="bg-white hover:bg-slate-100 border border-slate-400 text-rose-700 py-1.5 text-xs font-bold rounded-xs shadow-xs cursor-pointer">Delete</button>
                <button type="button" onclick="window.location.reload()" class="bg-white hover:bg-slate-100 border border-slate-400 py-1.5 text-xs font-bold rounded-xs shadow-xs cursor-pointer">Close</button>
            </div>
        </div>

        <div class="lg:col-span-4 border border-slate-400/70 bg-slate-400/20 rounded p-4 flex flex-col items-center justify-start space-y-4">
            <div class="w-full bg-slate-400/50 text-slate-700 p-1 rounded-xs text-center font-bold text-[11px] uppercase tracking-wider">
                Employee Bank Photo Frame
            </div>
            
            <div class="h-56 w-48 bg-white border border-slate-400 flex flex-col items-center justify-center relative rounded-xs overflow-hidden shadow-inner">
                <img id="avatar_preview" src="" class="hidden w-full h-full object-cover">
                <div id="avatar_placeholder" class="text-5xl text-slate-300 select-none">👤</div>
            </div>

            <input type="file" id="image_file" class="hidden" accept="image/*" onchange="processLocalPhotoPreview(this)">
            <button type="button" onclick="document.getElementById('image_file').click()" class="bg-white hover:bg-slate-100 border border-slate-400 px-5 py-1.5 text-xs font-bold rounded-xs shadow-xs transition cursor-pointer">
                Add Image
            </button>
        </div>
        <div class="lg:col-span-10 border border-slate-400/70 bg-slate-400/20 rounded p-4 flex flex-col items-center justify-start space-y-4">
             <h2 class="font-bold text-sm mb-3">
                    Employee List
                </h2>

                <table class="w-full border text-xs">
                    <thead>
                        <tr class="bg-slate-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Department</th>
                            <th class="border p-2">Designation</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td class="border p-2">
                                {{ $employee->User_id }}
                            </td>

                            <td class="border p-2">
                                {{ $employee->strName }}
                            </td>

                            <td class="border p-2">
                                {{ $employee->strdepartment }}
                            </td>

                            <td class="border p-2">
                                {{ $employee->strdesignation }}
                            </td>

                            <td class="border p-2">
                                <button
    onclick="loadEmployee('{{ $employee->User_id }}')"
    class="bg-blue-500 text-white px-2 py-1 rounded">
    Edit
</button>

                                <button
                                    onclick="deleteEmployee('{{ $employee->User_id }}')"
                                    class="bg-red-500 text-white px-2 py-1 rounded">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 flex justify-center items-center w-full">
    <div class="inline-block bg-white px-4 py-2 border border-slate-400 rounded shadow-xs">
        {{ $employees->links() }}
    </div>
</div>
        </div>

    </div>
</div>

<script>
    /**
     * Clear and reset form input states ("New" button action).
     */
    function loadEmployee(id)
{
    document.getElementById('User_id').value = id;
    searchEmployeeProfile();

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
    function deleteEmployee(id)
{
    if (!confirm('Are you sure you want to delete this employee?')) {
        return;
    }

    fetch(`/dashboard/employees/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {

        alert(data.message);

        if (data.success) {
            location.reload(); // refresh employee list
        }

    })
    .catch(error => {
        console.error(error);
        alert('Failed to delete employee.');
    });
}
    function initializeWorkspace() {
        document.getElementById('employeeForm').reset();
        document.getElementById('form_mode').value = 'CREATE';
        document.getElementById('existing_image_data').value = '';
        
        document.getElementById('User_id').disabled = false;
        document.getElementById('ysnactive').disabled = true;
        document.getElementById('inactiveReason').disabled = true;
        
        document.getElementById('avatar_preview').classList.add('hidden');
        document.getElementById('avatar_placeholder').classList.remove('hidden');
        console.log('Workspace context refreshed.');
    }

    /**
     * Renders local user images locally prior to uploading.
     */
    function processLocalPhotoPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar_preview').src = e.target.result;
                document.getElementById('avatar_preview').classList.remove('hidden');
                document.getElementById('avatar_placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    /**
     * Executes asynchronous SELECT statements to populate fields ("Search" button action).
     */
    function searchEmployeeProfile() {
        var id = document.getElementById('User_id').value;
        if(!id) return alert('Provide an explicit User ID to perform row lookups.');

        fetch(`/dashboard/employees/${id}`)
            .then(res => res.json())
            .then(response => {
                if(response.success) {
                    var emp = response.data;
                    
                    // Match text parameters directly against legacy variables
                    document.getElementById('strName').value = emp.strName;
                    document.getElementById('card_number').value = emp.card_number || '';
                    document.getElementById('strdepartment').value = emp.strdepartment || '';
                    document.getElementById('strdesignation').value = emp.strdesignation || '';
                    document.getElementById('join_Date').value = emp.join_Date || '';
                    document.getElementById('RelioGion').value = emp.RelioGion || 'Islam';
                    document.getElementById('bloodGroup').value = emp.bloodGroup || 'O+';
                    document.getElementById('Gender').value = emp.Gender || 'Male';
                    document.getElementById('ysnAdmin').value = emp.ysnAdmin;
                    document.getElementById('shiftName').value = emp.shiftName || '';
                    document.getElementById('reporting_boss').value = emp.reporting_boss || '';
                    document.getElementById('empType').value = emp.empType || 'Permanent';
                    document.getElementById('workStation').value = emp.workStation || '';
                    document.getElementById('ysnactive').value = emp.ysnactive;
                    document.getElementById('inactiveReason').value = emp.inactiveReason || '';

                    // Manage visual container preview if image blob string data resides inside record
                    if(emp.image) {
                        document.getElementById('avatar_preview').src = emp.image;
                        document.getElementById('avatar_preview').classList.remove('hidden');
                        document.getElementById('avatar_placeholder').classList.add('hidden');
                        document.getElementById('existing_image_data').value = emp.image;
                    } else {
                        document.getElementById('avatar_preview').classList.add('hidden');
                        document.getElementById('avatar_placeholder').classList.remove('hidden');
                    }

                    document.getElementById('form_mode').value = 'EDIT';
                    document.getElementById('User_id').disabled = true;
                } else {
                    alert(response.message);
                }
            });
    }

    /**
     * Safely opens form locking constraints ("Edit" button action).
     */
    function unlockEditParameters() {
        if(document.getElementById('form_mode').value !== 'EDIT') {
            return alert('Load an existing employee profile registry before opening field locks.');
        }
        document.getElementById('ysnactive').disabled = false;
        document.getElementById('inactiveReason').disabled = false;
        alert('Form parameter locks temporarily cleared.');
    }

    /**
     * Post structured data inputs back to the database via AJAX ("Save" button action).
     */
    function persistFormData() {
        var form = document.getElementById('employeeForm');
        if(!form.checkValidity()) return form.reportValidity();

        var formData = new FormData(form);
        var fileInput = document.getElementById('image_file');
        if(fileInput.files[0]) {
            formData.append('image_file', fileInput.files[0]);
        }

        var mode = document.getElementById('form_mode').value;
        var url = '/dashboard/employees';
        
        if(mode === 'EDIT') {
            var id = document.getElementById('User_id').value;
            url = `/dashboard/employees/${id}`;
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
            if(data.success && mode === 'CREATE') initializeWorkspace();
        });
    }

    /**
     * Drops a table record completely matching targeted User ID ("Delete" button action).
     */
    function dispatchDeleteRequest() {
        if(document.getElementById('form_mode').value !== 'EDIT') {
            return alert('A record profile row must be explicitly searched before drop actions run.');
        }

        if(!confirm('Purge this record row from the SQL Server attendance system?')) return;

        var id = document.getElementById('User_id').value;
        
        fetch(`/dashboard/employees/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success) initializeWorkspace();
        });
    }
</script>
@endsection