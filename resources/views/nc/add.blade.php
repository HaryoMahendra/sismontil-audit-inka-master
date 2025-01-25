@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4>
                                Input Data NC
                            </h4>
                        </div><br>
                        <form action="{{ url('data-nc/add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Opsi Temuan</label>
                                <div class="col-sm-6">
                                    <select name="opsi_temuan" id="opsi_temuan" class="form-control">
                                        <option value="NCR">NCR</option>
                                        <option value="OFI">OFI</option>
                                        <option value="Observasi">Observasi</option>
                                        <option value="CAR">CAR</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NC</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_nc" class="form-control" id="no_nc"
                                        value="{{ $nc->no_nc }}">
                                </div>
                            </div> --}}

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Periode Audit</label>
                                <div class="col-sm-6">
                                    <select name="periode_audit" id="periode_audit" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" id="proses_audit" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Internal">Internal</option>
                                        <option value="Eksternal">Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option>ISO 9001</option>
                                        <option>ISO 45001</option>
                                        <option>ISO 14001</option>
                                        <option>ISO 37001</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}">{{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" id="objek_audit" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}">{{ $data_usersAuditee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="NC" id="jenis_temuan"
                                        name="jenis_temuan" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit NC</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitnc" class="form-control" id="tgl_terbitnc"
                                        placeholder="Pilih Tanggal">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline NC</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        placeholder="Pilih Tanggal">
                                </div>
                            </div>

                            <br><br>
                            <input type="submit" name="Simpan" value="Next" class="btn btn-info"></input>
                            <a href="{{ url('data-nc') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitnc = document.getElementById('tgl_terbitnc');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitnc.addEventListener('change', function() {
                if (tgl_terbitnc.value !== '') {
                    var deadline = new Date(tgl_terbitnc.value);
                    deadline.setDate(deadline.getDate() + 30);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
