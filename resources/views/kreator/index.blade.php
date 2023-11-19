@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Berita</h5>
                    <span class="badge badge-primary">Total</span>
                </div>
                <h3>{{ $countBerita }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        // toastr:: success notification
        @if(Session('login'))
        toastr.success('{{ session('login') }}');
        @endif

    })
</script>
@endpush
