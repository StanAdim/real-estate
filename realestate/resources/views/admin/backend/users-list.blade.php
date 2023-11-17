@extends("admin.master")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>User Type</th>
                                    <th>Approve</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if (auth()->check())
                                        @if ($user->user_type == 1)
                                        <button class="btn btn-primary">Admin</button>
                                        @elseif ($user->user_type == 2)
                                        <button class="btn btn-info">Vendor</button>
                                        @elseif ($user->user_type == 0)
                                        <button class="btn btn-secondary">User</button>
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#approveConfirmationModal-{{ $user->id }}">
                                            Approve
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-outline-info btn-sm"
                                            data-toggle="modal" data-target="#modal-{{ $user->id }}">
                                            <span class="fa fa-eye"></span> View
                                        </button>

                                        <button type="button" class="btn btn-block btn-outline-warning btn-sm edit-user"
                                            data-toggle="modal" data-target="#modal-edit-{{ $user->id }}">
                                            <span class="fas fa-pencil-alt"></span> Edit
                                        </button>

                                        <button type="button" class="btn btn-block btn-outline-danger btn-sm"
                                            data-toggle="modal" data-target="#deleteConfirmationModal">
                                            <span class="fa fa-trash"></span> Delete
                                        </button>

                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">user Details</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>user ID: {{ $user->id }}</p>
                                                <p>Name: {{ $user->name }}</p>
                                                <p>Email: {{ $user->email }}</p>
                                                <p>Phone: {{ $user->phone }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="modal-edit-{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit user</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.update.user', ['user' => $user->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            value="{{ $user->name }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="location">Email</label>
                                                        <input type="text" class="form-control" id="location"
                                                            name="location" value="{{ $user->email }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="price">Phone</label>
                                                        <input type="text" class="form-control" id="price" name="price"
                                                            value="{{ $user->phone }}">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Delete Confirmation -->
                                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete
                                                    Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete {{ $user->name }}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <span>
                                                    <form
                                                        action="{{ route('admin.delete.user', ['user' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <span class="fa fa-trash"></span> Delete
                                                        </button>
                                                    </form>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Approve Confirmation -->
                                <div class="modal fade" id="approveConfirmationModal-{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="approveConfirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveConfirmationModalLabel">Delete
                                                    Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to approve {{ $user->name }}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <span>
                                                    <form
                                                        action="{{ route('admin.approve.user', ['user' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-success">
                                                            Approve
                                                        </button>
                                                    </form>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection