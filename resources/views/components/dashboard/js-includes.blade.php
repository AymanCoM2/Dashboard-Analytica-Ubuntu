<script src={{ asset('plugins/common/common.min.js') }}></script>
<script src={{ asset('dashboard/js/custom.min.js') }}></script>
<script src={{ asset('dashboard/js/settings.js') }}></script>
<script src={{ asset('dashboard/js/gleek.js') }}></script>
<script src={{ asset('dashboard/js/styleSwitcher.js') }}></script>
<script src={{ asset('landing/vendor/jquery/jquery.js') }}></script>
{{-- <script src={{ asset('js/bootstrap.bundle.js.map') }}></script> --}}
<script src={{ asset('js/bootstrap.bundle.js') }}></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
<script src="{{ asset('js/vfs_fonts.js') }}"></script>

{!! Toastr::message() !!}

{{-- X_EDITABLE  --}}
<script src={{ asset('bootstrap5-editable/js/bootstrap-editable.js') }}></script>
<script type="text/javascript" src="{{ asset('js/toastify-js.js') }}"></script>
<script>
    @yield('extra-script')
</script>
