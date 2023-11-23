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
          <table id="datatables">
            <thead>
              <tr class="light">
                <th>No</th>
                <th>NIP/NUPTK/NRHS</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jenis kelamin</th>
                <th>Kontak</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($teachers as $teacher)
              <tr data-id="{{ $teacher->id }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $teacher->reg_number }}</td>
                <td>{{ $teacher->full_name }}</td>
                <td>{{ $teacher->user->username }}</td>
                <td>{{ $teacher->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $teacher->contact }}</td>
                <td class="button">
                  <div class="btn-group btn-group-toggle btn-group-flat">
                    <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $teacher->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
                    <a class="button btn button-icon bg-danger deleteData" data-id="{{ $teacher->id }}" href="#">Delete</a>
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
                <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col">
                      <label class="h5">NIP/NUPTK/NRHS</label>
                      <input type="text" class="form-control" name="reg_number" placeholder="NIP/NUPTK/NRHS">
                    </div>
                    <div class="col">
                      <label class="h5">Nama Lengkap</label>
                      <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label class="h5">Tempat Lahir</label>
                      <input type="text" class="form-control" name="birthplace" placeholder="Tempat Lahir">
                    </div>
                    <div class="col">
                      <label class="h5">Tanggal Lahir</label>
                      <input name="birthdate" type="date" class="form-control" placeholder="Tanggal Lahir">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label class="h5">Jenis Kelamin</label>
                      <select name="gender" class="form-control mb-3">
                        <option value="" selected disabled>Pilih salah satu</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                    <div class="col">
                      <label class="h5">Agama</label>
                      <select name="religion" class="form-control mb-3">
                        <option value="" selected disabled>Pilih salah satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Hindu">Hindu</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label class="h5">Kontak/WA</label>
                      <input type="text" class="form-control" name="contact" placeholder="081218122006">
                    </div>
                    <div class="col">
                      <label class="h5">Email</label>
                      <input type="text" class="form-control" name="email" placeholder="email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label class="h5">Alamat</label>
                      <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
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
        <form id="teacherForm-edit" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col">
              <label class="h5">NIP/NUPTK/NRHS</label>
              <input type="text" class="form-control" id="reg_number" name="reg_number">
            </div>
            <div class="col">
              <label class="h5">Nama Lengkap</label>
              <input type="text" class="form-control" id="full_name" name="full_name">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label class="h5">Tempat Lahir</label>
              <input type="text" class="form-control" id="birthplace" name="birthplace">
            </div>
            <div class="col">
              <label class="h5">Tanggal Lahir</label>
              <input id="birthdate" name="birthdate" type="date" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label class="h5">Jenis kelamin</label>
              <select id="gender" name="gender" class="form-control mb-3">
                <option value="" selected disabled>Pilih salah satu</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div class="col">
              <label class="h5">Agama</label>
              <select id="religion" name="religion" class="form-control mb-3">
                <option value="" selected disabled>Pilih salah satu</option>
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Buddha">Buddha</option>
                <option value="Hindu">Hindu</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label class="h5">Kontak/WA</label>
              <input type="text" class="form-control" id="contact" name="contact">
            </div>
            <div class="col">
              <label class="h5">Email</label>
              <input type="text" class="form-control" id="email" name="email">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label class="h5">Alamat</label>
              <textarea id="address" name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
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
<!-- Modal for info Data -->
<div class="modal fade modal-info-data" tabindex="-1" id="modal-info-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="nama_info">Nama:</label>
                        <input type="text" id="nama_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="username_info">Username:</label>
                        <input type="text" id="username_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="NIP_NUPTK_NRHS_info">NIP/NUPTK/NRHS:</label>
                        <input type="text" id="NIP_NUPTK_NRHS_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tempat_lahir_info">Tempat Lahir:</label>
                        <input type="text" id="tempat_lahir_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tanggal_lahir_info">Tanggal Lahir:</label>
                        <input type="text" id="tanggal_lahir_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <input type="text" id="jenis_kelamin" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="agama_info">Agama:</label>
                        <input type="text" id="agama_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nomor_hp_info">Kontak/WA:</label>
                        <input type="text" id="nomor_hp_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email_info">Email:</label>
                        <input type="text" id="email_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="alamat_info">Alamat:</label>
                        <textarea class="form-control" readonly name="address" id="alamat_info" rows="5" style="line-height: 22px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
  $(document).ready(function() {
    //close-modal and x-modal tutup halaman
    $(document).on('click', '#close-modal, #x-modal', function() {
        window.location.reload();
    })
    //ketika pencet diluar modal to reload halaman
    $(document).click(function(e) {
        if($(e.target).is('#modal-add-data, #modal-edit-data'))
        {
            window.location.reload();
        }
    })
    var table = $('#datatables').DataTable();
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
    $(document).on('click', '.deleteData', function(event) {
        const teacher = $(this).data('id');
        axios.get(`/dashboard-admin/is-wali-kelas/${teacher}`).then(response => {
            if(response.data == true)
            {
                Swal.fire({
                    title: "Sudah jadi wali kelas",
                    text: "Tidak bisa hapus data selama jadi wali kelas",
                    icon: "warning"
                });
            }else
            {
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
                    axios.delete(`/dashboard-admin/teachers/${teacher}`)
                    .then(() => {
                        Swal.fire(
                        'Terhapus!',
                        'Data nya berhasil dihapus!',
                        'success'
                        ).then(() => {
                        window.location.href = '{{ route('teachers.index') }}';
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
    $(document).on('click', '.editData', function() {
      teacher = $(this).data('id');
      // fetch data dari kolom input
      axios.get(`/dashboard-admin/teachers/${teacher}/edit`).then(response => {
        $('#full_name').val(response.data.full_name);
        $('#reg_number').val(response.data.reg_number);
        $('#birthplace').val(response.data.birthplace);
        $('#birthdate').val(response.data.birthdate);
        $('#gender').val(response.data.gender);
        $('#religion').val(response.data.religion);
        $('#contact').val(response.data.contact);
        $('#email').val(response.data.email);
        $('#address').val(response.data.address);
      })
      .catch(error => {
        console.error('error fetching data: ', error)
      })
    })
    //
    document.getElementById('teacherForm-edit').addEventListener('submit', function(event) {
      event.preventDefault();

      const modal = $('#modal-edit-data');
      const formData = new FormData(this);
      axios.post(`/dashboard-admin/teachers/${teacher}`, formData)
      .then(response => {
        modal.modal('hide');
        swal.fire('Data berhasil di edit', '', 'success').then(() => {
          window.location.href = '{{ route('teachers.index') }}';
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
          if(error.response.data.error)
          {
              Swal.fire('Data gagal di edit', error.response.data.error, 'error').then(() => {
                modal.modal('show');
              });
          }else
          {
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
    // toastr:: error notification
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif
    //lihat info data
    $('#datatables').on('click', 'tr', function(e) {
        moment.locale('id');
        if(!$(e.target).closest('td').hasClass('button'))
        {
            let teacher = $(this).data('id');
            axios.get(`/dashboard-admin/teachers/${teacher}/edit`).then(response => {
                $('#modal-info-data').modal('show');
                $('#NIP_NUPTK_NRHS_info').val(response.data.reg_number);
                $('#nama_info').val(response.data.full_name);
                $('#username_info').val(response.data.user.username);
                $('#tempat_lahir_info').val(response.data.birthplace);
                $('#tanggal_lahir_info').val(moment(response.data.birthdate).format('D MMMM YYYY'));
                $('#jenis_kelamin').val(response.data.gender == 'L' ? 'laki-laki' : 'Perempuan');
                $('#agama_info').val(response.data.religion);
                $('#nomor_hp_info').val(response.data.contact);
                $('#email_info').val(response.data.email);
                $('#religion_info').val(response.data.religion);
                $('#alamat_info').val(response.data.address);
            })
        }
    })
  });
</script>
@endpush
