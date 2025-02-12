@extends('userLayout.app')


@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
@endsection

@include('layout.components.sidebar.sidebar')


@section('content')
    {{-- main - app content --}}


    <div class="main-content app-content">
        <div class="container-fluid">
            <h2>Users table</h2>
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">

                        <hr>
                        <button type="button" class="col-md-1 btn btn-primary" id="btn_add_user">Add User</button>
                        {{-- content --}}
                        <div class="table-responsive ">
                            <table id="userTable" class="table">
                                <thead>
                                    <th>ID</th>
                                    <th>fullname</th>
                                    <th>email</th>
                                    <th>age</th>
                                    <th>address</th>
                                    <th>role</th>
                                    <th>status</th>
                                    <th>action</th>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        {{-- end of table content --}}


                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- end of main - app content --}}
    {{-- modal of adding user --}}
    <div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id='formAddUser'>
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Fullname:</label>
                            <input type="text" class="form-control" id="txt_fullname" name="txt_fullname">
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="txt_email" name="txt_email">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Age:</label>
                            <input type="text" class="form-control" id="txt_age" name="txt_age">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="txt_address" name="txt_address">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Role:</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">--SELECT ROLE--</option>
                                @foreach ($user_roles as $roles)
                                    <option value="{{ $roles->role_id }}">{{ $roles->role }}</option>
                                @endforeach
                            </select>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_add">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of modal --}}



    {{-- modal of updating --}}
    <div class="modal fade" id="UpdateUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id='formUpdateUser'>
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ID:</label>
                            <input type="text" class="form-control" id="txt_id1" name="txt_id1">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Fullname:</label>
                            <input type="text" class="form-control" id="txt_fullname1" name="txt_fullname1">
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="txt_email1" name="txt_email1">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Age:</label>
                            <input type="text" class="form-control" id="txt_age1" name="txt_age1">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="txt_address1" name="txt_address1">
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Role:</label>
                            <select class="form-control" name="role_id1" id="role_id1">
                                <option value="">--SELECT ROLE--</option>
                                @foreach ($user_roles as $roles)
                                    <option value="{{ $roles->role_id }}">{{ $roles->role }}</option>
                                @endforeach
                            </select>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_save_update">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end of modal --}}
@endsection



@section('scripts')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                destroy: true,
                serverSide: false,
                processing: false,
                ajax: {
                    url: '{{ route('admin.displayUsers') }}',
                    type: 'GET', //if GET, no need for csrf token
                    // data: {_token:'{{ csrf_token() }}'} 

                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'age'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    },

                ]

            });


            $('#btn_add_user').on('click', function() {
                $('#UserModal').modal('show');
            });

            $('#btn_add').on('click', function() {
                // alert()
                var form = $('#formAddUser').serializeArray();

                console.log(form)

                $.ajax({
                    url: '{{ route('admin.addUser') }}',
                    type: 'POST',
                    data: form,
                    success: function(response) {
                        console.log(response);
                        window.location.reload();


                    }
                })
            });


            $(document).on('click', '.btn_update', function() {

                $('#UpdateUserModal').modal('show');

                // var id = $(this).data('id');
                $('#txt_id1').val($(this).data('id'));
                $('#txt_fullname1').val($(this).data('fullname'));
                $('#txt_email1').val($(this).data('email'));
                $('#txt_age1').val($(this).data('age'));
                $('#txt_address1').val($(this).data('address'));
                $('#role_id1').val($(this).data('role'));

                // //for select tag
                // var role = $(this).data('role'); // Get role from button
                // $('#role_id').val(role).change(); // Set value & trigger change event


            });


            $('#btn_save_update').on('click', function() {
                // var updateForm = $('#formUpdateUser').serializeArray();
                var id = $('#txt_id1').val();
                var fullname = $('#txt_fullname1').val();
                var email = $('#txt_email1').val();
                var age = $('#txt_age1').val();
                var address = $('#txt_address1').val();
                var role = $('#role_id1').val();
                // alert(id);
                console.log(role);
                $.ajax({
                    url: '{{ route('admin.updateUser') }}',
                    type: 'POST',
                    data: {
                        // updateForm,
                        id,fullname,email,age,address,role,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });




            $(document).on('click', '.btn_delete', function() {
                var id = $(this).data('id');
                
                $.ajax({
                    url: '{{ route('admin.deleteUser') }}',
                    type:'POST',
                    data:{
                        id, _token:'{{csrf_token()}}'
                    },
                    success:function() {
                          window.location.reload();
                    }
                });

            });









        });
    </script>
@endsection
