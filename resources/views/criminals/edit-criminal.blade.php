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
                    <h3 class="mb-0">Edit</h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <form method="post" action="/admin/criminals/{{ $criminal->id }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ $criminal->user->name }}"  name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror"></input>
                            </div>
                            @error('name')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" value="{{ $criminal->user->age }}"  name="age"  placeholder="Age" class="form-control @error('age') is-invalid @enderror"></input>
                            </div>
                            @error('age')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ $criminal->crime_type }}"  name="crime_type"  placeholder="Crime Type" class="form-control @error('crime_type') is-invalid @enderror"></input>
                            </div>
                            @error('crime_type')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="gender" id="gender" required class="form-control @error('gender') is-invalid @enderror">
                                <option disabled selected>Select Gender</option>
                                <option value="M" @if($criminal->user->gender == 'M') selected @endif>Male</option>
                                <option value="F" @if($criminal->user->gender == 'F') selected @endif>Female</option>
                                <option value="O" @if($criminal->user->gender == 'O') selected @endif>Other</option>
                            </select>
                            @error('gender')
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

