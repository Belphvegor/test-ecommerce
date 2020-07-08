<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <title>@yield('title')</title>
  </head>
  <body>
    @include('layouts.partials.nav')
    <main role="main" class="container">
        @yield('content')
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loaddata(page);
        });

        function formProduct() {
            $.ajax({
                url: "{{ route('formproduct') }}",
                data: {
                    csrfmiddlewaretoken: '{{ csrf_field() }}',
                },
                method: 'GET',
                success: function (data) {
                    if (data.status) {
                        $('#exampleModalLong').html('');
                        $("#exampleModalLong").html(data.html);
                        $("#exampleModalLong").modal('show', {
                            backdrop: 'true'
                        });
                    } else {
                        $('#exampleModalLong').html('');
                    }
                },
                error: function (data) {

                }
            });
        }

        function formCostumer() {
            $.ajax({
                url: "{{ route('formcostumer') }}",
                data: {
                    csrfmiddlewaretoken: '{{ csrf_field() }}',
                },
                method: 'GET',
                success: function (data) {
                    if (data.status) {
                        $('#exampleModalLong').html('');
                        $("#exampleModalLong").html(data.html);
                        $("#exampleModalLong").modal('show', {
                            backdrop: 'true'
                        });
                    } else {
                        $('#exampleModalLong').html('');
                    }
                },
                error: function (data) {

                }
            });
        }

        function formOrder() {
            $.ajax({
                url: "{{ route('cformorder') }}",
                data: {
                    csrfmiddlewaretoken: '{{ csrf_field() }}',
                },
                method: 'GET',
                success: function (data) {
                    if (data.status) {
                        $('#exampleModalLong').html('');
                        $("#exampleModalLong").html(data.html);
                        $("#exampleModalLong").modal('show', {
                            backdrop: 'true'
                        });
                    } else {
                        $('#exampleModalLong').html('');
                    }
                },
                error: function (data) {

                }
            });
        }


    </script>
    @yield('js')

    @yield('modals')
  </body>
</html>
