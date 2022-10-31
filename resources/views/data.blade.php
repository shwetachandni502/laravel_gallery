<!doctype html>
<html>
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="header" ></div>
<div class="container" id="app">


    <h1>This is example from ItSolutionStuff.com</h1>
    <example-component     :de="{{json_encode($data)}}" ></example-component>
    <button class="btn btn-info" >click</button>
</div>
<!-- <div id="data" ></div> -->
<router-view></router-view>
<script src="js/app.js"></script>
</body>
</html>