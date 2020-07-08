<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="simpan">
            @csrf
            <div class="modal-body">
                <div class="form-group form-inline" id="product">
                    <label for="exampleFormControlSelect1" class="mr-3">Product :</label>
                    <select class="js-example-basic-single" name="products[]" style="width: 50%;">
                        @foreach ($products as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select><span class="ml-3">X</span>
                    <input type="number" name="jumlah[]" class="form-control ml-3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-info" onclick="addProduct()">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();

        $('#simpan').submit(function(e){
            e.preventDefault();
            $form = $(this)
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('csaveorder') }}",
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response)
                    if (response.status == true) {
                        alert(response.message)
                        loaddata(1);
                        $('#exampleModalLong').modal('toggle');
                        $('#exampleModalLong').html('');
                        // location.reload(true);
                    } else {
                        alert(response.message)
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

    });

    function addProduct() {
        var form = $.parseHTML("<label for='exampleFormControlSelect1' class='mr-3'>Product :</label><select class='js-example-basic-single' name='products[]' style='width: 50%;'>@foreach ($products as $item)<option value='{{ $item->id }}'>{{ $item->nama }}</option> @endforeach</select><span class='ml-3'>X</span><input type='number' name='jumlah[]' class='form-control ml-3'>")
        $("#product").append(form);
    }

</script>
