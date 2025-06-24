@extends('layouts.main')

@section('page-title', 'Data OFI')
@section('breadcrumb')
    <li><a href="{{ url('data-ofi') }}">Data OFI</a></li>
    <li class="active">Input Data OFI</li>
@endsection

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h3>Input Data OFI</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-ofi.store') }}" id="ofi_form" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Kepada <span class="text-danger"> *</span> </label>
                                        <select name="kepada" id="kepada"
                                            class="form-control {{ $errors->first('kepada') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            <option value="Wakil Manajemen" @selected(old('kepada') == 'Wakil Manajemen')>Wakil Manajemen
                                            </option>
                                            <option value="Ketua Fungsi Kepatuhan Anti Penyuapan"
                                                @selected(old('kepada') == 'Ketua Fungsi Kepatuhan Anti Penyuapan')>Ketua Fungsi Kepatuhan Anti Penyuapan</option>
                                        </select>
                                        @if ($errors->has('kepada'))
                                            <span class="text-danger">{{ $errors->first('kepada') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Periode audit <span class="text-danger"> * </span> </label>
                                        <select name="periode_audit" id="periode_audit"
                                            class="form-control {{ $errors->first('periode_audit') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            <option value="I" @selected(old('periode_audit') == 'I')>I</option>
                                            <option value="II" @selected(old('periode_audit') == 'II')>II</option>
                                        </select>
                                        @if ($errors->has('periode_audit'))
                                            <span class="text-danger">{{ $errors->first('periode_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Proses audit <span class="text-danger">* </span> </label>
                                        <select name="proses_audit" id="proses_audit" onchange="disableAuditorEksternal(this)"
                                            class="form-control {{ $errors->first('proses_audit') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            <option value="Internal" @selected(old('proses_audit') == 'Internal')>Internal</option>
                                            <option value="Eksternal" @selected(old('proses_audit') == 'Eksternal')>Eksternal</option>
                                        </select>
                                        @if ($errors->has('proses_audit'))
                                            <span class="text-danger">{{ $errors->first('proses_audit') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Tema audit <span class="text-danger"> *</span> </label>
                                        <select name="tema_audit" id="tema_audit"
                                            class="form-control {{ $errors->first('tema_audit') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
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
                                    {{-- <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Objek audit <span class="text-danger">* </span> </label>
                                        <select name="objek_audit" id="objek_audit"
                                            class="form-control {{ $errors->first('objek_audit') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            @foreach ($departemen as $dep)
                                                @foreach ($data as $dat)
                                                    @if ($dat['div_code'] == $dep)
                                                        <option value="{{ $dep }}"
                                                            @if (old('objek_audit') == $dep) selected @endif>
                                                            {{ $dat['div_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @if ($errors->has('objek_audit'))
                                            <span class="text-danger">{{ $errors->first('objek_audit') }}</span>
                                        @endif
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Objek Audit<span class="text-danger">*</span></label>
                                        <select name="objek_audit" id="objek_audit" class="selectpicker form-control {{ $errors->first('objek_audit') ? 'is-invalid' : '' }}" data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            <option value="">- Pilih -</option>
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
                                        <label for="colFormLabel" class="form-label">Dari Bagian Departemen <span class="text-danger">* </span> </label>
                                        <select name="dari_bagian_dept" id="dari_bagian_dept" class="selectpicker form-control" data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            <option value="">- Pilih -</option>
                                            {{-- @foreach ($departemen as $dep)
                                                @foreach ($data as $dat)
                                                    @if ($dat['div_code'] == $dep)
                                                        <option value="{{ $dep }}"
                                                            @if (old('dari_bagian_dept') == $dep) selected @endif>
                                                            {{ $dat['div_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach --}}
                                            @foreach ($data as $dat)
                                            <option value="{{ $dat['div_code'] }}"
                                                @if (old('dari_bagian_dept') == $dat['div_code']) selected @endif>
                                                {{ $dat['div_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('dari_bagian_dept'))
                                            <span class="text-danger">{{ $errors->first('dari_bagian_dept') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Proyek <span class="text-danger"> * </span></label>
                                        <input type="text" name="proyek"
                                            class="form-control {{ $errors->first('proyek') ? 'is-invalid' : '' }}"
                                            id="proyek" value="{{ old('proyek') }}">
                                        @if ($errors->has('proyek'))
                                            <span class="text-danger">{{ $errors->first('proyek') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Usulan Peningkatan produk/proses/sistem mutu <span class="text-danger">* </span> </label>
                                        <select name="usulan_peningkatan" id="usulan_peningkatan"
                                            class="form-control {{ $errors->first('usulan_peningkatan') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            <option value="Produk" @selected(old('usulan_peningkatan') == 'Produk')>Produk</option>
                                            <option value="Proses" @selected(old('usulan_peningkatan') == 'Proses')>Proses</option>
                                            <option value="Sistem Mutu" @selected(old('usulan_peningkatan') == 'Sistem Mutu')>Sistem Mutu</option>
                                        </select>
                                        @if ($errors->has('usulan_peningkatan'))
                                            <span class="text-danger">{{ $errors->first('usulan_peningkatan') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Identitas (No.Part/No.Tack/No.Dokumen)<span class="text-danger"> * </span></label>
                                        <select name="identitas" id="identitas"
                                            class="form-control {{ $errors->first('identitas') ? 'is-invalid' : '' }}">
                                            <option value="">- Pilih -</option>
                                            <option value="No.Part" @selected(old('identitas') == 'No.Part')>No.Part</option>
                                            <option value="No.Tack" @selected(old('identitas') == 'No.Tack')>No.Tack</option>
                                            <option value="No.Dokumen" @selected(old('identitas') == 'No.Dokumen')>No.Dokumen</option>
                                        </select>
                                        @if ($errors->has('identitas'))
                                            <span class="text-danger">{{ $errors->first('identitas') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">No.Identitas </label>
                                        <input type="text" name="no_identitas"
                                            class="form-control {{ $errors->first('no_identitas') ? 'is-invalid' : '' }}"
                                            id="no_identitas" value="{{ old('no_identitas') }}">
                                        @if ($errors->has('no_identitas'))
                                            <span class="text-danger">{{ $errors->first('no_identitas') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Diusulkan oleh<span class="text-danger"> * </span></label>
                                        <select name="diusulkan_oleh" id="diusulkan_oleh" class="selectpicker form-control" data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            <option value="">- Pilih -</option>
                                            @foreach ($pegawai as $peg)
                                                    <option value="{{ $peg['name']}}" 
                                                    @if (old('diusulkan_oleh') == $peg['name']) selected @endif
                                                    nip_auditor="{{ $peg['nip'] }}">
                                                    {{ $peg['name'] }} / {{ $peg['nip'] }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="nip_auditor" id="nip_auditor" value="{{ old('nip_auditor') }}">
                                        @if ($errors->has('diusulkan_oleh'))
                                            <span class="text-danger">{{ $errors->first('diusulkan_oleh') }}</span>
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
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Departemen yang mengerjakan <span class="text-danger">* </span> </label>
                                        <select name="dept_ygmngrjkn" id="dept_ygmngrjkn" class="selectpicker form-control" data-live-search="true" data-size="5" style="border: 1px solid #ced4da;">
                                            <option value="">- Pilih -</option>
                                            {{-- @foreach ($departemen as $dep)
                                                @foreach ($data as $dat)
                                                    @if ($dat['div_code'] == $dep)
                                                        <option value="{{ $dep }}"
                                                            @if (old('dept_ygmngrjkn') == $dep) selected @endif>
                                                            {{ $dat['div_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach --}}
                                            @foreach ($data as $dat)
                                            <option value="{{ $dat['div_code'] }}"
                                                @if (old('dept_ygmngrjkn') == $dat['div_code']) selected @endif>
                                                {{ $dat['div_name'] }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('dept_ygmngrjkn'))
                                            <span class="text-danger">{{ $errors->first('dept_ygmngrjkn') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Uraian Permasalahan <span class="text-danger"> * </span></label>
                                        <textarea class="form-control {{ $errors->first('uraian_permasalahan') ? 'is-invalid' : '' }}" name="uraian_permasalahan" id="uraian_permasalahan"
                                            rows="5">{{ old('uraian_permasalahan') }}</textarea>
                                        @if ($errors->has('uraian_permasalahan'))
                                            <span class="text-danger">{{ $errors->first('uraian_permasalahan') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Uraian Peningkatan <span class="text-danger"> * </span></label>
                                        <textarea class="form-control {{ $errors->first('uraian_peningkatan') ? 'is-invalid' : '' }}" name="uraian_peningkatan" id="uraian_peningkatan"
                                            rows="5">{{ old('uraian_peningkatan') }}</textarea>
                                        @if ($errors->has('uraian_peningkatan'))
                                            <span class="text-danger">{{ $errors->first('uraian_peningkatan') }}</span>
                                        @endif
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Tanda tangan diusulkan oleh <span
                                                class="text-danger"> * </span></label>
                                        <input type="file" name="ttd_dept_pengusul" accept="image/*"
                                            class="form-control  {{ $errors->first('ttd_dept_pengusul') ? 'is-invalid' : '' }}">
                                        <span class="text-danger">"Format file .jpeg,jpg,png"</span>
                                        @if ($errors->has('ttd_dept_pengusul'))
                                            <span class="text-danger">{{ $errors->first('ttd_dept_pengusul') }}</span>
                                        @endif
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="colFormLabel" class="form-label">Tanggal diusulkan <span class="text-danger">*</span></label>
                                            <input type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addDays(60)->format('Y-m-d') }}" name="tgl_diusulkan" id="tgl_diusulkan" class="form-control  {{ $errors->first('tgl_diusulkan') ? 'is-invalid' : '' }}"
                                                    value="{{ old('tgl_diusulkan') }}">
                                            @if ($errors->has('tgl_diusulkan'))
                                            <span class="text-danger">{{ $errors->first('tgl_diusulkan') }}</span>
                                            @endif
                                    </div>
                                </div>
                            </div>

                    {{-- <div class="form-group">
                                <label for="colFormLabel" class="form-label">Tanggal terbit OFI <span class="text-danger"> * </span> </label>
                                
                                    <input type="date" name="tgl_terbitofi" class="form-control" id="tgl_terbitofi"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Pilih Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="colFormLabel" class="form-label">Tanggal deadline OFI <span class="text-danger"> * </span> </label>
                                
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        placeholder="Pilih Tanggal" readonly>
                            </div> --}}

                    </form>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-end">
                        <button onclick="document.getElementById('ofi_form').submit()" value="Next"
                            class="btn btn-info mr-2"> Simpan </button>
                        <a href="{{ url('data-ofi') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitofi = document.getElementById('tgl_terbitofi');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitofi.addEventListener('change', function() {
                if (tgl_terbitofi.value !== '') {
                    var deadline = new Date(tgl_terbitofi.value);
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
                var name = selectedOption.text().slice(0, selectedOption.text().indexOf('/'));
            });
        });
    </script>

    <script>
        document.getElementById("diusulkan_oleh").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var nip = selectedOption.getAttribute("nip_auditor");

            document.getElementById("nip_auditor").value = nip;
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
