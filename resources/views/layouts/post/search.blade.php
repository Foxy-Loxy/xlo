@extends('layouts.master')

@section('content')
<div class="container">
    <form action="/result" method="GET">
        <div class="row input-row">
            <div class="col-6">
                <div><p>Title</p></div>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-6">
                <div><p>Body</p></div>
                <input type="text" name="body" id="body" class="form-control">
            </div>
        </div>

        <div class="row input-row">
            <div class="col-6">
                <div><p>Category</p></div>
                <input type="text" name="category_id" id="category_id" class="form-control">
            </div>
            <div class="col-6">
                <div><p>City</p></div>
                <input type="text" name="city_id" id="city_id" class="form-control">
            </div>
        </div>
        <div class="row input-row text-center">
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('page_styles')
    <style>
        .row{
            text-align:center;
        }

        .input-row{
            padding-top: 25px;
            padding-bottom: 25px;
        }
    </style>
    <link rel="stylesheet" href="/js/autosuggest/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="/js/autosuggest/styles/token-input-facebook.css" type="text/css" />
@endsection

@section('page_scripts')
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/autosuggest/src/jquery.tokeninput.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#city_id").tokenInput("/get/cities", {
                tokenLimit : 1
            });
        });

        $(document).ready(function () {
           $("#category_id").tokenInput("/get/categories", {
              tokenLimit : 1
           });
        });
    </script>
@endsection
