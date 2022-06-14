<div class="card">
    <div class="card-body">
        <div class="card-title">
            {{ $title }}
        </div>

        <form class="form-ajax needs-validation" action="{{ route('unit.save') }}" method="POST" 
            novalidate="novalidate">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Name <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" autocomplete="off" required placeholder="Enter text here">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Code <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="code" class="form-control" autocomplete="off" required placeholder="Enter unique code">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Unit Head <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <x-form.element.select-single name="head" type="select" id="select--unitHead" :dataArray="$heads" required />
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Active ?
                </label>
                <div class="col-sm-9">
                    <div class="form-check form-check-primary pt-2">
                        <input class="form-check-input" value="1" name="status" type="checkbox" >
                    </div>
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
