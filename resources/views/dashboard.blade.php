@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 font-mono">
    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div onclick="window.location.href='{{ route('employees.index') }}'"
     class="bg-white border-2 border-slate-400 p-6 rounded-lg shadow-md cursor-pointer hover:bg-indigo-50 hover:border-indigo-600 transition duration-150 transform active:scale-98 group">
    <div class="flex flex-col items-center justify-center text-center space-y-3">
        <span class="text-4xl group-hover:animate-bounce">👥</span>
        <span class="text-sm font-black text-slate-800 uppercase tracking-wider">Employee Hub</span>
        <span class="text-[10px] text-slate-400 font-bold">Add, Edit, Update, Delete</span>
    </div>
</div>
        <div class="bg-slate-100 border border-slate-300 p-6 rounded-lg opacity-60 cursor-not-allowed">
            <div class="flex flex-col items-center justify-center text-center space-y-3">
                <span class="text-4xl">🏢</span>
                <span class="text-sm font-black text-slate-400 uppercase tracking-wider">Department</span>
                <span class="text-[10px] text-slate-400 font-bold">tblDepartmentOrder</span>
            </div>
        </div>

        <div class="bg-slate-100 border border-slate-300 p-6 rounded-lg opacity-60 cursor-not-allowed">
            <div class="flex flex-col items-center justify-center text-center space-y-3">
                <span class="text-4xl">🎓</span>
                <span class="text-sm font-black text-slate-400 uppercase tracking-wider">Designation</span>
                <span class="text-[10px] text-slate-400 font-bold">tblDeignationOrder</span>
            </div>
        </div>

        <div class="bg-slate-100 border border-slate-300 p-6 rounded-lg opacity-60 cursor-not-allowed">
            <div class="flex flex-col items-center justify-center text-center space-y-3">
                <span class="text-4xl">⏱</span>
                <span class="text-sm font-black text-slate-400 uppercase tracking-wider">Shift Setup</span>
                <span class="text-[10px] text-slate-400 font-bold">tblShift Matrix</span>
            </div>
        </div>

    </div>
</div>

<script>
    /**
     * Toggles workspace layouts smoothly based on launcher selection step.
     */
    function switchWorkspace(moduleId) {
        document.getElementById('workspace-viewport').classList.remove('hidden');
        document.getElementById('employee-module').classList.add('hidden');
        
        // Uncover selected module explicitly
        document.getElementById(moduleId).classList.remove('hidden');
        document.getElementById(moduleId).scrollIntoView({ behavior: 'smooth' });
    }

    function closeWorkspace() {
        document.getElementById('workspace-viewport').classList.add('hidden');
    }

    // CRUD AJAX engine methods logic legacy mappings
    function initializeWorkspace() {
        document.getElementById('employeeForm').reset();
        document.getElementById('form_mode').value = 'CREATE';
        document.getElementById('existing_image_data').value = '';
        document.getElementById('User_id').disabled = false;
        document.getElementById('ysnactive').disabled = true;
        document.getElementById('inactiveReason').disabled = true;
        document.getElementById('avatar_preview').classList.add('hidden');
        document.getElementById('avatar_placeholder').classList.remove('hidden');
    }

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

    function searchEmployeeProfile() {
        var id = document.getElementById('User_id').value;
        if(!id) return alert('Provide a valid User ID.');

        fetch(`/dashboard/employees/${id}`)
            .then(res => res.json())
            .then(response => {
                if(response.success) {
                    var emp = response.data;
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
                    document.getElementById('workStation').value = emp.workStation || '';
                    document.getElementById('ysnactive').value = emp.ysnactive;
                    document.getElementById('inactiveReason').value = emp.inactiveReason || '';

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

    function unlockEditParameters() {
        if(document.getElementById('form_mode').value !== 'EDIT') return alert('Search record first.');
        document.getElementById('ysnactive').disabled = false;
        document.getElementById('inactiveReason').disabled = false;
    }

    function persistFormData() {
        var form = document.getElementById('employeeForm');
        if(!form.checkValidity()) return form.reportValidity();

        var formData = new FormData(form);
        var fileInput = document.getElementById('image_file');
        if(fileInput.files[0]) formData.append('image_file', fileInput.files[0]);

        var mode = document.getElementById('form_mode').value;
        var url = '/dashboard/employees';
        
        if(mode === 'EDIT') {
            var id = document.getElementById('User_id').value;
            url = `/dashboard/employees/${id}`;
            formData.append('_method', 'PUT');
        }

        fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if(data.success && mode === 'CREATE') initializeWorkspace();
        });
    }

    function dispatchDeleteRequest() {
        if(document.getElementById('form_mode').value !== 'EDIT') return alert('Search record first.');
        if(!confirm('Execute delete query?')) return;

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