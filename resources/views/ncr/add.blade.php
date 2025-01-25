@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5 justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Input Data NCR</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('data-ncr/add') }}" method="post" enctype="multipart/form-data" id="form_add_ncr">
                            @csrf
                            <div class="row-mb-3">
                                <label for="colFormLabel">Jenis temuan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="NCR" id="jenis_temuan"
                                    name="jenis_temuan" readonly>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel">Periode audit <span class="text-danger">*</span></label>
                                <select name="periode_audit" id="periode_audit"
                                    class="form-control {{ $errors->has('periode_audit') ? 'is-invalid' : '' }}">
                                    <option value="">- Pilih -</option>
                                    <option value="I" @selected(old('periode_audit') == 'I')>I</option>
                                    <option value="II" @selected(old('periode_audit') == 'II')>II</option>
                                </select>
                                @if ($errors->has('periode_audit'))
                                    <div class="text-danger">{{ $errors->first('periode_audit') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel">Proses audit
                                    <span class="text-danger">*</span></label>
                                <select name="proses_audit" id="proses_audit"
                                    class="form-control  {{ $errors->has('proses_audit') ? 'is-invalid' : '' }}">
                                    <option value="">- Pilih -</option>
                                    <option value="Internal" @selected(old('proses_audit') == 'Internal')>Internal </option>
                                    <option value="Eksternal" @selected(old('proses_audit') == 'Eksternal')>Eksternal</option>
                                </select>
                                @if ($errors->has('proses_audit'))
                                    <div class="text-danger">{{ $errors->first('proses_audit') }}</div>
                                @endif
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel">Tema audit <span class="text-danger">*</span></label>
                                <select name="tema_audit" id="tema_audit"
                                    class="form-control {{ $errors->has('tema_audit') ? 'is-invalid' : '' }}">
                                    <option value="">- Pilih -</option>
                                    @foreach ($usersTema as $data_usersTema)
                                        <option value="{{ $data_usersTema->id }}" @selected(old('tema_audit') == $data_usersTema->id)>
                                            {{ $data_usersTema->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tema_audit'))
                                    <div class="text-danger">{{ $errors->first('tema_audit') }}</div>
                                @endif
                            </div>
                            <br>

                            <div class="row-mb-3">
                                <label for="colFormLabel">Objek audit <span class="text-danger">*</span></label>
                                <select name="objek_audit" id="objek_audit"
                                    class="form-control {{ $errors->has('objek_audit') ? 'is-invalid' : '' }}">
                                    <option value="">- Pilih -</option>
                                    @foreach ($usersAuditee as $data_usersAuditee)
                                        <option value="{{ $data_usersAuditee->id }}" @selected(old('objek_audit') == $data_usersAuditee->id)>
                                            {{ $data_usersAuditee->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('objek_audit'))
                                    <div class="text-danger">{{ $errors->first('objek_audit') }}</div>
                                @endif
                            </div>
                            <br>

                            <div class="mb-3">
<<<<<<< HEAD
<<<<<<< HEAD
                                <label >Tanggal terbit NCR <span class="text-danger">*</span></label>
=======
                                <label for="colFormLabel">Tanggal terbit NCR <span class="text-danger">*</span></label>
>>>>>>> parent of 9bade0d... update ncr
                                <input type="date" name="tgl_terbitncr" class="form-control" id="tgl_terbitncr"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Pilih Tanggal"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>

                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel">Tanggal deadline NCR <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_deadline"
                                    class="form-control {{ $errors->has('tgl_deadline') ? 'is-invalid' : '' }}"
                                    id="tgl_deadline" placeholder="Pilih Tanggal" value="{{ old('tgl_deadline') }}"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                @if ($errors->has('tgl_deadline'))
                                    <div class="text-danger">{{ $errors->first('tgl_deadline') }}</div>
                                @endif
                            </div>

=======
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal terbit NCR</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitncr" class="form-control" id="tgl_terbitncr"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Pilih Tanggal">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal deadline NCR</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        placeholder="Pilih Tanggal" readonly>
                                </div>
                            </div>

                            <br><br>
                            <input type="submit" name="Simpan" value="Next" class="btn btn-info"></input>
                            <a href="{{ url('data-ncr') }}" title="Kembali" class="btn btn-secondary">Batal</a>
>>>>>>> parent of 7e490e9 (progress change backdate rev 2)
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-end">
                            <input type="button" onclick="document.getElementById('form_add_ncr').submit();" name="Simpan"
                                value="Next" class="btn btn-info mr-2">
                            <a href="{{ url('data-ncr') }}" title="Kembali" class="btn btn-secondary">Batal</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitncr = document.getElementById('tgl_terbitncr');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitncr.addEventListener('change', function() {
                if (tgl_terbitncr.value !== '') {
                    var deadline = new Date(tgl_terbitncr.value);
                    deadline.setDate(deadline.getDate() + 30);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
