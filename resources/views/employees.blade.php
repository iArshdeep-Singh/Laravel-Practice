<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 300px;
        }

        .modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 300px;
        }

        modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .modal-body {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Employee List</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr id="employee-{{$employee->id}}">
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->age}}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{$employee->id}}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{$employee->id}}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Data Found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="modal" id="addModal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="btn-close" onclick="closeAddModal()">×</span>
                <h5>Add Employee</h5>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-group">
                        <label for="add-name">Name</label>
                        <input type="text" id="add-name" required>
                    </div>
                    <div class="form-group">
                        <label for="add-email">Email</label>
                        <input type="email" id="add-email" required>
                    </div>
                    <div class="form-group">
                        <label for="add-age">Age</label>
                        <input type="number" id="add-age" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Employee</button>
                </form>
            </div>
        </div>
    </div>


    <button class="btn btn-primary" onclick="openAddModal()">Add Employee</button>


    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="btn-close" onclick="closeModal()">×</span>
                <h5>Edit Employee</h5>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit-id">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" id="edit-name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" id="edit-email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-age">Age</label>
                        <input type="number" id="edit-age" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        $('#addForm').submit(function (e) {
            e.preventDefault();

            let name = $('#add-name').val();
            let email = $('#add-email').val();
            let age = $('#add-age').val();

            $.ajax({
                url: '/employees',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    email: email,
                    age: age
                },
                success: function (response) {

                    $('tbody').append(`
                <tr id="employee-${response.id}">
                    <td>${response.id}</td>
                    <td>${response.name}</td>
                    <td>${response.email}</td>
                    <td>${response.age}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" data-id="${response.id}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${response.id}">Delete</button>
                    </td>
                </tr>
            `);
                    closeAddModal();
                }
            });
        });


        function openModal() {
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        $(document).on('click', '.edit-btn', function () {
            let employeeId = $(this).data('id');
            $.ajax({
                url: '/employees/' + employeeId + '/edit',
                type: 'GET',
                success: function (response) {
                    $('#edit-id').val(response.id);
                    $('#edit-name').val(response.name);
                    $('#edit-email').val(response.email);
                    $('#edit-age').val(response.age);
                    openModal();
                }
            });
        });

        $('#editForm').submit(function (e) {
            e.preventDefault();

            let employeeId = $('#edit-id').val();
            let name = $('#edit-name').val();
            let email = $('#edit-email').val();
            let age = $('#edit-age').val();

            $.ajax({
                url: '/employees/' + employeeId,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    email: email,
                    age: age
                },
                success: function (response) {
                    $('#employee-' + employeeId).html(`
                        <td>${response.id}</td>
                        <td>${response.name}</td>
                        <td>${response.email}</td>
                        <td>${response.age}</td>
                        <td>
                            <button class="btn btn-warning edit-btn" data-id="${response.id}">Edit</button>
                            <button class="btn btn-danger delete-btn" data-id="${response.id}">Delete</button>
                        </td>
                    `);
                    closeModal();
                }
            });
        });

        $(document).on('click', '.delete-btn', function () {
            let employeeId = $(this).data('id');

            $.ajax({
                url: '/employees/' + employeeId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    $('#employee-' + employeeId).remove();
                }
            });

        });

    </script>
</body>

</html>