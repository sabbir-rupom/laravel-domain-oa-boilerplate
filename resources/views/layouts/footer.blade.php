<input type="hidden" id="baseUrl" value="{{ url('/') }}">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="{!! url('assets/js/app.min.js') !!}"></script>
<script src="{!! url('assets/js/plugin/demo.min.js') !!}"></script>

@yield('script-bottom')

<footer class="footer">
    <div class="d-flex justify-content-center py-3">
        <script>
            document.write(new Date().getFullYear())
        </script>
        © Laravel DOA Boilerplate
    </div>
</footer>