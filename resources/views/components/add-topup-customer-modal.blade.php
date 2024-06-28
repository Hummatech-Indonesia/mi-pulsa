<div class="modal fade" id="addTopupCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('customers.store') }}" id="addTopupCustomerForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Kirim langsung ke pengguna baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}" placeholder="Masukkan nama pelanggan">
                    </div>
                    <div class="form-group">
                        <label for="product_id" id="" class="form-label">Produk</label>
                        <select name="product_id" class="form-control" id="add_product_id">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="08123456789">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Konfirmasi</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
