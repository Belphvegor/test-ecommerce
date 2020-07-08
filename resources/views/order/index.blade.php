@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <h2 class="mt-5">List Order</h2><br>

    <div class="table-responsive" id="tabelorder">

    </div>
@endsection

@section('js')
<script>
     $(document).ready(function() {
        loaddata(1);
    });

    function loaddata(page) {
        $.ajax({
            url: "{{ url('admin/order/list') }}?page=" + page + "",
            data: {
            },
            method: 'GET',
            success: function (data) {
                if (data.status) {
                    $("#tabelorder").html(data.html);
                } else {
                    $("#tabelorder").html("");
                }
            },
            error: function (data) {
            }
        });
    }

    function detail(id) {
        $.ajax({
            url: "{{ route('detailorder') }}",
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

    // function edit(id) {
    //     $.ajax({
    //         url: "{{ route('editproduct') }}",
    //         data: {
    //             csrfmiddlewaretoken: '{{ csrf_field() }}',
    //             id: id,
    //         },
    //         method: 'GET',
    //         success: function (data) {
    //             if (data.status) {
    //                 $('#exampleModalLong').html('');
    //                 $("#exampleModalLong").html(data.html);
    //                 $("#exampleModalLong").modal('show', {
    //                     backdrop: 'true'
    //                 });
    //             } else {
    //                 $('#exampleModalLong').html('');
    //             }
    //         },
    //         error: function (data) {

    //         }
    //     });
    // }

    // function Delete(id) {
    //     $.ajax({
    //         method: "DELETE",
    //         url: "{{ route('deleteproduct') }}",
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         data: {
    //             id_data: id,
    //         },
    //         dataType: "JSON",
    //         success: function (response) {
    //             loaddata(1)
    //             alert(response.message)
    //         }
    //     });
    // }
</script>
@endsection

@section('modals')
<div class="modal fade" id="exampleModalLong" aria-hidden="true" style="display: none;">

</div>
@endsection
