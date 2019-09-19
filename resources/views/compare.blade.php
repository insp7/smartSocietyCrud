@extends('layouts.base')

@section('page-content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Compare</h6>
                            <h5 class="h3 mb-0" style="display: inline">Result:</h5><span id="result">100</span>%
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/compareimage" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Photo1</label><br>
                                <input name="file1" type="file" id="image1">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label for="">Photo2</label><br>
                            <input  name="file2" type="file" id="image2">
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary">Compare</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    {{--<script>--}}

         {{--function Main() {--}}

            {{--const file1 = document.querySelector('#image1')[0];--}}
            {{--const file2 = document.querySelector('#image2')[0];--}}

             {{--var formdata = new FormData($('#img_form')[0]);--}}
             {{--// formdata.append('img_1',file1);--}}
             {{--// formdata.append('img_2',file2);--}}


             {{--$.ajax({--}}
                 {{--url: 'http://facexapi.com/get_image_attr?face_det=1', //face attribute url--}}
                 {{--type: 'POST',--}}
                 {{--data: formdata,--}}
                 {{--async: false,--}}
                 {{--cache: false,--}}
                 {{--contentType: false,--}}
                 {{--processData: false,--}}
                 {{--headers:{"user_id" : "ef445d0f6e991c42170d",--}}
                     {{--"user_key" : "7c7121137013e1fbbb94"},--}}
                 {{--success: function (returndata) {--}}
                     {{--$("#result").html(result.confidence);--}}
                 {{--}--}}
             {{--});--}}

        {{--}--}}




        {{--$("#submit").click(function () {--}}

            {{--Main();--}}
        {{--});--}}
    {{--</script>--}}
@endsection
