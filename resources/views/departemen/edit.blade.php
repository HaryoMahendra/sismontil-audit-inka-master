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
                        <form action="{{ url('data-departemen/edit/' . $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama departemen</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                        required id="name" placeholder="Masukkan Nama Departemen">
                                </div>
                            </div>
                            <br><br>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                            <a href="{{ url('data-departemen') }}" title="Batal" class="btn btn-secondary">Batal</a>
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
