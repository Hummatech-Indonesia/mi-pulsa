@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="" style="display: grid;gap:1rem;">
            @foreach ($contactUses as $contactUs)
                <div class="p-4 card" style="box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1">
                    <p class="fw-bold">Nama Pengirim: <span>{{ $contactUs->name }}</span></p>
                    <p class="fw-bold">Email Pengirim: <span>{{ $contactUs->email }}</span></p>
                    <p class="fw-bold">Judul: <span>{{ $contactUs->subject }}</span></p>
                    <p class="fw-bold">Pesan: </p>
                    <p>{{ $contactUs->message }}</p>
                </div>
            @endforeach
        </div>
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
