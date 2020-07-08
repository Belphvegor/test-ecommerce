<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="simpan">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" class="form-control" id="nama"
                        placeholder="nama product" name="nama">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Price</label>
                    <input type="number" class="form-control" id="harga"
                        placeholder="harga product" name="harga">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Stock</label>
                    <input type="number" class="form-control" id="stok"
                        placeholder="jumlah product" name="stok">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Desc</label>
                    <textarea class="form-control" id="desc" rows="3" name="desc" placeholder="deskripsi product"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#simpan').submit(function(e){
            e.preventDefault();
            $form = $(this)
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('saveproduct') }}",
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
</script>
