@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
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
                                    <img src="{{ asset('storage/' . $about->image) }}" alt="" class="img-fluid"
                                        width="150" height="150">
                                </div>
                                <form action="{{ route('dashboard.about.update', $about->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="title"
                                                    placeholder="Enter Name here" name="title"
                                                    value="{{ $about->title }}" />
                                                <label for="title">Judul</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="phone_number"
                                                    placeholder="08123456789" name="phone_number"
                                                    value="{{ $about->phone_number }}" />
                                                <label for="phone_number">Nomor Telepon</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image">Gambar</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <textarea name="description" id="description" cols="15" rows="5" class="form-control"
                                                    placeholder="deskripsi">{{ $about->description }}</textarea>
                                                <label for="description">Deskripsi</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3">

                                                <div class="ms-auto mt-3 mt-md-0">
                                                    <button type="submit"
                                                        class="btn btn-info font-medium rounded-pill px-4">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ti ti-send me-2 fs-4"></i>
                                                            Submit
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('dashboard.about.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="title"
                                                    placeholder="Enter Name here" name="title" />
                                                <label for="title">Judul</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="phone_number"
                                                    placeholder="08123456789" name="phone_number" />
                                                <label for="phone_number">Nomor Telepon</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image">Gambar</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <textarea name="description" id="description" cols="15" rows="5" class="form-control"
                                                    placeholder="deskripsi"></textarea>
                                                <label for="description">Deskripsi</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3">

                                                <div class="ms-auto mt-3 mt-md-0">
                                                    <button type="submit"
                                                        class="btn btn-info font-medium rounded-pill px-4">
                                                        <div class="d-flex align-items-center">
                                                            <i class="ti ti-send me-2 fs-4"></i>
                                                            Submit
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
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
