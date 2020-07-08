<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">detail Costumer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="simpan">
            @csrf
            <div class="modal-body">
                <div class="form-group text-center">
                    <img src="{{ asset('assets/images/costumer/'.$product->image) }}" alt="" class="img-fluid">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Birth Of date :</label>
                    <input type="text" class="form-control" id="nama"
                        placeholder="" name="nama" value="{{ date('j M Y' , strtotime($product->tgl_lahir)) }}" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Gender :</label>
                    @if ($product->jenkel == 'L')
                    <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="Laki-laki" disabled>
                    @else
                    <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="Perempuan" disabled>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" id="alamat" rows="3" name="alamat" placeholder="alamat" disabled>{{ $product->alamat }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
