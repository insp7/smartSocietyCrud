@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/criminals"><i class="fas fa-book"></i></a></li>
    <li class="breadcrumb-item"><a href="/admin/criminals/create">Criminals</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endsection

@section('page-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Add</h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="/admin/criminals">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ old('name') }}"  name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror"></input>
                            </div>
                            @error('name')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" value="{{ old('age') }}"  name="age"  placeholder="Age" class="form-control @error('age') is-invalid @enderror"></input>
                            </div>
                            @error('age')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ old('crime_type') }}"  name="crime_type"  placeholder="Crime Type" class="form-control @error('crime_type') is-invalid @enderror"></input>
                            </div>
                            @error('crime_type')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="gender" id="gender" required class="form-control @error('gender') is-invalid @enderror">
                                <option disabled selected>Select Gender</option>
                                <option value="M" @if(old('gender') == 'M') selected @endif>Male</option>
                                <option value="F" @if(old('gender') == 'F') selected @endif>Female</option>
                                <option value="O" @if(old('gender') == 'O') selected @endif>Other</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TODO: Storing of image has to be done yet --}}
                        <div class="form-group">
                            <label class="text-sm" for="criminal_images">Criminal Images</label>
                            <div class="input-group">
                                <input type="file" id="criminal_images" name="criminal_images[]"  placeholder="Criminal Images" multiple="multiple" class="form-control @error('criminal_images') is-invalid @enderror"></input>
                            </div>
                            @error('criminal_images')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('custom-script')
    <script src="{{ asset("/js/shape/add-shape.js") }}"></script>

    @if(session()->has('type'))
        <script>
            $.notify({
                // options
                title: '<h4 style="color:white">{{ session('title') }}</h4>',
                message: '{{ session('message') }}',
            },{
                // settings
                type: '{{ session('type') }}',
                allow_dismiss: true,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 3000,
                timer: 1000,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        </script>
    @endif
@endsection
