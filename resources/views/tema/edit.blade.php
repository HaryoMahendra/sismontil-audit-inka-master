@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Edit {{ $title }}</h2>
                        </div><br>
                        <form action="{{ route('tema.update', $tema->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama tema</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_tema" value="{{ $tema->nama_tema }}"
                                        class="form-control" required id="nama_tema" placeholder="Masukkan Nama Tema">
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                            <a href="{{ url('tema') }}" title="Batal" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const password_input = document.getElementById('password');
        const show_password_toggle = document.getElementById('show_password_toggle');

        show_password_toggle.addEventListener('click', function() {
            if (password_input.type === 'password') {
                password_input.type = 'text';
                // show_password_toggle.innerHTML = '<i class="bi bi-eye-slash"></i>';
                show_password_toggle.innerHTML = 'Hide';
            } else {
                password_input.type = 'password';
                // show_password_toggle.innerHTML = '<i class="bi bi-eye"></i>';
                show_password_toggle.innerHTML = 'Show';
            }
        });
    </script>
@endsection
