@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h3>Edit Data NCR</h3>
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
                                            <option value="I" @selected($data->periode_audit == 'I') @selected(old('periode_audit') == 'I')>I</option>
                                            <option value="II" @selected($data->periode_audit == 'II') @selected(old('periode_audit') == 'I')>II</option>
                                        </select>
                                        @if ($errors->has('periode_audit'))
                                            <span class="text-danger">{{ $errors->first('periode_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Proses audit <span class="text-danger">
                                                * </span> </label>
                                        <select name="proses_audit" id="proses_audit"
                                            class="form-control {{ $errors->first('proses_audit') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            <option value="Internal" @selected($data->proses_audit == 'Internal') @selected(old('proses_audit') == 'Internal')>Internal</option>
                                            <option value="Eksternal" @selected($data->proses_audit == 'Eksternal') @selected(old('proses_audit') == 'Internal')>Eksternal</option>
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
                                                <option value="{{ $data_usersTema->id }}" @selected($data_usersTema->id == $data->tema_audit) @selected($data_usersTema->id == old('tema_audit')) >
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

                                        <select name="objek_audit" id="objek_audit"
                                            class="form-control {{ $errors->first('objek_audit') ? 'is-invalid' : '' }}"
                                            required>
                                            <option value="">- Pilih -</option>
                                            @foreach ($usersAuditee as $data_usersAuditee)
                                                <option value="{{ $data_usersAuditee->id }}" @selected($data_usersAuditee->id == old('objek_audit'))>
                                                    {{ $data_usersAuditee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('objek_audit'))
                                            <span class="text-danger">{{ $errors->first('objek_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Bab yang diaudit <span
                                                class="text-danger"> * </span></label>
                                        <input type="text" name="bab_audit"
                                            class="form-control {{ $errors->first('bab_audit') ? 'is-invalid' : '' }}"
                                            id="bab_audit" value="{{ old('bab_audit') }}"
                                            {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
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
                                            id="dok_acuan" value="{{ old('dok_acuan') }}"
                                            {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                        @if ($errors->has('dok_acuan'))
                                            <span class="text-danger">{{ $errors->first('dok_acuan') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Uraian ketidaksesuaian <span
                                                class="text-danger"> * </span></label>
                                        <textarea class="form-control {{ $errors->first('uraian_ncr') ? 'is-invalid' : '' }}" name="uraian_ncr" id="uraian_ncr"
                                            rows="5" {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>{{ old('uraian_ncr') }}</textarea>
                                        @if ($errors->has('uraian_ncr'))
                                            <span class="text-danger">{{ $errors->first('uraian_ncr') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Kategori <span class="text-danger"> *
                                            </span></label>
                                        <select name="kategori" id="kategori"
                                            class="form-control {{ $errors->first('kategori') ? 'is-invalid' : '' }}"
                                            {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                            <option value="">- Pilih -</option>
                                            <option value="Mayor" @selected(old('kategori') == 'Mayor')>Mayor</option>
                                            <option value="Minor" @selected(old('kategori') == 'Minor')>Minor</option>
                                        </select>
                                        @if ($errors->has('kategori'))
                                            <span class="text-danger">{{ $errors->first('kategori') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Tanda tangan auditor <span
                                                class="text-danger"> * </span></label>
                                        <input type="file" name="ttd_auditor"
                                            class="form-control  {{ $errors->first('ttd_auditor') ? 'is-invalid' : '' }}"
                                            id="ttd_auditor"
                                            {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>

                                        <span class="text-danger">"Format file .jpeg,jpg,png"</span>
                                        @if ($errors->has('ttd_auditor'))
                                            <span class="text-danger">{{ $errors->first('ttd_auditor') }}</span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="colFormLabel" class="form-label">Tanggal terbit NCR <span class="text-danger"> * </span> </label>
                                
                                    <input type="date" name="tgl_terbitncr" class="form-control" id="tgl_terbitncr"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Pilih Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="colFormLabel" class="form-label">Tanggal deadline NCR <span class="text-danger"> * </span> </label>
                                
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        placeholder="Pilih Tanggal" readonly>
                            </div> --}}


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
@endsection
