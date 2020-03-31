<script src="{{asset('admin/scripts/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('admin/scripts/sharrre.js')}}"></script>
<script src="{{asset('admin/scripts/datepicker.js')}}"></script>
{{--<script src="{{asset('admin/scripts/chart.js')}}"></script>--}}
<script src="{{asset('admin/scripts/popper.min.js')}}"></script>
<script src="{{asset('admin/scripts/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/scripts/bootbox.all.min.js')}}"></script>
{{--<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>--}}
<script src="{{asset('admin/scripts/extras.1.1.0.min.js')}}"></script>
<script src="{{asset('admin/scripts/charts.js')}}"></script>
<script src="{{asset('admin/scripts/shards-dashboards.1.1.0.min.js')}}"></script>
{{--<script src="{{asset('admin/scripts/app/app-blog-overview.1.1.0.js')}}"></script>--}}
<script src="{{asset('js/toastr.js')}}"></script>
<script src="{{asset('admin/scripts/bootstrap-toggle.js')}}"></script>
<script src="{{asset('admin/scripts/select2.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    toastr.options.closeButton = true;
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}");
    @endif

    @if(Session::has('warning'))
    toastr.info("{{Session::get('warning')}}");
    @endif

</script>
