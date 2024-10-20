@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">User Management /</span> User
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                Add User
            </button>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="userTableBody">
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel3">Add User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Name">
                                <label for="nameLarge">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2">
                            <div class="form-floating form-floating-outline">
                                <input type="email" id="emailLarge" class="form-control" placeholder="xxxx@xxx.xx">
                                <label for="emailLarge">Email</label>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-floating form-floating-outline">
                                <input type="password" id="password" class="form-control">
                                <label for="password">Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // AJAX request to fetch user data
        $.ajax({
            url: "{{ route('pages-user-settings-ajax') }}",
            method: 'GET',
            success: function(response) {
                var userTableBody = $('#userTableBody');
                userTableBody.empty(); // Clear the table body

                // Loop through the response and add rows to the table
                $.each(response, function(index, user) {
                    var userRow = '<tr>' +
                        '<td>' + user.name + '</td>' +
                        '<td>' + user.role + '</td>' +
                        '<td>' + user.status + '</td>' +
                        '<td>' +
                        '<button class="btn btn-sm btn-primary">Edit</button> ' +
                        '<button class="btn btn-sm btn-danger">Delete</button>' +
                        '</td>' +
                        '</tr>';
                    userTableBody.append(userRow);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching users:', error);
            }
        });
    });
</script>
