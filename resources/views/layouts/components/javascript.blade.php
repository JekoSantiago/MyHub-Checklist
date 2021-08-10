<!-- Javascript -->
<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/mdb.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap-datepicker/js/flatpickr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugins/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dropzone.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/custom.js')}}"></script>
<script type="text/javascript">
    var WebURL = {!! json_encode(url('/')) !!}; 
</script>

<!-- Custom Javascript -->
@yield('js')