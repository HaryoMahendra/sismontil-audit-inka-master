@extends('layouts.main')

@section('page-title', 'Pengguna')
@section('breadcrumb')
    <li><a href="{{ url('user') }}">Pengguna</a></li>
    <li class="active">Tambah Pengguna</li>
@endsection

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Tambah {{ $title }}</h2>
                        </div><br>
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Role<span class="text-danger"> *
                                    </span> </label>
                                <div class="col-sm-6">
                                    <select name="role_id" id="role_id" onchange="disableDepartement(this)"
                                        class="form-control {{ $errors->first('role_id') ? 'is-invalid' : '' }}">
                                        <option value="" selected disabled>- Pilih -</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if (old('role_id') == $role->id) selected @endif>{{ $role->role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Divisi/Departemen</label>
                                <div class="col-sm-6">
                                    <select name="departement_id" id="departement_id"
                                        class="selectpicker form-control {{ $errors->first('departement_id') ? 'is-invalid' : '' }}"
                                        data-live-search="true" data-size="5">
                                        <option disabled selected value="">-- Pilih --</option>
                                        @foreach ($departemen as $dept)
                                            <option value="{{ $dept['div_code'] }}"
                                                @if (old('departement_id') == $dept['div_code']) selected @endif>
                                                {{ $dept['div_name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('departement_id'))
                                        <span class="text-danger">{{ $errors->first('departement_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama<span class="text-danger"> *
                                    </span> </label>
                                <div class="col-sm-6">
                                    <select name="name" id="name"
                                        class="selectpicker form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                        data-live-search="true" data-size="5">
                                        <option disabled selected value="">Masukkan Nama Pengguna</option>
                                        @foreach ($pegawai as $peg)
                                            <option value="{{ $peg['name'] }}"
                                                @if (old('name') == $peg['name']) selected @endif nip="{{ $peg['nip'] }}"
                                                jabatan="{{ $peg['label'] }}">
                                                {{ $peg['name'] }} / {{ $peg['nip'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">NIP<span class="text-danger"> *
                                    </span> </label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') == $peg['nip'] }}" readonly> --}}
                                    <input type="text" name="nip" id="nip" class="form-control" readonly>
                                    @if ($errors->has('nip'))
                                        <span class="text-danger">{{ $errors->first('nip') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel"
                                    class="col-sm-2 col-form-label {{ $errors->first('jabatan') ? 'is-invalid' : '' }}">Jabatan<span
                                        class="text-danger"> * </span> </label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="jabatan" id="jabatan" class="form-control"
                                        value="{{ old('jabatan') == $peg['label'] }}" readonly> --}}
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" readonly>
                                    @if ($errors->has('jabatan'))
                                        <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label {{ $errors->first('ttd') ? 'is-invalid' : '' }}" >Tanda tangan <span
                                        class="text-danger"> * </span></label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd" accept="image/*"
                                        class="form-control  {{ $errors->first('ttd') ? 'is-invalid' : '' }}">
                                        @if ($errors->has('ttd'))
                                            <span class="text-danger">{{ $errors->first('ttd') }}</span>
                                        @else
                                            <span class="text-danger">"Format file .jpeg,jpg,png"</span>
                                        @endif
                                </div>
                            </div> --}}
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Username<span class="text-danger">
                                        * </span> </label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Masukkan Username" value="{{ old('username') }}">
                                    @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Password<span class="text-danger">
                                        * </span> </label>
                                <div class="col-sm-6">
                                    {{-- <input type="password" name="password" class="form-control" required id="password"
                                        placeholder="Masukkan Password"> --}}
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Masukkan Password">
                                        <button type="button" class="btn btn-info" id="show_password_toggle">
                                            {{-- <i class="bi bi-eye"></i> --}}
                                            show
                                        </button>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div><br><br>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                            <a href="{{ route('user.index') }}" title="Batal" class="btn btn-secondary">Batal</a>
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

        // const inputA = document.getElementById('role_id');
        // const inputB = document.getElementById('departement_id');

        // inputA.addEventListener('change', () => {
        //     if (inputA.value === '3') {
        //         inputB.disabled = false;
        //     } else {
        //         inputB.disabled = true;
        //     }
        // });

        // const inputC = document.getElementById('span');

        // inputC.addEventListener('change', () => {
        //     if (inputA.value === '3') {
        //     inputB.disabled = false;
        // } else {
        //     inputB.disabled = true;
        // }
        // });
    </script>

    <script>
        function disableDepartement() {
            var role_id = $('#role_id').val();
            if (role_id === '3') {
                $('#departement_id').prop('disabled', false).selectpicker('refresh');;
            } else {
                $('#departement_id').prop('disabled', true).selectpicker('refresh');;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker({
                var name = selectedOption.text().slice(0, selectedOption.text().indexOf('/'));
            });
        });
    </script>

    <script>
        document.getElementById("name").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var nip = selectedOption.getAttribute("nip");
            var jabatan = selectedOption.getAttribute("jabatan");

            document.getElementById("nip").value = nip;
            document.getElementById("jabatan").value = jabatan;
        });
    </script>
@endsection
