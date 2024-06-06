<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="updateUserForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Modal Perubahan Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Nomor Telepon</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Role Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">Role</option>
                            <option value="admin">Admin</option>
                            <option value="agent">Agent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
