@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <x-alert-success></x-alert-success>
        @elseif(session('error'))
            <x-alert-failed></x-alert-failed>
        @endif
        <!-- --------------------------------------------------- -->
        <!--  Form Basic Start -->
        <!-- --------------------------------------------------- -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Form Tentang Kami</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                        href="index-2.html">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Konfigurasi</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <div class="row">
                <div class="col-12">
                    <!-- ----------------------------------------- -->
                    <!-- 1. Tentang Kami -->
                    <!-- ----------------------------------------- -->
                    <!-- ---------------------
                                                                                                              start Tentang Kami
                                                                                                          ---------------- -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Tentang Kami</h5>
                            @if ($about)
                                <div class="d-flex justify-content-center mb-2">
                                    <img src="{{ $about->image ? asset('storage/' . $about->image) : 'https://themewagon.github.io/startup2/img/about.jpg' }}"
                                        alt="" class="img-fluid" width="150" height="150">
                                </div>
                                <form action="{{ route('dashboard.about.update', $about->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row mb-3">
                                        <label for="title" class="col-md-4 col-form-label">Judul</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="title"
                                                placeholder="Enter Name here" name="title" value="{{ $about->title }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="phone_number" class="col-md-4 col-form-label">Nomor Telepon</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" id="phone_number"
                                                placeholder="08123456789" name="phone_number"
                                                value="{{ $about->phone_number }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-form-label">Gambar</label>
                                        <div class="col-md-8">
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="description" class="col-md-4 col-form-label">Deskripsi</label>
                                        <div class="col-md-8">
                                            <textarea name="description" id="description" cols="15" rows="5" class="form-control"
                                                placeholder="deskripsi">{{ $about->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-send me-2 fs-4"></i>
                                                    Submit
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('dashboard.about.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="title" class="col-md-4 col-form-label">Judul</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="title"
                                                placeholder="Enter Name here" name="title" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="phone_number" class="col-md-4 col-form-label">Nomor Telepon</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" id="phone_number"
                                                placeholder="08123456789" name="phone_number" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class="col-md-4 col-form-label">Gambar</label>
                                        <div class="col-md-8">
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="description" class="col-md-4 col-form-label">Deskripsi</label>
                                        <div class="col-md-8">
                                            <textarea name="description" id="description" cols="15" rows="5" class="form-control"
                                                placeholder="deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-send me-2 fs-4"></i>
                                                    Submit
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- --------------------------------------------------- -->
        <!--  Form Basic End -->
        <!-- --------------------------------------------------- -->
    </div>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
