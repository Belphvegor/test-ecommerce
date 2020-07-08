<table class="table table-bordered table-striped" style="width: 100%;">
    <thead class="thead-dark text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kode Struk</th>
            <th scope="col">Costumer</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @forelse ($orders as $key => $item)
        <tr>
            <td>{{ $orders->firstItem() + $key }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $item->costumer->nama }}</td>
            <td><button type="button" class="btn btn-primary btn-block" onclick="detail({{ $item->id }})">Detail</button></td>
        </tr>
        @empty
        <th colspan="5" class="text-center">Order data is empty !</th>
        @endforelse
    </tbody>
</table>
<div class="text-right">
    {{ $orders->links() }}
</div>
