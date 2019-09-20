@extends('layouts.base')

@section('page-content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Insiders</h6>
                            <h5 class="h3 mb-0">{{ $insider_count }}</h5>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Criminals</h6>
                            <h5 class="h3 mb-0">{{ $criminal_count }}</h5>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">News Feeds</h6>
                            <h5 class="h3 mb-0">{{ $news_feed_count }}</h5>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Users</h6>
                            <h5 class="h3 mb-0">{{ $user_count }}</h5>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Criminal Images</h6>
                            <h5 class="h3 mb-0">{{ $criminal_image_count }}</h5>
                        </div>
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Insider Images</h6>
                            <h5 class="h3 mb-0">{{ $criminal_insider_count }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')

    <!-- Optional JS -->
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
