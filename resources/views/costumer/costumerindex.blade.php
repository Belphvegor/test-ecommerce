@extends('layouts.master')

@section('title', 'Product')

@section('content')
    <h2 class="mt-5">List Product</h2><br>

    <div class="table-responsive" id="tabelproduct">

    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        loaddata(1);
    });

    function loaddata(page) {
        $.ajax({
            url: "{{ url('costumer/list') }}?page=" + page + "",
            data: {
            },
            method: 'GET',
            success: function (data) {
                if (data.status) {
                    $("#tabelproduct").html(data.html);
                } else {
                    $("#tabelproduct").html("");
                }
            },
            error: function (data) {
            }
        });
    }

    function detail(id) {
        $.ajax({
            url: "{{ route('cdetailproduct') }}",
            data: {
                csrfmiddlewaretoken: '{{ csrf_field() }}',
                id: id,
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
@endsection

@section('modals')
<div class="modal fade" id="exampleModalLong" aria-hidden="true" style="display: none;">

</div>
@endsection
