@if ($errors->any())
    <div class="alert alert-change-ul alert-danger font-weight-light h5 pt-2 text-center" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="p-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').slideUp(400, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
@endif
@if(session('error'))
    <div class="alert alert-danger font-weight-light pt-2 h5  text-center" role="alert">
        {{ session('error') }}
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').slideUp(400, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
@endif

