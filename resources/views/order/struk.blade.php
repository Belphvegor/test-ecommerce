<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Struk Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="simpan">
            @csrf
            <div class="modal-body">
                <div class="form-group mb-2 row">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price Product</th>
                                <th scope="col" class="text-center">Number Of Products</th>
                                <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($struk->details as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>Rp. {{ number_format($item->harga, 2) }}</td>
                                <td class="text-center">{{ $item->pivot->jumlah }}</td>
                                <td>Rp. {{ number_format($item->pivot->jumlah * $item->harga, 2) }}</td>
                            </tr>
                            @endforeach
                            <th colspan="3" class="text-center">Total</th>
                            <th>Rp. {{ number_format($total, 2) }}</th>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
