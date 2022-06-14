@if (session('status') )
<div class="alert alert-danger alert-dismissible fade show mt-1 mb-3" role="alert">
    <i class="mdi mdi-block-helper me-2"></i>
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mt-1 mb-3" role="alert">
    <i class="mdi mdi-check-all me-2"></i>
    {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-warning alert-dismissible fade show mt-1 mb-3" role="alert">
    <i class="mdi mdi-check-all me-2"></i>
    {{ session()->get('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif --}}