@extends("admin.master")

@section("content")
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Properties</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Properties</li>
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
                                    <th>Image</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->name }}</td>
                                    {{-- @if (count($property->files) > 0)
                                    <td><img src="{{ asset('storage/images/' . $property->files[0]) }}" alt="Image"
                                            width="100px" , height="100"></td>
                                    @endif --}}
                                    @if (count($property->files) > 0)
                                    <td><img src="{{ url('storage/images/'. $property->files[0])}}" alt="{{$property->files[0]}}"
                                            width="100px" , height="100"></td>
                                    @endif
                                    <td>{{ $property->location }}</td>
                                    <td> {{ number_format($property->price, 2, '.', ',') }} TZS</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-outline-info btn-sm"
                                            data-toggle="modal" data-target="#modal-{{ $property->id }}">
                                            <span class="fa fa-eye"></span> View
                                        </button>

                                        <button type="button"
                                            class="btn btn-block btn-outline-warning btn-sm edit-property"
                                            data-toggle="modal" data-target="#modal-edit-{{ $property->id }}">
                                            <span class="fas fa-pencil-alt"></span> Edit
                                        </button>

                                        <button type="button" class="btn btn-block btn-outline-danger btn-sm"
                                            data-toggle="modal" data-target="#deleteConfirmationModal">
                                            <span class="fa fa-trash"></span> Delete
                                        </button>

                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-{{ $property->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Property Details</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Property ID: {{ $property->id }}</p>
                                                <p>Name: {{ $property->name }}</p>
                                                <p>Location: {{ $property->location }}</p>
                                                <p>Price: {{ number_format($property->price, 2, '.', ',') }} TZS</p>
                                                <p>Description: {{ $property->description }}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="modal-edit-{{ $property->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Property</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('seller.update.property', ['property' => $property->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name"
                                                            value="{{ $property->name }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="location">Location</label>
                                                        <input type="text" class="form-control" id="location"
                                                            name="location" value="{{ $property->location }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="price">Price</label>
                                                        <input type="text" class="form-control" id="price" name="price" value="{{ number_format($property->price, 2, '.', ',') }} TZS">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control" id="description"
                                                            name="description">{{ $property->description }}</textarea>
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
                                                <p>Are you sure you want to delete this item?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <span>
                                                    <form
                                                        action="{{ route('seller.delete.property', ['property' => $property->id]) }}"
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