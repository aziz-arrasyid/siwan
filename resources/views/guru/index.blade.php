@extends('layouts.main')

@section('content')
{{-- {{ dd($studentCount) }} --}}
@if ($studentCount > 0)
<div class="row">
  <div class="col-md-6 col-lg-3">
    <div class="card card-block card-stretch card-height">
      <div class="card-body">
        <div class="top-block d-flex align-items-center justify-content-between">
          <h5>Siswa {{ $classroom->classroom_name }}</h5>
          <span class="badge badge-info">Total</span>
        </div>
        <h3>{{ $studentCount }}</h3>
      </div>
    </div>
  </div>
</div>
@endif
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
    @if(Session('login'))
    toastr.success('{{ session('login') }}');
    @endif
    })
</script>
@endpush
