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
          <table id="datatables" class="table data-table table-striped">
            <thead>
              <tr class="light">
                <th>No</th>
                <th>Judul berita</th>
                <th>Konten singkat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($Kreator as $kreator)
              <tr data-id="{{ $kreator->id }}" id="tr-data">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $kreator->title }}</td>
                <td>{{ $kreator->content }}</td>
                <td class="button">
                  <div class="btn-group btn-group-toggle btn-group-flat">
                    <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $kreator->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
                    <a class="button btn button-icon bg-danger deleteData" data-id="{{ $kreator->id }}" href="#">Delete</a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Modal for Add Data -->
        <div class="modal fade modal-add-data" tabindex="-1" role="dialog" id="modal-add-data" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{ $addData }}</h5>
                <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('kreator.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <div class="custom-file mb-4">
                                    <input type="file" class="custom-file-input" name="picture" id="input_foto">
                                    <label class="custom-file-label" for="input_foto">Choose file</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid rounded" id="images" alt="Responsive image" style="display: none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="h5" for="judul">Judul berita</label>
                    <input type="text" class="form-control" id="judul" name="title">
                    </div>
                    <div class="form-group">
                    <label class="h5" for="content">Konten Berita</label>
                    <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>
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
        <form id="kreator-form-edit" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" name="picture" id="input_foto_edit">
                            <label class="custom-file-label" for="input_foto">Choose file</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid rounded" id="images_edit" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="h5" for="title_edit">Judul berita</label>
                <input type="text" class="form-control" id="title_edit" name="title">
            </div>
            <div class="form-group">
                <label class="h5" for="content_edit">Konten Berita</label>
                <textarea name="content" id="content_edit" class="form-control" cols="30" rows="10"></textarea>
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
<!-- Modal for info Data -->
<div class="modal fade modal-info-data" tabindex="-1" id="modal-info-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Berita</h5>
                <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            <img class="img-fluid rounded" id="images_info" alt="Responsive image">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label class="h5">Judul berita</label>
                <input type="text" class="form-control" readonly name="title" id="title_info">
                </div>
                <div class="form-group">
                <label class="h5" for="content_info">Konten Berita</label>
                <textarea name="content" id="content_info" readonly class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
          //global var
          let kreator;
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
            //tampilkan gambar ketika change input gambar pada tambah data
            $(document).on('change', '#input_foto', function() {
                let photo = $(this)[0];
                let file = photo.files[0];
                let url = URL.createObjectURL(file);

                $('#images').css('display', 'block');
                $('#images').attr('src', url);
            })
            //reload halaman ketika modal muncul dan click diluar modal
            $(document).click(function(e) {
                if ($(e.target).is('#modal-add-data, #modal-info-data, #modal-edit-data')) {
                    window.location.reload();
                }
            });
            //reload halaman ketika pencet button close dan button x
            $(document).on('click', '#close-modal, #x-modal', function() {
                window.location.reload();
            })
            //toastr error tambah data
            @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif
            // info data ketika tr dipencet
            $(document).on('click', '#tr-data', function(event) {
                if(!$(event.target).hasClass('button'))
                {
                    kreator = $(this).data('id');
                    axios.get(`/dashboard-kreator/kreator/${kreator}`).then(response => {
                        const modal = $('#modal-info-data');
                        modal.modal('show');
                        $('#images_info').attr('src', '{{ asset('storage/images') }}/' + response.data.picture);
                        $('#title_info').val(response.data.title);
                        $('#content_info').val(response.data.content);
                    })
                }
            })
            //tampil data edit
            $(document).on('click', '.editData', function() {
              kreator = $(this).data('id');
              axios.get(`/dashboard-kreator/kreator/${kreator}/edit`).then(response => {
                $('#title_edit').val(response.data.title);
                $('#content_edit').val(response.data.content);
                $('#input_foto_edit').siblings('.custom-file-label').html(response.data.picture);
                $('#images_edit').attr('src', '{{ asset('storage/images') }}/' + response.data.picture);
              })
            })
            //change picture ketike input data edit foto
            $(document).on('change', '#input_foto_edit', function() {
                let photo = $(this)[0];
                let file = photo.files[0];
                let url = URL.createObjectURL(file);

                $('#images_edit').attr('src', url);
            })
            //update data
            document.getElementById('kreator-form-edit').addEventListener('submit', function(event) {
                event.preventDefault();
                const modal = $('#modal-edit-data');

                let picture = $('#input_foto_edit')[0].files[0];
                let title = $('#title_edit').val();
                let content = $('#content_edit').val();

                let formData = new FormData(this);

                axios.post(`/dashboard-kreator/kreator/${kreator}`, formData).then(response => {
                    modal.modal('hide');
                    swal.fire('Data berhasil di edit', '', 'success').then(() => {
                        window.location.reload();
                    })
                }).catch(error => {
                    modal.modal('hide')
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
                })
            })
            //delete data
            $(document).on('click', '.deleteData', function() {
                kreator = $(this).data('id');
                Swal.fire({
                    title: "Apa kamu ingin hapus data?",
                    text: "Data akan terhapus permanen",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Iya, saya ingin hapus data"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/dashboard-kreator/kreator/${kreator}`).then(response => {
                            Swal.fire({
                            title: "Berhasil dihapus!",
                            text: "",
                            icon: "success"
                            }).then(() => {
                                window.location.reload();
                            })
                        }).catch(error => {
                            console.error(error);
                        })
                    }
                });
            })
        })
    </script>
@endpush

