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
                    <img src="{{ asset('assets/images/product/'.$product->image) }}" alt="" class="img-fluid">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Desc</label>
                    <textarea class="form-control" id="desc" rows="3" disabled>{{ $product->desc }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
