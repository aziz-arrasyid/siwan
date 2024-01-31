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
                        {{--  --}}
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
                                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <label class="h5">NIS</label>
                                            <input type="text" class="form-control" name="nis" placeholder="NIS">
                                        </div>
                                        <div class="col">
                                            <label class="h5">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="competences">Jurusan</label>
                                            <select id="competences" name="competence_id" class="form-control">
                                                <option selected disabled>Pilih Salah satu</option>
                                                @foreach($competences as $result)
                                                <option value="{{$result->id}}">{{$result->nama_jurusan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="classroom">Kelas</label>
                                            <select id="classroom" name="classroom_id" class="form-control">
                                                <option selected disabled>Pilih Salah satu</option>
                                            </select>
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
                                            <label class="h5">Jenis kelamin</label>
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
                                    <div class="form-group">
                                        <label class="h5">Kontak/WA</label>
                                        <input type="text" class="form-control" name="contact">
                                    </div>
                                    <div class="form-group">
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
                <form id="studentForm-edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label class="h5">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis">
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
                            <label class="h5">Jurusan</label>
                            <select id="competence_id_edit" name="competence_id" class="form-control mb-3">
                                <option value="" selected disabled>Pilih salah satu</option>
                                @foreach ($competences as $competence)
                                <option value="{{ $competence->id }}">{{ $competence->inisial_jurusan }} ({{ $competence->nama_jurusan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="h5">Kelas</label>
                            <select id="classroom_id_edit" name="classroom_id" class="form-control mb-3">
                                <option value="" selected disabled>Pilih salah satu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="h5">Kontak/WA</label>
                        <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                    <div class="form-group">
                        <label class="h5">Alamat</label>
                        <textarea id="address" name="address" class="form-control" rows="3"></textarea>
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
<!-- Modal for Pelanggaran Data -->
<div class="modal fade modal-pelanggaran-data" tabindex="-1" id="modal-pelanggaran-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $pelanggaranData }}</h5>
                <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="studentForm-pelanggaran" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label class="h5">Jenis Pelanggaran</label>
                            <select id="violation_id" name="violation_id" class="form-control mb-3">
                                <option value="default" selected disabled>Pilih salah satu</option>
                                @foreach ($Violation as $violation)
                                <option value="{{ $violation->id }}">{{ $violation->nama_pelanggaran }}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control" hidden name="student_id" id="student_id">
                        </div>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col">
                            <button type="button" class="btn mb-1 bg-success-light">
                                <span id="namaPelanggaran">Total Poin Pelanggaran aziz arrasyid vfydani</span> <span class="badge badge-success ml-2 info-pelanggaran">0</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive rounded bg-white">
                                <table class="" id="data-pelanggaran">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Pelanggaran</th>
                                            <th>Poin Pelanggaran</th>
                                            <th>Waktu Pelanggaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--  --}}
                                    </tbody>
                                </table>
                            </div>
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
                <h5 class="modal-title">Info siswa</h5>
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
                        <label for="nis_info">NIS:</label>
                        <input type="text" id="nis_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="jurusan_info">Jurusan:</label>
                        <input type="text" id="jurusan_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="kelas_info">Kelas:</label>
                        <input type="text" id="kelas_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tempat_lahir_info">Tempat lahir:</label>
                        <input type="text" id="tempat_lahir_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tanggal_lahir_info">Tanggal lahir:</label>
                        <input type="text" id="tanggal_lahir_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="kelamin_info">L/P:</label>
                        <input type="text" id="kelamin_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="religion_info">Agama:</label>
                        <input type="text" id="religion_info" readonly class="form-control" value="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nomor_hp_info">Nomor HP:</label>
                        <input type="text" id="nomor_hp_info" readonly class="form-control" value="">
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
        //x-modal & close-modal to reload halaman
        $(document).on('click', '#close-modal, #x-modal', function() {
            window.location.reload();
        })
        //ketike modal muncuk click diluar modal to reload halaman
        $(document).click(function(e) {
            if($(e.target).is('#modal-add-data, #modal-edit-data, #modal-pelanggaran-data'))
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
        //fungsi server-side
        var table = $('#datatables').DataTable({
            ajax: '{{ route('server.side') }}',
            processing: true,
            serverSide: true,
            deferRender: true,
            columns: [
            {
                title:  'No',
                data: null,
                render: function(data, type, row, meta){
                    return meta.row + 1;
                },
                searchable: false,
                orderable: false,
            },
            {
                title: 'NIS',
                data: 'nis'
            },
            {
                title: 'Nama Lengkap',
                data: 'full_name'
            },
            {
                title: 'Kelas',
                data: 'classroom.classroom_name'
            },
            {
                title: 'L/P',
                data: 'gender'
            },
            {
                title: 'agama',
                data: 'religion'
            },
            {
                title: 'Kontak',
                data: 'contact'
            },
            {
                title: 'Action',
                data: null,
                class: 'button',
                render: function(data, type, row){
                    var editUrl = '{{ route('subjects.edit', '__id__') }}';
                    var deleteUrl = '{{ route('subjects.destroy', '__id__') }}';

                    editUrl = editUrl.replace('__id__', data.id);
                    deleteUrl = deleteUrl.replace('__id__', data.id);

                    return  '<div class="btn-group btn-group-toggle btn-group-sm btn-group-flat">' +
                        '<a href="#" class="btn btn-warning editData" data-id="' + data.id + '" data-toggle="modal" data-target="#modal-edit-data">Edit</a>' +
                        '<a href="#" class="btn btn-primary pelanggaranData" data-name="' + data.full_name + '" data-id="' + data.id + '" data-toggle="modal" data-target="#modal-pelanggaran-data">Pelanggaran</a>' +
                        '<a class="button btn button-icon bg-danger deleteData" data-id="' + data.id + '">Delete</a>' +
                        '</div>';
                        },
                        searchable: false,
                    },
                    ],

                    initComplete: function(){
                        //variable global
                        let student = null;
                        //Pelanggaran Siswa
                        $('.pelanggaranData').on('click', function() {
                            const modal = $('#modal-pelanggaran-data');
                            //fungsi reload halaman ketika close modal

                            let id = $(this).data('id');
                            // console.log(id);
                            $('#student_id').val(id);
                            // let namaSiswa = $(this).data('name');
                            document.getElementById('namaPelanggaran').innerHTML = 'Total Poin Pelanggaran ' + $(this).data('name');
                            // console.log(namaSiswaTes);
                            //fetch data
                            $('#data-pelanggaran').DataTable().destroy();
                            tableDataPelanggaran(id);
                            //fungsi delete pelanggaran
                            $(document).on('click', '.deleteDataPelanggaran', function() {
                                let pelanggaran = $(this).data('id');
                                modal.modal('hide');
                                Swal.fire({
                                    title: 'Apa kamu ingin hapus data?',
                                    text: "Data akan terhapus permanent",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Iya, saya mau hapus!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        axios.delete(`/pelanggaran/${pelanggaran}`).then(response => {
                                            swal.fire('Data berhasil di hapus', '', 'success').then(() => {
                                                modal.modal('show');
                                                $('#data-pelanggaran').DataTable().destroy();
                                                tableDataPelanggaran(id);
                                            })
                                            .catch(error => {
                                                console.error('error delete data: ', error)
                                            })
                                        })
                                    }else{
                                        modal.modal('show');
                                    }
                                })
                            })

                            //fungsi update pelanggaran
                            $(document).on('click', '.editDataPelanggaran', function() {
                                let violation_id = $('#violation_id').val();
                                let pelanggaran = $(this).data('id');

                                axios.put(`/pelanggaran/${pelanggaran}`, {violation_id: violation_id}).then(response => {
                                    modal.modal('hide');
                                    swal.fire('Data berhasil di edit', '', 'success').then(() => {
                                        modal.modal('show');
                                        $('#violation_id').val('default');
                                        $('#data-pelanggaran').DataTable().destroy();
                                        tableDataPelanggaran(id);
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

                            //fungsi tambah pelanggaran siswa
                            document.getElementById('studentForm-pelanggaran').addEventListener('submit', function(event) {
                                event.preventDefault();
                                const modal = $('#modal-pelanggaran-data');
                                const formData = new FormData(this);
                                axios.post(`/pelanggaran`, formData)
                                .then(response => {
                                    modal.modal('hide');
                                    swal.fire('Data berhasil di tambahkan', '', 'success').then(() => {
                                        modal.modal('show');
                                        $('#violation_id').val('default');
                                        $('#data-pelanggaran').DataTable().destroy();
                                        tableDataPelanggaran(id);
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
                                        Swal.fire('Data gagal di tambahkan', errorMessage, 'error').then(() => {
                                            modal.modal('show');
                                        });
                                    }else{
                                        Swal.fire('Data gagal di tambahkan', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                                    }
                                    console.error(error);
                                });
                            })

                        })

                        function tableDataPelanggaran(id){
                            let totalPoin = 0;
                            // let namaSiswa;
                            axios.get(`/dashboard-admin/pelanggaran/${id}`)
                            .then(response => {
                                const Datapelanggaran = response.data;
                                const table = document.getElementById('data-pelanggaran').getElementsByTagName('tbody')[0];

                                table.innerHTML = '';

                                Datapelanggaran.forEach((data, index) => {
                                    const row = table.insertRow(index);
                                    const cellNo = row.insertCell(0);
                                    const cellNamaPelanggaran = row.insertCell(1);
                                    const cellPoinPelanggaran = row.insertCell(2);
                                    const cellWaktuPelanggaran = row.insertCell(3);
                                    const cellAction = row.insertCell(4);

                                    cellNo.innerHTML = index + 1;
                                    cellNamaPelanggaran.innerHTML = data.violation.nama_pelanggaran;
                                    cellPoinPelanggaran.innerHTML = data.violation.poin_pelanggaran;

                                    moment.locale('id');
                                    cellWaktuPelanggaran.innerHTML = moment(data.created_at).format('LLL');

                                    totalPoin += data.violation.poin_pelanggaran;
                                    idPelanggaran = data.id;

                                    const Action = document.createElement('div');
                                    Action.className = 'btn-group btn-group-toggle btn-group-sm btn-group-flat';
                                    Action.innerHTML = `<a href="#" class="btn btn-warning editDataPelanggaran" data-id="${idPelanggaran}">Edit</a>` +
                                    `<a href="#" class="btn btn-danger deleteDataPelanggaran" data-id="${idPelanggaran}">Delete</a>`;

                                    cellAction.appendChild(Action);

                                })
                                let dataTable = $('#data-pelanggaran').DataTable();

                                const button = document.querySelector('.info-pelanggaran');

                                button.innerHTML = `${totalPoin}`;
                            })
                            .catch(error => {
                                console.error('error fetching data: ', error)
                            })
                        }

                        //fungsi tampil data edit
                        $(document).on('click', '.editData', function() {
                            student = $(this).data('id');
                            // fetch data dari kolom input
                            axios.get(`/dashboard-admin/students/${student}/edit`).then(response => {
                                let competence_id = response.data.competence_id;
                                let classroom_id = response.data.classroom_id;
                                axios.get(`/dashboard-admin/getClassroom/${competence_id}`).then(response => {
                                    console.log(response.data);
                                    $('#classroom_id_edit').empty();
                                    response.data.forEach(classroom => {
                                        console.log(classroom.classroom_name);

                                        const option = $('<option>');
                                        option.val(classroom.id);
                                        option.text(classroom.classroom_name);

                                        if (classroom.id === classroom_id) {
                                            option.prop('selected', true);
                                        }
                                        $('#classroom_id_edit').append(option);
                                    });
                                })

                                $('#nis').val(response.data.nis);
                                $('#full_name').val(response.data.full_name);
                                $('#birthplace').val(response.data.birthplace);
                                $('#birthdate').val(response.data.birthdate);
                                $('#gender').val(response.data.gender);
                                $('#religion').val(response.data.religion);
                                $('#contact').val(response.data.contact);
                                $('#address').val(response.data.address);
                                $('#competence_id_edit').val(response.data.competence_id);
                            })
                            .catch(error => {
                                console.error('error fetching data: ', error)
                            })
                        })
                        //on change jurusan to get kelas
                        $(document).on('change', '#competence_id_edit', function() {
                            let competence_id = $(this).val();
                            axios.get(`/dashboard-admin/getClassroom/${competence_id}`).then(response => {
                                console.log(response.data);
                                $('#classroom_id_edit').empty();
                                $('#classroom_id_edit').append('<option disabled selected>Pilih salah satu</option>');
                                response.data.forEach(classroom => {
                                    console.log(classroom.classroom_name);

                                    const option = $('<option>');
                                    option.val(classroom.id);
                                    option.text(classroom.classroom_name);

                                    $('#classroom_id_edit').append(option);
                                });
                            })
                        })
                        //fungsi delete
                        $(document).on('click', '.deleteData', function(event) {
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
                                    student = $(this).data('id');
                                    axios.delete(`/dashboard-admin/students/${student}`)
                                    .then(() => {
                                        Swal.fire(
                                        'Terhapus!',
                                        'Data nya berhasil dihapus!',
                                        'success'
                                        ).then(() => {
                                            window.location.href = '{{ route('students.index') }}';
                                        })
                                    })
                                    .catch(() => {
                                        Swal.fire('Gagal dihapus', 'Terjadi kesalahan pada sisi server, hubungi developer kami', 'error');
                                    })
                                }
                            })
                        });
                        //Update data from Modal using Axios Js
                        //
                        document.getElementById('studentForm-edit').addEventListener('submit', function(event) {
                            event.preventDefault();

                            const modal = $('#modal-edit-data');
                            const formData = new FormData(this);
                            axios.post(`/dashboard-admin/students/${student}`, formData)
                            .then(response => {
                                modal.modal('hide');
                                swal.fire('Data berhasil di edit', '', 'success').then(() => {
                                    window.location.href = '{{ route('students.index') }}';
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

                    }
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

                //get data classroom
                $('#competences').change(function () {
                    var compID = $(this).val();
                    if (compID) {
                        $.ajax({
                            type: "GET",
                            url: `/getClassroom/${compID}`,
                            dataType: 'JSON',
                            success: function (result) {
                                $("#classroom").empty();
                                $("#classroom").append('<option selected disabled>Pilih Salah satu</option>');
                                $.each(result, function (id, classroom_name) {
                                    $("#classroom").append('<option value="' + id + '">' + classroom_name + '</option>');
                                });
                            }
                        });
                    } else {
                        $("#classroom").empty();
                    }
                });


                $('#datatables').on('click', 'td', function(e) {
                    moment.locale('id');
                    if(!$(this).hasClass('button'))
                    {
                        let data = table.row( this ).data();
                        $('#modal-info-data').modal('show');
                        $('#nama_info').val(data.full_name);
                        $('#nis_info').val(data.nis);
                        $('#jurusan_info').val(data.competence.inisial_jurusan + ' (' + data.competence.nama_jurusan + ')');
                        $('#kelas_info').val(data.classroom.classroom_name);
                        $('#tempat_lahir_info').val(data.birthplace);
                        $('#tanggal_lahir_info').val(moment(data.birthdate).format('D MMMM YYYY'));
                        $('#kelamin_info').val(data.gender == 'L' ? data.gender + ' (laki-laki)' : data.gender + ' (Perempuan)');
                        $('#religion_info').val(data.religion);
                        $('#nomor_hp_info').val(data.contact);
                        $('#alamat_info').val(data.address);
                    }
                })
            });
        </script>
        @endpush
