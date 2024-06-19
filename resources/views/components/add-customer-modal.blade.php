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
                        <select name="product_id" id="product_id">
                            {{-- @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach --}}
                        </select>
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
