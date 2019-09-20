@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/insiders"><i class="fas fa-book"></i></a></li>
    <li class="breadcrumb-item"><a href="/admin/insiders/create">Insiders</a></li>
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
                    <form method="post" enctype="multipart/form-data" action="/admin/insiders">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" value="{{ old('name') }}"  name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                                    </div>
                                    @error('name')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" value="{{ old('email') }}"  name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" value="{{ old('password') }}"  name="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror"></input>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" value="{{ old('block_no') }}"  name="block_no"  placeholder="Block No." class="form-control @error('block_no') is-invalid @enderror"></input>
                                    </div>
                                    @error('block_no')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" value="{{ old('building_no') }}"  name="building_no"  placeholder="Building No." class="form-control @error('building_no') is-invalid @enderror"></input>
                                    </div>
                                    @error('building_no')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" value="{{ old('age') }}"  name="age"  placeholder="Age" class="form-control @error('age') is-invalid @enderror"></input>
                                    </div>
                                    @error('age')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
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
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-sm" for="insider_images">Insider Images</label>
                            <div class="input-group">
                                <input type="file" id="insider_images" name="insider_images[]"  placeholder="Insider Images" multiple="multiple" class="form-control @error('insider_images') is-invalid @enderror"></input>
                            </div>
                            @error('insider_images')
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
