<div class="card">
    <div class="card-body">
        <div class="card-title">
            {{ $title }}
        </div>

        <form class="form-ajax needs-validation adjust-list" action="{{ route('unit.edit', $unit) }}" method="POST"
            novalidate="novalidate">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Name <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" value="{{ $unit->name }}" required placeholder="Enter text here">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Code <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="code" value="{{ $unit->code }}" class="form-control" required placeholder="Enter unique code">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Unit Head <sup class="text-danger">*</sup>
                </label>
                <div class="col-sm-9">
                    <x-form.element.select-single value="{{ $unit->head }}" name="head" type="select" id="select--unitHead" :dataArray="$heads" required />
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">
                    Active ?
                </label>
                <div class="col-sm-9">
                    <div class="form-check form-check-primary pt-2">
                        <input class="form-check-input" value="1" {{ $unit->status ? 'checked' : '' }} name="status" type="checkbox">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <input type="hidden" name="id" value="{{ $unit->id }}" />
                <button type="submit" class="btn btn-success w-md me-2">Save</button>
                <button type="button" class="btn btn-warning w-md form-reset" 
                data-url="{{ route('unit.form') }}"
                data-action="form"
                >Reset</button>
            </div>
        </form>

    </div>
</div>
