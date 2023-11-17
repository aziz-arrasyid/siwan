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
                <th>T/A</th>
                <th>Semester</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($yearSemesters as $yearSemester)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $yearSemester->tahunAjar }}</td>
                <td>{{ $yearSemester->semester }}</td>
                <td>
                  <div class="btn-group btn-group-toggle btn-group-flat">
                    <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $yearSemester->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
                    <a class="button btn button-icon bg-danger deleteData" data-id="{{ $yearSemester->id }}" href="#">Delete</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal fade modal-add-data" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{ $addData }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="ta-semesterForm" enctype="multipart/form-data" action="{{ route('data-ta-semester.store') }}" method="POST">
                <div class="modal-body">
                  @csrf
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">
                        <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                      </span>
                    </div>
                    <input type="text" class="form-control" name="tahunAjar"
                    placeholder='tahun pelajaran //contoh: "2023/2024"' aria-label="tahunAjar" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false"> Semester
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item data-add" data-value="Ganjil" href="#">ganjil</a>
                      <a class="dropdown-item data-add" data-value="Genap"href="#">Genap</a>
                    </div>
                  </div>
                  <input type="text" name="semester" id="inputSemester-add"
                  readonly class="form-control" aria-label="Text input with dropdown button">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-edit-data" tabindex="-1" id="modal-edit-data" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $editData }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ta-semesterForm-edit" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          @method('PUT')
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
                </svg>
              </span>
            </div>
            <input type="text" class="form-control" name="tahunAjar" id="tahunAjar" placeholder='tahun pelajaran //contoh: "2023/2024"' aria-label="tahunAjar" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-4">
            <div class="input-group-prepend">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"> Semester </button>
              <div class="dropdown-menu">
                <a class="dropdown-item data-edit" data-value="Ganjil" href="#">ganjil</a>
                <a class="dropdown-item data-edit" data-value="Genap" href="#">Genap</a>
              </div>
            </div>
            <input type="text" name="semester" id="inputSemester-edit" readonly class="form-control" aria-label="Text input with dropdown button">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
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
          const data_ta_semester = $(this).data('id');
          axios.delete(`/dashboard-admin/data-ta-semester/${data_ta_semester}`)
          .then(() => {
            Swal.fire(
            'Terhapus!',
            'Data nya berhasil dihapus!',
            'success'
            ).then(() => {
              window.location.href = '{{ route('data-ta-semester.index') }}';
            })
          })
          .catch(() => {
            Swal.fire('Gagal dihapus', 'Terjadi kesalahan pada sisi server, hubungi developer kami', 'error');
          })
        }
      })
    });
    //fungsi delete end

    // fungsi edit start

    //fungsi ketika btn edit di click start
    $('.editData').on('click', function() {
      data_ta_semester = $(this).data('id');

      // fungsi dropdown start
      document.querySelectorAll('.data-edit').forEach(function(choice) {
        choice.addEventListener('click', function() {
          const selectedValue = this.getAttribute('data-value');
          document.getElementById('inputSemester-edit').value = selectedValue;
        })
      })
      // fungsi dropdown end

      // fungsi pengambilan data dan ditampilkan start
      axios.get(`/dashboard-admin/data-ta-semester/${data_ta_semester}/edit`)
      .then(response => {
        $('#tahunAjar').val(response.data.tahunAjar);
        $('#inputSemester-edit').val(response.data.semester);
      })
      .catch(error => {
        console.error('error fetching data: ', error)
      })
      // fungsi pengambilan data dan ditampilkan end

    })
    //fungsi ketika btn edit di click end

    //fungsi ketika form edit di submit start
    document.getElementById('ta-semesterForm-edit').addEventListener('submit', function(event) {
      event.preventDefault();

      const modal = $('#modal-edit-data');
      const formData = new FormData(this);
      console.log(data_ta_semester);
      axios.post(`/dashboard-admin/data-ta-semester/${data_ta_semester}`, formData)
      .then(response => {
        modal.modal('hide');
        swal.fire('Data berhasil di edit', '', 'success').then(() => {
          window.location.href = '{{ route('data-ta-semester.index') }}';
        })
      })
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
    //fungsi ketika form edit di submit end

    // fungsi edit end

    //fungsi tambah data start
    document.querySelectorAll('.data-add').forEach(function(choice) {
      choice.addEventListener('click', function() {
        const selectedValue = this.getAttribute('data-value');
        document.getElementById('inputSemester-add').value = selectedValue;
      })
    })
    //fungsi tambah data end

    // toastr berhasil start
    @if(Session('success'))
    toastr.success('{{ session('success') }}');
    @endif
    // toastr berhasil end

    //toastr gagal start
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif
    // toastr gagal end
  });
</script>
@endpush
