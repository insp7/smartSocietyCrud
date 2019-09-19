@extends('layouts.base')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="h3 mb-0">News Feed</h5>
                </div>

                @foreach($news_feeds as $news_feed)

                    {{-- Start of news Feed --}}
                    <div class="card-header d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="mx-3">
                                <a href="#" class="text-dark font-weight-600 text-sm">{{ $news_feed->title }}</a>
                                <small class="d-block text-muted">{{ $news_feed->created_at }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">
                            <?php echo($news_feed->description); ?>
                        </p>
                        <?php
                        $news_feed_images = \App\NewsFeedImage::where('news_feed_id' , $news_feed->id)->get();
                        ?>
                        <div class="owl-carousel owl-theme">
                            @foreach($news_feed_images as $news_feed_image)
                                <div class="item"><img alt="Image placeholder"  src="{{asset($news_feed_image->image_path)}}" style="display: block;width: 100%;
    height: auto;"></div>
                            @endforeach
                        </div>


                        <div class="row align-items-center my-3 pb-3 border-bottom">
                            <div class="col-sm-6">
                                <div class="icon-actions">
                                    <a href="#" class="like active">
                                        <i class="ni ni-like-2"></i>
                                        <span class="text-muted">150</span>
                                    </a>
                                    <a href="#">
                                        <i class="ni ni-chat-round"></i>
                                        <span class="text-muted">36</span>
                                    </a>
                                    <a href="#">
                                        <i class="ni ni-curved-next"></i>
                                        <span class="text-muted">12</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <div class="d-flex align-items-center justify-content-sm-end">
                                    <div class="avatar-group">
                                        <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg" class="">
                                        </a>
                                        <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Audrey Love">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg" class="rounded-circle">
                                        </a>
                                        <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg" class="rounded-circle">
                                        </a>
                                    </div>
                                    <small class="pl-2 font-weight-bold">and 30+ more</small>
                                </div>
                            </div>
                        </div>
                        <!-- Comments -->
                        <div class="mb-1">
                            <div class="media media-comment">
                                <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="../../assets/img/theme/team-1.jpg">
                                <div class="media-body">
                                    <div class="media-comment-text">
                                        <h6 class="h5 mt-0">Michael Lewis</h6>
                                        <p class="text-sm lh-160">Cras sit amet nibh libero nulla vel metus scelerisque ante sollicitudin. Cras purus odio vestibulum in vulputate viverra turpis.</p>
                                        <div class="icon-actions">
                                            <a href="#" class="like active">
                                                <i class="ni ni-like-2"></i>
                                                <span class="text-muted">3 likes</span>
                                            </a>
                                            <a href="#">
                                                <i class="ni ni-curved-next"></i>
                                                <span class="text-muted">2 shares</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="media media-comment">
                                <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="../../assets/img/theme/team-2.jpg">
                                <div class="media-body">
                                    <div class="media-comment-text">
                                        <h6 class="h5 mt-0">Jessica Stones</h6>
                                        <p class="text-sm lh-160">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                        <div class="icon-actions">
                                            <a href="#" class="like active">
                                                <i class="ni ni-like-2"></i>
                                                <span class="text-muted">10 likes</span>
                                            </a>
                                            <a href="#">
                                                <i class="ni ni-curved-next"></i>
                                                <span class="text-muted">1 share</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="media align-items-center">
                                <img alt="Image placeholder" class="avatar avatar-lg rounded-circle mr-4" src="../../assets/img/theme/team-3.jpg">
                                <div class="media-body">
                                    <form>
                                        <textarea class="form-control" placeholder="Write your comment" rows="1"></textarea>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
            {{--  End OF News Feed --}}

        </div>
    </div>

@endsection

@section ('custom-script')
    <script src="{{ asset("/js/shape/add-shape.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            nav: true,
            items: 1,
            autoplay: true,
            autoplayTimeout: 300000, // change image every 30 seconds
            loop: true
        });
    </script>
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
