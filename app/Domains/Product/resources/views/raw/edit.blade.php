<div class="card">
    <div class="card-body">
        <h5 class="fw-bold text-center mb-4">Product Edit Form</h5>

        <form class="form-ajax needs-validation" action="{{ route('product.update', $product) }}" method="POST"
            novalidate="novalidate">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Name <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <x-form.element.text-input name="name" value="{{ $product->name }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Code <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <x-form.element.text-input name="code" value="{{ $product->code }}" required />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Stock <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}"
                        autocomplete="off" required min="0">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Price
                </label>
                <div class="col-sm-9">
                    <input type="number" step="any" name="price" class="form-control" autocomplete="off" required
                        value="{{ $product->price }}" min="0">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <input type="hidden" name="id" value="{{ $product->id }}" />
                <button type="submit" class="btn btn-success w-md me-2">Save</button>
                <button type="button" class="btn btn-warning w-md form-reset" data-url="{{ route('product.form') }}"
                    data-action="form">Reset</button>
            </div>
        </form>

    </div>
</div>
