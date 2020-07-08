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
            url: "{{ url('admin/product/list') }}?page=" + page + "",
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
            url: "{{ route('detailproduct') }}",
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

    function edit(id) {
        $.ajax({
            url: "{{ route('editproduct') }}",
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

    function Delete(id) {
        $.ajax({
            method: "DELETE",
            url: "{{ route('deleteproduct') }}",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            data: {
                id_data: id,
            },
            dataType: "JSON",
            success: function (response) {
                loaddata(1)
                alert(response.message)
            }
        });
    }
</script>
@endsection

@section('modals')
<div class="modal fade" id="exampleModalLong" aria-hidden="true" style="display: none;">

</div>
@endsection
