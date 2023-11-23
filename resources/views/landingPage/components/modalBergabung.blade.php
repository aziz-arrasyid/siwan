<div class="modal fade" id="modal-login-data" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 kucing" id="exampleModalLabel">Bergabung</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('authenticate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Pengguna</label>
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="lpass">
                            <label class="form-check-label" for="lpass">Lihat kata sandi</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="mt-3">Belum punya akun? <a href="{{ route('register.index') }}">Daftar sekarang</a></p>
                        <button type="submit" class="button-selengkapnya">Gabung</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
