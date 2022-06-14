<table class="table mb-0">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Head</th>
            <th>Code</th>
            <th>Active</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($units->count() > 0)
            @foreach ($units as $unit)
                <tr>

                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->head }}</td>
                    <td>{{ $unit->code }}</td>
                    <td>{{ $unit->status }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary btn-edit btn-sm me-1" data-action="form"
                            data-url="{{ route('unit.edit', $unit) }}" data-method="get">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-edit btn-sm need-confirmation"
                            data-title="Are you sure?" data-url="{{ route('unit.edit', $unit) }}"
                            data-method="delete" data-text="Following unit will be deleted!" data-action="list">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach

        @endif
    </tbody>
</table>
