@extends('layouts.master')

@section('content')
    <div class="container post">
        <div class="row">
            <div class="col-8">
                <h3> {{ $post->title }}</h3>
                @if (auth()->check())
                    <form style="display:inline-block" method="GET" action="/home/favourites/{{ $post->id }}">
                        {{csrf_field()}}
                        <button type="submit"
                                class="btn @if(\App\Favourite::where('post_id', $post->id)->where('user_id', auth()->id())->exists()) {{ 'btn-primary' }} @else {{ 'btn-secondary' }} @endif">
                            <i class="far fa-star"></i>
                        </button>
                    </form>
                @endif
                <p> By {{ $post->user->name }} at {{ $post->created_at }} in {{ $post->category->category_name }}</p>
                <hr>
                <p> {{ $post->body }}</p>
            </div>
            <div class="col-4">
                @foreach($post->photo as $photo)
                    <img class="img-fluid img-rounded" src="/storage/{{ $photo->photo_url }}"></a>
                    <br>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <p class="text-center">Price: {{ $post->price }} UAH</p>
                <br>
                <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                </script>
                <p class="text-center">Contact: <span id="phone-number"></span><input type="submit" id="phone"
                                                                                      value="Get Phone"></p>
            </div>
        </div>
        @if (($post->user->id == auth()->id()) || ($post->user->isadmin == true))
            <hr>
            <h2 class="text-center">Statistics</h2>
            <div class="row" style="text-align: center">
                <div class="col-4">Visits: {{ $post->views }}</div>
                <div class="col-4">Saved to favourites: {{ $post->favourites }}</div>
                <div class="col-4">Active till: {{ $post->deactiveDate() }}</div>
            </div>
            <hr>
            <div class="row" style="text-align: center">
                <div class="col-12">
                    <form style="display:inline-block" method="POST" action="/post/{{ $post->id }}">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                    <form style="display:inline-block" method="GET" action="/post/{{ $post->id }}/edit">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-success">
                            <i class="far fa-edit"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-md-4">
                    <hr>
                    <?php
                        $views = new \App\PostEvent;
                        $views = $views->where('post_id', $post->id)->where('type', '1')->orderby('created_at', 'asc')->get();
                        $dates = array();
                        $working_dates = array();
                        foreach ($views as $view){
                            array_push($working_dates, $view->created_at->format('y-m-d'));
                            array_push($dates, $view->created_at->format('d/m'));
                        }
                        $dates = array_unique($dates, SORT_REGULAR);
                        $working_dates = array_unique($working_dates, SORT_REGULAR);

                        $view_count = array();
                        $phone_count = array();
                        $fav_count = array();
                        foreach ($working_dates as $date) {
                            $events = new \App\PostEvent;
                            $carbon_date = \Carbon\Carbon::parse($date);
                            $carbon_date->toDateString();
                            $views_obj = $events->where('type', '1')->where('post_id', $post->id)->whereDate('created_at', '=', $carbon_date->toDateString())->get();
                            $phones_obj = $events->where('type', '3')->where('post_id', $post->id)->whereDate('created_at', '=', $carbon_date->toDateString())->get();
                            $favourites_obj = $events->where('type', '2')->where('post_id', $post->id)->whereDate('created_at', '=', $carbon_date->toDateString())->get();
                            $v = 0;
                            $p = 0;
                            $f = 0;
                            foreach ($views_obj as $view)
                                $v++;
                            foreach ($phones_obj as $phone)
                                $p++;
                            foreach ($favourites_obj as $fav)
                                $f++;
                            array_push($view_count, $v);
                            array_push($phone_count, $p);
                            array_push($fav_count, $f);
                        }



                    ?>
                    <h2 class="text-center"> Chart Statistics</h2>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
                    <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                    <script>new Chart(document.getElementById("chartjs-0"), {
                            "type": "line",
                            "data": {
                                "labels": [@foreach($dates as $date) {!!'\'' . $date  . '\','!!} @endforeach],
                                "datasets": [{
                                    "label": "Views",
                                    "data": [@foreach($view_count as $views) {!! $views . ',' !!} @endforeach],
                                    "fill": false,
                                    "borderColor": "rgb(75, 192, 192)",
                                    "lineTension": 0.1
                                } ,{
                                    "label": "Favourites",
                                    "data": [@foreach($phone_count as $phone) {!! $phone . ',' !!} @endforeach],
                                    "fill": false,
                                    "borderColor": "rgb(208,10,137 )",
                                    "lineTension": 0.1
                                }, {
                                    "label": "Phone Reveals",
                                    "data": [@foreach($fav_count as $fav) {!! $fav . ',' !!} @endforeach],
                                    "fill": false,
                                    "borderColor": "rgb(182,254,29 )",
                                    "lineTension": 0.1
                                }]
                            },
                            "options": {}
                        });</script>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('page_styles')
    <style>
        img {
            width: 100%;
            height: auto;
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        .post {
            padding-top: 20px;
        }
    </style>
@endsection

@section('page_scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#phone', function () {
                $.ajax({
                    type: 'POST',
                    url: '/ajax/phone/{{ $post->id }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $("#phone-number").html(data.phone);
                        $("#phone").css('display', 'none');
                    }
                });
            });
        });
    </script>
@endsection