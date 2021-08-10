<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ATP-Checklist | {{ $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">

    <link rel="stylesheet" href="{{asset('assets/css/icons/fontawesome/styles.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mdb.lite.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweet_alert.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/modules/animations-extended.min.css')}}">

    <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/mdb.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap-datepicker/js/flatpickr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/answer.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/addons/datatables.min.js')}}"></script>
    
    <script type="text/javascript">
        var WebURL = {!! json_encode(url('/')) !!} 
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body class="preload">
    <nav class="sidenav category-nav preview">
        <div class="sidenav-content">
            <div class="sidenav-header">
                <h5>CATEGORY / SECTION</h5>
            </div>
            <div class="sidenav-body">
    
            </div>
            <div class="cover-spin-sidenav">
                <div class="spinner-border text-warning" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </nav>
    <div class="checklist-page-content">
        <div class="category-nav-backdrop"></div>
        <div class="checklist-breadcrumb">
            <nav class="navbar navbar-expand-md navbar-light bg-cl">
                <div class="float-left">
                    <a class="btn-toggle-ctg"><i class="fa fa-arrows-h"></i></a>
                </div>
            </nav>
        </div>
        <div class="checklist-container answer-checklist">
            <div class="card">
                <div class="card-body">
                    <div class="answer-checklist-info">
                        <h3>{{ $answerCL[0]->Title }}</h3>
                        <span>{{ $answerCL[0]->Description }}</span>
                    </div>
                </div>
            </div>
            <div class="checklist-body disabled">
    
            </div>
        </div>
        <div class="cover-spin-content" style="display: none;">
            <div class="spinner-border text-warning" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="aclID" id="aclID" value="{{ $answerCLID }}">
    <input type="hidden" name="active_ctgID" id="active_ctgID" value="">
</body>

</html>

