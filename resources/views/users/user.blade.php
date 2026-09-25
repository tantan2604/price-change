@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="d-flex min-vh-100">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <main class="main-content flex-grow-1 p-4">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">User List</h2>

                <button type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addUserModal">
                    Add User
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>

    </main>

</div>

<!-- Add User Modal -->

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="addUserModalLabel">
                    Add User
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <form id="addUserForm">

                    <!-- User Name -->
                    <div class="mb-3">
                        <label class="form-label">
                            User Name
                        </label>

                        <input type="text"
                            class="form-control"
                            name="user_name"
                            id="user_name">

                        <div class="text-danger small mt-1" id="user_name_error"></div>
                    </div>


                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">
                            Role
                        </label>

                        <select class="form-select"
                            name="role"
                            id="role">

                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>

                        </select>

                        <div class="text-danger small mt-1" id="role_error"></div>
                    </div>


                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                            class="form-control"
                            name="email"
                            id="email">

                        <div class="text-danger small mt-1" id="email_error"></div>
                    </div>


                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">
                            Password
                        </label>

                        <input type="password"
                            class="form-control"
                            name="password"
                            id="password">

                        <div class="text-danger small mt-1" id="password_error"></div>
                    </div>


                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input type="password"
                            class="form-control"
                            name="password_confirmation"
                            id="password_confirmation">

                        <div class="text-danger small mt-1"
                            id="password_confirmation_error"></div>
                    </div>

                </form>



            </div>

            <div class="modal-footer">

                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button type="button"
                    form="addUserForm"
                    class="btn btn-primary"
                    id="saveUserBtn">
                    Save User
                </button>

            </div>

        </div>

    </div>

</div>

<!-- Update User Modal -->

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="updateUserModalLabel">
                    Update User
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <form id="updateUserForm">

                    <div class="mb-3">
                        <label for="user_id"
                            class="col-form-label">
                            ID:
                        </label>

                        <input type="text"
                            class="form-control"
                            id="user_id"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            User Name
                        </label>

                        <input type="text"
                            class="form-control"
                            id="user_name-1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Role
                        </label>

                        <select class="form-select"
                            id="role-1">

                            <option value="">
                                Select Role
                            </option>

                            <option value="admin">
                                Admin
                            </option>

                            <option value="user">
                                User
                            </option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                            class="form-control"
                            id="email-1">
                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button type="button"
                    class="btn btn-primary"
                    id="updateUserBtn">
                    Save User
                </button>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')


<script>
    $(document).ready(function() {

        $('#users-table').DataTable({

            processing: true,
            serverSide: true,

            ajax: "{{ url('users-data') }}",

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },

                {
                    data: 'user_name',
                    name: 'user_name'
                },

                {
                    data: 'role',
                    name: 'role'
                },

                {
                    data: 'email',
                    name: 'email'
                },

                {
                    data: 'created_at',
                    name: 'created_at'
                },

                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                }

            ]

        });

    });

    $(document).on('click', '.edit-btn', function() {
        $('#updateModal').modal('show');

        $('#user_id').val($(this).data('id'));
        $('#user_name-1').val($(this).data('user_name'));
        $('#role-1').val($(this).data('role'));
        $('#email-1').val($(this).data('email'));

    });

    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        alert(id)

        // $.ajax({
        //     url: '{{ route("deleteUser") }}',
        //     type: 'POST',
        //     data: {
        //         id,
        //         _token: '{{csrf_token()}}'
        //     },
        //     success: function() {
        //         window.location.reload();
        //     }
        // });

    });

    $('#updateUserBtn').on('click', function() {
        // var updateForm = $('#formUpdateUser').serializeArray();
        var id = $('#user_id').val();
        var user_name = $('#user_name-1').val();
        var role = $('#role-1').val();
        var email = $('#email-1').val();
        // alert(id);
        console.log(role);
        $.ajax({
            url: '{{ route("updateUser") }}',
            type: 'POST',
            data: {
                // updateForm,
                id,
                user_name,
                role,
                email,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });


    $(document).on('click', '#saveUserBtn', function() {

        // Clear previous errors
        $('.text-danger').text('');
        $('.form-control, .form-select').removeClass('is-invalid');

        var user_name = $('#user_name').val();
        var role = $('#role').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        $.ajax({

            url: "{{ route('addUser') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                user_name: user_name,
                role: role,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            },

            success: function(response) {

                $('#users-table')
                    .DataTable()
                    .ajax.reload();

                $('#addUserModal').modal('hide');

                $('#addUserForm')[0].reset();

            },

            error: function(xhr) {

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(field, messages) {

                        // Show message
                        $('#' + field + '_error')
                            .text(messages[0]);

                        // Add red border
                        $('#' + field)
                            .addClass('is-invalid');

                    });

                } else {

                    console.log(xhr.responseText);

                    alert('Failed to add user.');

                }

            }

        });

    });
</script>


@endpush