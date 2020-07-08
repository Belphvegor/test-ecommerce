<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Costumer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="simpan">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name :</label>
                    <input type="text" class="form-control" id="nama"
                        placeholder="nama product" name="nama" value="{{ $product->nama }}">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Birth Of Date :</label>
                    <input type="date" class="form-control" id="tgl_lahir"
                        placeholder="tanggal lahir" name="tgl_lahir" value="{{ $product->tgl_lahir }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Phone Number :</label>
                    <input type="number" class="form-control" id="no_hp"
                        placeholder="nomor handphone" name="no_hp" value="{{ $product->no_hp }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Gender :</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="jenkel">
                        @if ($product->jenkel == 'L')
                        <option value="L" selected>Male</option>
                        <option value="P">Female</option>
                        @else
                        <option value="L">Male</option>
                        <option value="P" selected>Female</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email :</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" name="email" value="{{ $product->email }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" id="alamat" rows="3" name="alamat" placeholder="alamat">{{ $product->alamat }}</textarea>
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
                url: "{{ route('updatecostumer') }}",
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
