<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div class="alert-message">
        <ul>
            @foreach ($errors->all() as $error)
                @if (Str::contains($error, 'There was an error on row'))
                    @php
                        $error = str_replace('There was an error on row','Ada kesalahan pada baris', $error);
                    @endphp
                @endif
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
