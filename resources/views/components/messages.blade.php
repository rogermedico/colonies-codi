@if (session()->has('message'))
    <div class='alert alert-success alert-dismissible fade show'>
        {!!session()->pull('message')!!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('warning'))
    <div class='alert alert-warning alert-dismissible fade show'>
        {!!session()->pull('warning')!!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('error'))
    <div class='alert alert-danger alert-dismissible fade show'>
        {!!session()->pull('error')!!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
