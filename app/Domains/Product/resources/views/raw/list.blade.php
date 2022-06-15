<table class="table mb-0">
    <thead class="table-light">
        <tr>
            <th>Product Name</th>
            <th>Code</th>
            <th>Price</th>
            <th>Stock</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <tr>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary btn-action me-1" data-action="form"
                            data-url="{{ route('product.edit', $product) }}" data-method="get">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-action need-confirmation"
                            data-title="Are you sure?" data-url="{{ route('product.edit', $product) }}"
                            data-method="delete" data-text="Following product will be deleted!" data-action="list">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach

        @endif
    </tbody>
</table>
