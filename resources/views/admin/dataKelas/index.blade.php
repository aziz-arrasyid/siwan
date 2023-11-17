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
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Jurusan</th>
        <th>Wali Kelas</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($classroom as $result)
        <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $result->classroom_name }}</td>
        <td>{{ $result->competence->inisial_jurusan. ' ('.$result->competence->nama_jurusan.')' }}</td>
        <td>{{ $result->teacher->full_name }}</td>
        <td>
          <div class="btn-group btn-group-toggle btn-group-flat">
          <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $result->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
          <a class="button btn button-icon bg-danger deleteData" data-id="{{ $result->id }}" href="#">Delete</a>
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
        <form action="{{ route('classroom.store') }}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <label class="h5">Nama Kelas</label>
            <input type="text" class="form-control" name="classroom_name" placeholder="Nama Kelas">
          </div>
          <div class="form-group">
            <label class="h5">Kompetensi Keahlian</label>
            <select name="competence_id" class="form-control">
              <option selected disabled>Pilih Salah satu</option>
              @foreach($competences as $competence)
              <option value="{{$competence->id}}">{{$competence->inisial_jurusan}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="h5">Wali kelas</label>
            <select name="teacher_id" class="form-control mb-3">
                <option value="" selected disabled>Pilih salah satu</option>
                @foreach ($Guru as $guru)
                <option value="{{ $guru->id }}">{{ $guru->full_name }}</option>
                @endforeach
            </select>
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
    <form id="classroomForm-edit">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label class="h5">Nama Kelas</label>
        <input type="text" class="form-control" id="classroom_name" name="classroom_name">
      </div>
      <div class="form-group">
            <label class="h5">Kompetensi Keahlian</label>
            <select name="competence_id" id="competence_id" class="form-control">
              <option selected disabled>Pilih Salah satu</option>
              @foreach($competences as $competence)
              <option value="{{$competence->id}}">{{$competence->inisial_jurusan}}</option>
              @endforeach
            </select>
          </div>
      <div class="form-group">
            <label class="h5">Wali kelas</label>
            <select name="teacher_id" id="teacher_id" class="form-control mb-3">
                <option value="" selected disabled>Pilih salah satu</option>
                @foreach ($Guru as $guru)
                <option value="{{ $guru->id }}">{{ $guru->full_name }}</option>
                @endforeach
            </select>
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
<!-- Modal for Edit Data -->

@endsection
@push('scripts')
<script>
  $(document).ready(function() {
    //close-modal and x-modal to reload halaman
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
  //fungsi delete
  $('.deleteData').on('click', function(event) {
    event.preventDefault();
    const classroom = $(this).data('id');
    axios.get(`/dashboard-admin/get-cek-siswa/${classroom}`).then(response => {
        console.log(response.data);
        if(response.data != 0){
            Swal.fire({
                title: 'Apa kamu ingin hapus data?',
                text: "Kelas masih berisi siswa, data siswa akan ikut terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, saya mau hapus!'
                }).then((result) => {
                if (result.isConfirmed) {
                axios.delete(`/dashboard-admin/classroom/${classroom}`)
                .then(() => {
                Swal.fire(
                'Terhapus!',
                'Data nya berhasil dihapus!',
                'success'
                ).then(() => {
                    window.location.href = '{{ route('classroom.index') }}';
                })
                })
                .catch(() => {
                Swal.fire('Gagal dihapus', 'Terjadi kesalahan pada sisi server, hubungi developer kami', 'error');
                })
                }
            })
        }else{
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
                axios.delete(`/dashboard-admin/classroom/${classroom}`)
                .then(() => {
                Swal.fire(
                'Terhapus!',
                'Data nya berhasil dihapus!',
                'success'
                ).then(() => {
                    window.location.href = '{{ route('classroom.index') }}';
                })
                })
                .catch(() => {
                Swal.fire('Gagal dihapus', 'Terjadi kesalahan pada sisi server, hubungi developer kami', 'error');
                })
                }
            })
        }
    })
  });
  //Update data from Modal using Axios Js
  $('.editData').on('click', function() {
    classroom = $(this).data('id');
    // fetch data dari kolom input
    axios.get(`/dashboard-admin/classroom/${classroom}/edit`).then(response => {
    $('#classroom_name').val(response.data.classroom_name);
    $('#competence_id').val(response.data.competence_id);
    $('#teacher_id').val(response.data.teacher_id);
    })
    .catch(error => {
    console.error('error fetching data: ', error)
    })
  })
  //
  document.getElementById('classroomForm-edit').addEventListener('submit', function(event) {
    event.preventDefault();

    const modal = $('#modal-edit-data');
    const formData = new FormData(this);
    axios.post(`/dashboard-admin/classroom/${classroom}`, formData)
    .then(response => {
    modal.modal('hide');
    swal.fire('Data berhasil di edit', '', 'success').then(() => {
      window.location.href = '{{ route('classroom.index') }}';
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
        if(error.response.data.error){
        Swal.fire('Data gagal di edit', error.response.data.error, 'error').then(() => {
            modal.modal('show');
        });
        }else{
            Swal.fire('Data gagal di edit', errorMessage, 'error').then(() => {
            modal.modal('show');
            });
        }
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
  //toastr:: error notification
  @if(Session('error'))
  toastr.error('{{ session('error') }}');
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
