@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $dataTitle }}</h4>
                </div>
                {{-- <div class="pl-3 btn-new border-left">
                    <button type="button" class="btn btn-success mt-2" id="button-tambah-data">{{ $addData }}</button>
                </div> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive rounded bg-white">
                    <table id="tableYearSemesters" class="table data-table table-striped">
                        <thead>
                            <tr class="light">
                                <th>No</th>
                                <th>Status panggilan</th>
                                <th class="text-center">Permasalahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Panggilan as $panggilan)
                            <tr data-id="{{ $panggilan->id }}" id="tr-data">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $panggilan->statusPanggilan == 'I' ? 'Panggilan I' : 'Panggilan II' }}</td>
                                <td class="text-center">{{ substr($panggilan->permasalahan, 0, 100) }}{{ strlen($panggilan->permasalahan) > 100 ? '...' : '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Info Data -->
<div class="modal fade modal-info-data" tabindex="-1" id="modal-edit-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Panggilan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="namaSiswaEdit" class="h5">nama siswa</label>
                        <select id="namaSiswaEdit" name="student_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            {{-- @foreach($Student as $student)
                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pelanggaranEdit" class="h5">Jenis pelanggaran</label>
                        <select id="pelanggaranEdit" name="violation_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            {{-- @foreach($Violation as $violation)
                            <option value="{{$violation->id}}">{{$violation->nama_pelanggaran}}</option>
                            @endforeach --}}
                        </select>
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

<!-- Modal for Info Data -->
<div class="modal fade modal-info-data" tabindex="-1" id="modal-info-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">informasi panggilan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <p class="h5">Preview photo</p>
                        <img id="preview-foto-info" readonly class="img-fluid rounded" alt="Responsive image">
                    </div>
                </div>
                <div class="form-group">
                    <label class="h5" for="nama_siswa_info">Nama siswa</label>
                    <input type="text" class="form-control" readonly id="nama_siswa_info" name="title">
                </div>
                <div class="form-group">
                    <label class="h5" for="status_panggilan_info">Tahapan panggilan</label>
                    <input type="text" class="form-control" readonly id="status_panggilan_info" name="title">
                </div>
                <div class="form-group">
                    <label for="permasalahan_info" class="h5">Permasalahan/pelanggaran</label>
                    <textarea name="permasalahan" class="form-control" readonly id="permasalahan_info" cols="30" rows="5"></textarea>
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
        // info data ketika tr dipencet
        $(document).on('click', '#tr-data', function(event) {
            if(!$(event.target).hasClass('button'))
            {
                let panggilan_id = $(this).data('id');
                // console.log(panggilan_id);
                axios.get(`/dashboard-siswa/data-panggilan-profile/${panggilan_id}`).then(response => {
                    const modal = $('#modal-info-data');
                    modal.modal('show');
                    $('#preview-foto-info').attr('src', '{{ asset('storage/images') }}/' + response.data.dokumentasi);
                    $('#nama_siswa_info').val(response.data.student.full_name);
                    $('#status_panggilan_info').val(response.data.statusPanggilan == 'I' ? 'panggilan I' : 'Panggilan II');
                    $('#permasalahan_info').val(response.data.permasalahan);
                })
            }
        })
    })
</script>
@endpush
