@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-sm-12 col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
    <div class="header-title">
      <h4 class="card-title">{{ $dataTitle }}</h4>
    </div>
    <div class="pl-3 btn-new border-left">
      <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target=".modal-add-data">{{ $addData }}</button>
    </div>
    </div>
    <div class="card-body">
    <div class="table-responsive rounded bg-white">
      <table id="tableYearSemesters" class="table data-table table-striped">
      <thead>
        <tr class="light">
        <th>#</th>
        <th>Nama Pelanggaran</th>
        <th>Poin Pelanggaran</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($violations as $violation)
        <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $violation->nama_pelanggaran }}</td>
        <td>{{ $violation->poin_pelanggaran }}</td>
        <td>
          <div class="btn-group btn-group-toggle btn-group-flat">
          <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $violation->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
          <a class="button btn button-icon bg-danger deleteData" data-id="{{ $violation->id }}" href="#">Delete</a>
          </div>
        </td>
        </tr>
        @endforeach
      </tbody>
      </table>
    </div>

    <!-- Modal for Add Data -->
    <div class="modal fade modal-add-data" id="modal-add-data" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{ $addData }}</h5>
        <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('violations.store') }}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
          <label class="h5">Nama Pelanggaran</label>
          <input type="text" class="form-control" name="nama_pelanggaran" placeholder="Nama Pelanggaran">
          </div>
          <div class="form-group">
          <label class="h5">Poin Pelanggaran</label>
          <input type="number" class="form-control" name="poin_pelanggaran" placeholder="Poin Pelanggaran">
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        </div>
      </div>
      </div>
    </div>
    <!-- Modal for Add Data -->
    </div>
  </div>
  </div>
</div>

<!-- Modal for Edit Data -->
<div class="modal fade modal-edit-data" tabindex="-1" id="modal-edit-data" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">{{ $editData }}</h5>
    <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form id="violationForm-edit">
      @csrf
      @method('PUT')
      <div class="form-group">
      <label class="h5">Nama Pelanggaran</label>
      <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran">
      </div>
      <div class="form-group">
      <label class="h5">Poin Pelanggaran</label>
      <input type="text" class="form-control" id="poin_pelanggaran" name="poin_pelanggaran">
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal">Close</button>
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
  </div>
</div>
<!-- Modal for Edit Data -->

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
    //reload when x-modal & close-modal
    $(document).on('click', '#close-modal, #x-modal', function() {
        window.location.reload();
    })
    //ketika pencet diluar modal maka reload halaman
    $(document).click(function(e) {
        if($(e.target).is('#modal-add-data, #modal-edit-data'))
        {
            window.location.reload();
        }
    })
  //fungsi delete
  $('.deleteData').on('click', function(event) {
    event.preventDefault();
    Swal.fire({
    title: 'Apa kamu ingin hapus data?',
    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Iya, saya mau hapus!'
    }).then((result) => {
    if (result.isConfirmed) {
      const violation = $(this).data('id');
      axios.delete(`/dashboard-admin/violations/${violation}`)
      .then(() => {
      Swal.fire(
      'Terhapus!',
      'Data nya berhasil dihapus!',
      'success'
      ).then(() => {
        window.location.href = '{{ route('violations.index') }}';
      })
      })
      .catch(() => {
      Swal.fire('Gagal dihapus', 'Terjadi kesalahan pada sisi server, hubungi developer kami', 'error');
      })
    }
    })
  });
  //Update data from Modal using Axios Js
  $('.editData').on('click', function() {
    violation = $(this).data('id');
    // fetch data dari kolom input
    axios.get(`/dashboard-admin/violations/${violation}/edit`).then(response => {
    $('#nama_pelanggaran').val(response.data.nama_pelanggaran);
    $('#poin_pelanggaran').val(response.data.poin_pelanggaran);
    })
    .catch(error => {
    console.error('error fetching data: ', error)
    })
  })
  //
  document.getElementById('violationForm-edit').addEventListener('submit', function(event) {
    event.preventDefault();

    const modal = $('#modal-edit-data');
    const formData = new FormData(this);
    axios.post(`/dashboard-admin/violations/${violation}`, formData)
    .then(response => {
    modal.modal('hide');
    swal.fire('Data berhasil di edit', '', 'success').then(() => {
      window.location.href = '{{ route('violations.index') }}';
    })
    })
    //Showing alert notification Error Handling
    .catch(error => {
    console.error('Error updating data: ', error);
    modal.modal('hide');
    if(error.response && error.response.status === 422){
      const errorMessages = error.response.data.errors;
      let errorMessage = '';
      let isFirstError = true; // Flag to track the first error
      for (const field in errorMessages) {
      if (!isFirstError) {
        errorMessage += ', '; // Add a comma before the error message
      } else {
        isFirstError = false;
      }
      errorMessage += errorMessages[field][0];
      }
      Swal.fire('Data gagal di edit', errorMessage, 'error').then(() => {
      modal.modal('show');
      });
    }else{
      Swal.fire('Data gagal di edit', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
    }
    console.error(error);
    });
  })
  // toastr:: success notification
  @if(Session('success'))
  toastr.success('{{ session('success') }}');
  @endif
  // toastr:: error notification
  @if($errors->any())
  @foreach($errors->all() as $error)
  toastr.error('{{ $error }}');
  @endforeach
  @endif
  });
</script>
@endpush
