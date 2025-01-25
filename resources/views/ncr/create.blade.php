@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h3>Input Data NCR</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-ncr.store') }}" id="ncr_form" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Periode audit <span
                                                class="text-danger"> * </span> </label>
                                        <select name="periode_audit" id="periode_audit"
                                            class="form-control {{ $errors->first('periode_audit') ? 'is-invalid' : '' }}">
                                            <option value="" selected disabled>- Pilih -</option>
                                            <option value="I" @selected(old('periode_audit') == 'I')>I</option>
                                            <option value="II" @selected(old('periode_audit') == 'II')>II</option>
                                        </select>
                                        @if ($errors->has('periode_audit'))
                                            <span class="text-danger">{{ $errors->first('periode_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Proses audit <span class="text-danger">
                                                * </span> </label>
                                        <select name="proses_audit" id="proses_audit" onchange="disableAuditorEksternal(this)"
                                            class="form-control {{ $errors->first('proses_audit') ? 'is-invalid' : '' }}">
                                            <option value="" selected disabled>- Pilih -</option>
                                            <option value="Internal" @selected(old('proses_audit') == 'Internal')>Internal</option>
                                            <option value="Eksternal" @selected(old('proses_audit') == 'Eksternal')>Eksternal</option>
                                        </select>
                                        @if ($errors->has('proses_audit'))
                                            <span class="text-danger">{{ $errors->first('proses_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Tema audit <span class="text-danger"> *
                                            </span> </label>
                                        <select name="tema_audit" id="tema_audit"
                                            class="form-control {{ $errors->first('tema_audit') ? 'is-invalid' : '' }}">
                                            <option value="" selected disabled>- Pilih -</option>
                                            @foreach ($usersTema as $data_usersTema)
                                                <option value="{{ $data_usersTema->id }}" @selected($data_usersTema->id == old('tema_audit'))>
                                                    {{ $data_usersTema->nama_tema }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('tema_audit'))
                                            <span class="text-danger">{{ $errors->first('tema_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Objek audit <span class="text-danger">
                                                * </span> </label>
                                            <select name="objek_audit" id="objek_audit" class="selectpicker form-control" data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            <option value="" selected disabled>- Pilih -</option>
                                            @foreach ($data as $dat)
                                                <option value="{{ $dat['div_code'] }}"
                                                @if (old('objek_audit') == $dat['div_code']) selected @endif
                                                name_objek_audit="{{ $dat['div_name'] }}">
                                                {{ $dat['div_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="name_objek_audit" id="name_objek_audit" value="{{ old('name_objek_audit') }}">
                                        @if ($errors->has('objek_audit'))
                                            <span class="text-danger">{{ $errors->first('objek_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Bab yang diaudit <span
                                                class="text-danger"> * </span></label>
                                        <input type="text" name="bab_audit"
                                            class="form-control {{ $errors->first('bab_audit') ? 'is-invalid' : '' }}"
                                            id="bab_audit" value="{{ old('bab_audit') }}">
                                        @if ($errors->has('bab_audit'))
                                            <span class="text-danger">{{ $errors->first('bab_audit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Dokumen acuan <span
                                                class="text-danger"> * </span></label>
                                        <input type="text" name="dok_acuan"
                                            class="form-control {{ $errors->first('dok_acuan') ? 'is-invalid' : '' }}"
                                            id="dok_acuan" value="{{ old('dok_acuan') }}">
                                        @if ($errors->has('dok_acuan'))
                                            <span class="text-danger">{{ $errors->first('dok_acuan') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Uraian ketidaksesuaian <span
                                                class="text-danger"> * </span></label>
                                        <textarea class="form-control {{ $errors->first('uraian_ncr') ? 'is-invalid' : '' }}" name="uraian_ncr" id="uraian_ncr"
                                            rows="5">{{ old('uraian_ncr') }}</textarea>
                                        @if ($errors->has('uraian_ncr'))
                                            <span class="text-danger">{{ $errors->first('uraian_ncr') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Kategori <span class="text-danger"> *
                                            </span></label>
                                        <select name="kategori" id="kategori"
                                            class="form-control {{ $errors->first('kategori') ? 'is-invalid' : '' }}">
                                            <option value="" selected disabled>- Pilih -</option>
                                            <option value="Mayor" @selected(old('kategori') == 'Mayor')>Mayor</option>
                                            <option value="Minor" @selected(old('kategori') == 'Minor')>Minor</option>
                                            <option value="Kritikal" @selected(old('kategori') == 'Kritikal')>Kritikal</option>
                                            <option value="Observasi" @selected(old('kategori') == 'Observasi')>Observasi</option>
                                        </select>
                                        @if ($errors->has('kategori'))
                                            <span class="text-danger">{{ $errors->first('kategori') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Nama Auditor <span class="text-danger">*</span></label>
                                        <select name="nama_auditor" id="nama_auditor" class="selectpicker form-control" data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            <option value="">- Pilih -</option>
                                            @foreach ($pegawai as $peg)
                                                    <option value="{{ $peg['name']}}" 
                                                    @if (old('nama_auditor') == $peg['name']) selected @endif
                                                    nip_penerbitan_auditor="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }} </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_penerbitan_auditor" id="nip_penerbitan_auditor" value="{{ old('nip_penerbitan_auditor') }}">
                                        @if ($errors->has('nama_auditor'))
                                            <span class="text-danger">{{ $errors->first('nama_auditor') }}</span>
                                        @endif                                                  
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Nama auditor eksternal (Diisi apabila proses auditnya eksternal)<span class="text-danger"> * </span></label>
                                        <input type="text" name="auditor_eksternal"
                                            class="form-control {{ $errors->first('auditor_eksternal') ? 'is-invalid' : '' }}"
                                            id="auditor_eksternal" value="{{ old('auditor_eksternal') }}">
                                        @if ($errors->has('auditor_eksternal'))
                                            <span class="text-danger">{{ $errors->first('auditor_eksternal') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-end">
                            <button onclick="document.getElementById('ncr_form').submit()" value="Next"
                                class="btn btn-info mr-2"> Simpan </button>
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

    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker({
                var name = selectedOption.text().slice(0, selectedOption.text().indexOf('/')),
            });
        });
    </script>

    <script>
        document.getElementById("nama_auditor").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var nip = selectedOption.getAttribute("nip_penerbitan_auditor");

            document.getElementById("nip_penerbitan_auditor").value = nip;
        });

        document.getElementById("objek_audit").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var name_objek_audit = selectedOption.getAttribute("name_objek_audit");

            document.getElementById("name_objek_audit").value = name_objek_audit;
        });
    </script>

    <script>
        function disableAuditorEksternal() {
            var prosesAudit = $('#proses_audit').val();
            console.log("proses_audit value:", prosesAudit);
            if (prosesAudit === 'Eksternal') {
                document.getElementById('auditor_eksternal').disabled = false;
                console.log("auditor_eksternal is enabled");
            } else {
                document.getElementById('auditor_eksternal').disabled = true;
                console.log("auditor_eksternal is disabled");
            }
        }

        $(document).ready(function() {
            disableAuditorEksternal();
            $('#proses_audit').on('change', function() {
                disableAuditorEksternal();
            });
        });
    </script>
@endsection
