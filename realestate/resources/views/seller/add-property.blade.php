@extends("admin.master")

@section("content")

<div class="content-wrapper-before"></div>
<div class="content-header row">
    <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Add Product</h3>
    </div>
    <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
            <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Product
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('seller.store-property') }}" enctype="multipart/form-data">
    @csrf
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section class="basic-inputs">
            <div class="row match-height">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Name</h4>
                        </div>
                        <div class="card-block">
                            <div class="card-body">
                                <fieldset class="form-group">
                                    <input type="text" name="name"
                                        class="form-control  @error('name') is-invalid @enderror" id="basicInput"
                                        placeholder="Enter name" required>
                                    <span style="color:red">
                                        @error("name")
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Location</h4>
                        </div>
                        <div class="card-block">
                            <div class="card-body">
                                <fieldset class="form-group">
                                    <input type="text" name="location" min="1"
                                        class="form-control  @error('location') is-invalid @enderror" id="basicInput"
                                        placeholder="Enter location" required>
                                    <span style="color:red">
                                        @error("location")
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->

        <!-- Basic Inputs start -->
        <section class="basic-inputs">
            <div class="row match-height">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Selling Price</h4>
                        </div>
                        <div class="card-block">
                            <div class="card-body">
                                <fieldset class="form-group">
                                    <input type="number" name="price"
                                        class="form-control  @error('price') is-invalid @enderror" id="placeholderInput"
                                        placeholder="Enter selling price" required>
                                    <span style="color:red">
                                        @error("price")
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Available</h4>
                        </div>
                        <div class="card-block">
                            <div class="card-body">
                                <fieldset class="form-group">
                                    <label class="switch">
                                        <input type="checkbox" name="is_available" value="1">
                                        <span class="slider round"></span>
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->

        <section class="textarea-select">
            <!-- Textarea start -->
            <div class="row match-height">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Description</h4>
                        </div>
                        <div class="card-block">
                            <div class="card-body">
                                <h5 class="">Description (min. 20 characters)</h5>
                                <fieldset class="form-group">
                                    <textarea class="form-control  @error('description') is-invalid @enderror"
                                        name="description" id="placeTextarea" rows="3" placeholder="Simple Textarea"
                                        required></textarea>
                                    <span style="color:red">
                                        @error("description")
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </fieldset>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pictures</h4>
                        </div>
                        <div class="card-block">
                            <div class="card-body">
                                <p>Pictures (min 3 )<code> png, jpg, jpeg</code> are accepted.</p>
                                <fieldset class="form-group">
                                    <input type="file" name="files[]"
                                        class="form-control  @error('files') is-invalid @enderror" id="basicInput"
                                        multiple="" required>
                                    {{-- <input type="file" name="files[]" id="avatar"
                                        class="form-control  @error('files') is-invalid @enderror" id="basicInput"
                                        multiple="" required /> --}}
                                    <span style="color:red">
                                        @error("files")
                                        {{ $message }}
                                        @enderror
                                    </span>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-min-width mr-1 mb-1 float-right">Submit</button>


            <!-- Textarea end -->
        </section>
    </div>
</form>

<!-- ////////////////////////////////////////////////////////////////////////////-->
@endsection