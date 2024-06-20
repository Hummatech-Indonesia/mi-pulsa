<div class="modal fade" id="importCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('customers.import') }}" id="importCustomerForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="alert alert-warning" role="alert">
                        <ul>
                            <li>File yang dapat diunggah berupa file excel berexistensi xls,xlsx</li>
                            <li>format pengisian excel seperti dibawah ini</li>
                            <li>Contoh format pada baris pertama excel jangan dihapus !!!</li>
                        </ul>
                    </div>
                    <a href="{{asset('customers-format.xlsx')}}" class="btn btn-success mb-3" download="customers-format.xlsx">Download Format Excel</a>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Import</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
