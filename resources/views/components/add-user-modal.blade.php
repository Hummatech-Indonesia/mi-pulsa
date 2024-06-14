<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="addUserForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Modal Penambahan Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name') }}" placeholder="Masukkan nama">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email') }}" placeholder="Masukkan alamat email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control" 
                               value="{{ old('phone_number') }}" placeholder="Masukkan nomor telepon">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="Masukkan kata sandi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Tambahkan</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
