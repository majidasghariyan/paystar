
@if (Session::has('alert_message'))
    <script>
        Swal.fire({
            position: 'center',
            icon: "{{Session::get('alert_level')}}",
            text: "{{Session::get('alert_message')}}",
            showConfirmButton: false,
            timer: 2000
            // showCloseButton: true
        })
    </script>
@endif
