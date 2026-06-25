@extends('layouts.master')

@section('panel')

<div class="row mb-3">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h4>Employee List</h4>

```
    <a href="{{ route('employees.create') }}"
       class="btn btn-success">
        <i class="las la-plus"></i> Add Employee
    </a>
</div>
```

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10">

```
        <div class="card-body p-0">
            <div class="table-responsive--md table-responsive">

                <table class="table--light style--two table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($employees as $employee)

                        <tr>
                            <td>{{ $employees->firstItem() + $loop->index }}</td>

                            <td>{{ $employee->User_id }}</td>

                            <td>{{ $employee->strName }}</td>

                            <td>{{ $employee->strdepartment }}</td>

                            <td>{{ $employee->strdesignation }}</td>

                            <td>
                                <a href="{{ route('employees.edit',$employee->User_id) }}"
                                   class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <button
                                    onclick="deleteEmployee('{{ $employee->User_id }}')"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No Employees Found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>

        @if($employees->hasPages())
        <div class="card-footer">
            {{ $employees->links() }}
        </div>
        @endif

    </div>
</div>
```

</div>

<script>
function deleteEmployee(id)
{
    if (!confirm('Delete this employee?')) {
        return;
    }

    fetch(`/dashboard/employees/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);

        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error(error);
        alert('Something went wrong');
    });
}
</script>

@endsection
