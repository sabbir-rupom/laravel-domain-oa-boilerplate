<!-- Load Essential JavaScript Library Files -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/toastr/toastr.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

@yield('script-top')

<!-- Load Required js -->
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@yield('script-bottom')
