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
                        <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Role<span class="text-danger"> *
                                    </span> </label>
                                <div class="col-sm-6">
                                    <select name="role_id" id="role_id"
                                        class="form-control" onchange="disableDepartement(this)">>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role['id'] }}"
                                                {{$user->role_id == $role['id'] ? 'selected' : ''}}>
                                                {{$role['role']}}
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
                                    <select name="departement_id" id="departement_id" class="selectpicker form-control {{ $errors->first('departement_id') ? 'is-invalid' : '' }}" data-live-search="true" data-size="5"
                                        @if (in_array($user->role_id, ['1', '2', '4']))
                                            disabled
                                        @endif>
                                        <option id="none" value="" disabled selected>- Pilih -</option>
                                        @foreach ($departemen as $dept)
                                            <option value="{{ $dept['div_code'] }}"
                                                {{ $user->departement_id == $dept['div_code'] ? 'selected' : '' }}>
                                                {{ $dept['div_name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('departement_id'))
                                        <span class="text-danger">{{ $errors->first('departement_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <select name="name" id="name" class="selectpicker form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" data-live-search="true" data-size="5">
                                        @foreach ($pegawai as $peg)
                                            <option value="{{ $peg['name']}}"
                                                {{$user->name == $peg['name'] ? 'selected' : ''}}
                                                nip="{{ $peg['nip'] }}"
                                                jabatan="{{$peg['label']}}">
                                                {{ $peg['name'] }} / {{ $peg['nip'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            </div>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nip" id="nip" class="form-control" value="{{ $user->nip }}" readonly>
                                        @if ($errors->has('nip'))
                                        <span class="text-danger">{{ $errors->first('nip') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $user->jabatan }}" readonly>
                                        @if ($errors->has('jabatan'))
                                        <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" value="{{ $user->username }}"
                                        class="form-control" required id="username" placeholder="Masukkan Username">
                                        @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan <span
                                    class="text-danger"> * </span></label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd"
                                        class="form-control  {{ $errors->first('ttd') ? 'is-invalid' : '' }}"
                                        id="ttd">
                                    <span class="text-danger">"Format file .jpeg,jpg,png"</span>
                                    @if ($errors->has('ttd'))
                                        <span class="text-danger">{{ $errors->first('ttd') }}</span>
                                    @endif
                                </div>
                            </div> --}}
                            {{-- <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Masukkan Password">
                                    <div class="input-group">
                                        <input value="{{ $password }}" type="password" name="password"
                                            class="form-control" required id="password" placeholder="Masukkan Password">
                                        <button type="button" class="btn btn-info" id="show_password_toggle">
                                            <i class="bi bi-eye"></i>
                                            show
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                            <br><br>
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
            $('.selectpicker').css('border', '1px solid #ced4da');
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
