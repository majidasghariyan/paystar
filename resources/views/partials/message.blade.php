@if(session('message'))
    <div class="alert alert-success font-weight-light h2 p-4 text-center mb-4" role="alert">
        {{ session('message') }}
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