@extends('layouts.base')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/admin/insiders"><i class="fas fa-book"></i></a></li>
    <li class="breadcrumb-item"><a href="/admin/insiders/create">Insiders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    <form method="POST" enctype="multipart/form-data" action="/admin/insiders/{{ $insider->id }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ $insider->user->name }}"  name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
                            </div>
                            @error('name')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ $insider->user->email }}"  name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                            </div>
                            @error('email')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ $insider->user->age }}"  name="age" placeholder="Age" class="form-control @error('age') is-invalid @enderror">
                            </div>
                            @error('age')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" value="{{ $insider->user->gender }}"  name="gender" placeholder="Gender" class="form-control @error('gender') is-invalid @enderror">
                            </div>
                            @error('gender')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" value="{{ $insider->block_no }}"  name="block_no" placeholder="Block No." class="form-control @error('block_no') is-invalid @enderror">
                            </div>
                            @error('block_no')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" value="{{ $insider->building_no }}"  name="building_no" placeholder="Building No." class="form-control @error('building_no') is-invalid @enderror">
                            </div>
                            @error('building_no')
                            <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-success" type="submit">Update</button>
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
