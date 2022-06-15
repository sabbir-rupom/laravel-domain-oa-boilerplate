<div class="card">
    <div class="card-body">
        <h5 class="fw-bold text-center mb-4">Product Create Form</h5>

        <form class="form-ajax needs-validation" action="{{ route('product.store') }}" method="POST"
            novalidate="novalidate">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Name <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" autocomplete="off" required
                        placeholder="Enter text here">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Code <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="code" class="form-control" autocomplete="off" required
                        placeholder="Enter unique code">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Stock <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="number" name="stock" class="form-control" autocomplete="off" required
                        placeholder="Enter number" min="0">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Price
                </label>
                <div class="col-sm-9">
                    <input type="number" step="any" name="price" class="form-control" autocomplete="off" required
                        value="0.0" min="0">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <input type="hidden" name="id" value="" />
                <button type="submit" class="btn btn-success w-md me-2" disabled>Save</button>
                <button type="button" class="btn btn-warning w-md form-reset">Reset</button>
            </div>
        </form>

    </div>
</div>
