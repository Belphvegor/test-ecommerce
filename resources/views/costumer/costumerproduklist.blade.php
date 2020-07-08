<table class="table table-bordered table-striped" style="width: 100%;">
    <thead class="thead-dark text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @forelse ($products as $key => $item)
        <tr>
            <td>{{ $products->firstItem() + $key }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->stok }}</td>
            <td><button type="button" class="btn btn-primary btn-block" onclick="detail({{ $item->id }})">Detail</button></td>
        </tr>
        @empty
        <th colspan="5" class="text-center">Product data is empty !</th>
        @endforelse
    </tbody>
</table>
<div class="text-right">
    {{ $products->links() }}
</div>
