\@extends('layouts.main')

@section('title', 'User Management')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">User Management</h3>
            <button class="btn btn-success" id="setMenusButton">Setting Menu dalam Role</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td >{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->userRole->role ?? 'No Role' }}</td>
                                <td class="text-center"> <!-- Tambahkan text-center -->
                                    <button class="btn btn-primary btn-sm edit-role" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-role="{{ $user->userRole->id ?? '' }}">
                                        Ubah Role
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-user" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Role -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role for <span id="userName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRoleForm">
                    <div class="modal-body">
                        <input type="hidden" id="userId" name="user_id">
                        <div class="mb-3">
                            <label for="roleSelect" class="form-label">Select Role</label>
                            <select class="form-select" id="roleSelect" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $role->id == $user->userRole->id ? 'selected' : '' }}>
                                        {{ $role->role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal untuk Setting Menu Role -->
    <div class="modal fade" id="setMenusModal" tabindex="-1" aria-labelledby="setMenusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setMenusModalLabel">Set Menus for Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="setMenusForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleMenuSelect" class="form-label">Select Role</label>
                            <select class="form-select" id="roleMenuSelect" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="menuSelect" class="form-label">Assign Menus</label>
                            <select class="form-select" id="menuSelect" name="menu_ids[]" multiple>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl to select multiple menus.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle edit role button click
            $('.edit-role').click(function() {
                const userId = $(this).data('id');
                const userName = $(this).data('name');
                const userRole = $(this).data('role');

                // Set nilai input hidden dan teks nama pengguna
                $('#editRoleModal #userId').val(userId);
                $('#editRoleModal #userName').text(userName);

                // Set dropdown role
                $('#editRoleModal #roleSelect').val(userRole);

                // Tampilkan modal
                $('#editRoleModal').modal('show');
            });

            // Open Set Menus Modal
            $('#setMenusButton').click(function() {
                $('#setMenusModal').modal('show');
            });

            // Handle form submission for Edit Role
            $('#editRoleForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('user.update.role') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });

            // Handle form submission for Set Menus
            $('#setMenusForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('role.update.menus') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>

    <script>
        $('.delete-user').click(function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');

            if (confirm(`Are you sure you want to delete the user "${userName}"?`)) {
                $.ajax({
                    url: "{{ route('user.delete') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: userId
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            }
        });
    </script>
@endsection
