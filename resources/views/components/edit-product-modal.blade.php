<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="editProductForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Modal Perubahan Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="text-center">
                        <img src="" alt="" class="rounded-circle" id="logoImage" width="64"
                            height="64">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Harga</label>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="15" rows="5" class="form-control"></textarea>
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
