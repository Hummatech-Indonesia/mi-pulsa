<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('customers.store') }}" id="addCustomerForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Modal Penambahan Data Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}" placeholder="Masukkan nama pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" name="provider" id="provider" class="form-control"
                            value="{{ old('provider') }}" placeholder="Masukkan provider">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control"
                            value="{{ old('phone_number') }}" placeholder="Masukkan nomor telepon">
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
