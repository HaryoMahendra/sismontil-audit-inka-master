@extends('layouts.main')

@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
  }
  .main-content-inner {
  background-color: #f8f9fa;
  padding: 0 15px;
}
  .equal-height-card {
    display: flex;
    flex-wrap: wrap;
  }
  .equal-height-card > .col {
    display: flex;
    flex-direction: column;
  }
  .equal-height-card .card {
    flex: 1;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
  }
  .chart-container {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .chart-container canvas {
    width: 100% !important;
    height: 400px !important;
  }
  .card-header {
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .card-summary {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .card-summary .icon {
    font-size: 24px;
    margin-left: 1rem;
    color: #666;
  }
  input[type="radio"].btn-check {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }
</style>

@section('content')
<div class="main-content-inner">
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dashboard Monitoring Tindak Lanjut Audit</h4>
                    <br>
                    
                    {{-- Filter Data --}}
                    <div class="mb-3">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <select class="form-select form-select-sm" style="width: auto; min-width: 160px;" id="tahunSelect" onchange="renderBarChart()">
                                <option value="all">Semua Tahun</option>
                                <option value="2023">Tahun Audit: 2023</option>
                                <option value="2024">Tahun Audit: 2024</option>
                                <option value="2025">Tahun Audit: 2025</option>
                                <option value="2026">Tahun Audit: 2026</option>
                            </select>
                            <select class="form-select form-select-sm" style="width: auto; min-width: 160px;" id="temaSelect" onchange="renderBarChart()">
                            <option value="all">Semua Tema</option>
                                <option value="ISO 9001">ISO 9001 : 2015</option>
                                <option value="IRS 22163">ISO IRS 22163:2023</option>
                            </select>
                            <select class="form-select form-select-sm" style="width: auto; min-width: 160px;" id="prosesSelect" onchange="renderBarChart()">
                                <option value="all">Semua Proses</option>
                                <option value="Internal">Internal</option>
                                <option value="Eksternal">Eksternal</option>
                            </select>
                        </div>
                    </div>



                    <div class="row mb-4 text-center">
                        <div class="col-md-3">
                            <div class="card p-3 d-flex flex-row align-items-center justify-content-between"
                                style="border-left: 5px solid #3b82f6; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border-radius: 10px;">
                                <div>
                                    <div class="text-muted small">Total Data NCR</div>
                                    <h3 class="text-primary mb-0" id="totalNCR">0</h3>
                                </div>
                                <div class="text-secondary" style="font-size: 24px;"><i class="fa-solid fa-database"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 d-flex flex-row align-items-center justify-content-between"
                                style="border-left: 5px solid #10b981; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border-radius: 10px;">
                                <div>
                                    <div class="text-muted small">Total Data NCR Close</div>
                                    <h3 class="text-success mb-0" id="totalNCRClose">0</h3>
                                </div>
                                <div class="text-secondary" style="font-size: 24px;"><i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 d-flex flex-row align-items-center justify-content-between"
                                style="border-left: 5px solid #06b6d4; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border-radius: 10px;">
                                <div>
                                    <div class="text-muted small">Total data OFI</div>
                                    <h3 class="text-info mb-0" id="totalOFI">0</h3>
                                </div>
                                <div class="text-secondary" style="font-size: 24px;"><i class="fa-solid fa-database"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3 d-flex flex-row align-items-center justify-content-between"
                                style="border-left: 5px solid #f59e0b; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border-radius: 10px;">
                                <div>
                                    <div class="text-muted small">Total OFI Close</div>
                                    <h3 class="text-warning mb-0" id="totalOFIClose">0</h3>
                                </div>
                                <div class="text-secondary" style="font-size: 24px;"><i class="fa-solid fa-circle-check"></i></div>
                            </div>
                        </div>
                    </div>

 <!-- Grafik Section -->
    <!-- Grafik Section -->
<div class="row row-cols-1 row-cols-md-2 g-4 equal-height-card">
  <!-- Grafik Bar -->
  <div class="col">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-primary text-white text-center fw-bold fs-5">
        Grafik Monitoring Tindak Lanjut Audit
      </div>
      <div class="card-body chart-container d-flex flex-column">
        <div class="d-flex flex-wrap gap-2 mb-3">
          <input type="radio" class="btn-check" name="barFilter" id="barFilterOFI" autocomplete="off" checked onchange="renderBarChart()">
          <label class="btn btn-outline-primary" for="barFilterOFI">Data OFI</label>
          <input type="radio" class="btn-check" name="barFilter" id="barFilterNCR" autocomplete="off" onchange="renderBarChart()">
          <label class="btn btn-outline-success" for="barFilterNCR">Data NCR</label>
          <input type="radio" class="btn-check" name="barFilter" id="barFilterAll" autocomplete="off" onchange="renderBarChart()">
          <label class="btn btn-outline-secondary" for="barFilterAll">Semua</label>
        </div>

        <canvas id="barChart" class="flex-grow-1 w-100"></canvas>
        <div class="table-responsive mt-3">
          <table class="table table-bordered text-center align-middle" id="summaryTable">
            <thead>
              <tr>
                <th style="width: 70px;"></th>
                <th>HCGA</th>
                <th>PRODUKSI</th>
                <th>MRK</th>
                <th>LOGISTIK</th>
                <th>PEMASARAN</th>
                <th>PKPB</th>
                <th>TEKNOLOGI</th>
                <th>PABRIK BWI</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Line -->
  <div class="col">
    <div class="card shadow-sm h-100">
      <div class="card-header bg-primary text-white text-center fw-bold fs-5">
        Grafik Hasil Temuan Audit Per Tahun
      </div>
      <div class="card-body chart-container d-flex flex-column">
       <div class="d-flex flex-wrap gap-2 mb-3">
          <input type="radio" class="btn-check" name="lineFilter" id="lineFilterInternal" autocomplete="off" checked onchange="renderLineChart('Internal')">
          <label class="btn btn-outline-primary" for="lineFilterInternal">Internal</label>

          <input type="radio" class="btn-check" name="lineFilter" id="lineFilterEksternal" autocomplete="off" onchange="renderLineChart('Eksternal')">
          <label class="btn btn-outline-success" for="lineFilterEksternal">Eksternal</label>

          <input type="radio" class="btn-check" name="lineFilter" id="lineFilterAll" autocomplete="off" onchange="renderLineChart('all')">
          <label class="btn btn-outline-secondary" for="lineFilterAll">Semua</label>
        </div>

        <canvas id="lineChart" width="600" height="400" class="flex-grow-1 w-100"></canvas>
        <div class="table-responsive mt-3">
          <table class="table table-bordered text-center" id="lineChartTable">
            <thead>
              <tr>
                <th style="width: 70px;"></th>
                <th>2023</th>
                <th>2024</th>
                <th>2025</th>
                <th>2026</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    const barDataByFilter = {
      '2023': {
        'ISO 9001': {
          'Internal': {  OFI: [5, 4, 6, 3, 2, 7, 5, 6], NCR: [2, 3, 2, 4, 3, 2, 4, 5] },
          'Eksternal': { OFI: [6, 5, 4, 6, 5, 6, 4, 3], NCR: [3, 2, 1, 2, 2, 3, 2, 3] }
        },
        'IRS 22163': {
          'Internal': { OFI: [4, 5, 3, 6, 4, 5, 6, 7], NCR: [3, 2, 4, 3, 2, 3, 4, 2] },
          'Eksternal': { OFI: [5, 6, 5, 4, 6, 5, 7, 8], NCR: [2, 3, 2, 1, 3, 2, 1, 2] }
        }
      },
      '2024': {
        'ISO 9001': {
          'Internal': {  OFI: [3, 6, 4, 7, 5, 3, 4, 6], NCR: [4, 2, 3, 4, 2, 4, 3, 2] },
          'Eksternal': { OFI: [2, 3, 4, 4, 3, 2, 3, 2], NCR: [1, 2, 1, 2, 1, 2, 1, 2] }
        },
        'IRS 22163': {
          'Internal': { OFI: [3, 5, 4, 1, 3, 2, 1, 1], NCR: [2, 2, 3, 3, 4, 4, 1, 1] },
          'Eksternal': { OFI: [4, 7, 6, 5, 3, 4, 6, 7], NCR: [1, 2, 3, 3, 2, 1, 2, 3] }
        }
      },
      '2025': {
        'ISO 9001': {
          'Internal': { OFI: [3, 4, 5, 6, 7, 5, 4, 3], NCR: [1, 1, 1, 1, 1, 1, 1, 1] },
          'Eksternal': { OFI: [2, 1, 1, 2, 2, 3, 6, 1], NCR: [1, 1, 1, 2, 2, 2, 3, 3] }
        },
        'IRS 22163': {
          'Internal': { OFI: [6, 5, 4, 3, 2, 1, 3, 4], NCR: [2, 3, 4, 5, 2, 3, 4, 2] },
          'Eksternal': { OFI: [7, 6, 5, 4, 3, 2, 1, 2], NCR: [3, 2, 1, 2, 3, 2, 1, 3] }
        }
      },
      '2026': {
        'ISO 9001': {
          'Internal': { OFI: [1, 2, 3, 4, 5, 6, 7, 8], NCR: [2, 3, 4, 5, 2, 3, 4, 2] },
          'Eksternal': { OFI: [8, 7, 6, 5, 4, 3, 2, 1], NCR: [3, 2, 1, 2, 3, 2, 1, 3] }
        },
        'IRS 22163': {
          'Internal': { OFI: [5, 6, 7, 8, 6, 5, 4, 3], NCR: [2, 3, 4, 2, 3, 4, 5, 2] },
          'Eksternal': { OFI: [4, 5, 6, 7, 8, 6, 5, 4], NCR: [3, 2, 1, 2, 3, 2, 1, 3] }
        }
      }
    };

    function renderBarChart() {
  const tahun = document.getElementById("tahunSelect").value;
  const tema = document.getElementById("temaSelect").value;
  const proses = document.getElementById("prosesSelect").value;
  const barType = document.querySelector('input[name="barFilter"]:checked').id;
  const ctx = document.getElementById('barChart').getContext('2d');

  let data = { OFI: Array(8).fill(0), NCR: Array(8).fill(0) };
  let dataClose = { OFI: Array(8).fill(0), NCR: Array(8).fill(0) };
  let totalNCR = 0;
  let totalOFI = 0;
  let totalNCRClose = 0;
  let totalOFIClose = 0;

  Object.keys(barDataByFilter).forEach(year => {
    if (tahun === 'all' || tahun === year) {
      Object.keys(barDataByFilter[year]).forEach(theme => {
        if (tema === 'all' || tema === theme) {
          Object.keys(barDataByFilter[year][theme]).forEach(proc => {
            if (proses === 'all' || proses === proc) {
              let current = barDataByFilter[year][theme][proc];
              data.OFI = data.OFI.map((v, i) => v + current.OFI[i]);
              data.NCR = data.NCR.map((v, i) => v + current.NCR[i]);
              dataClose.OFI = dataClose.OFI.map((v, i) => v + Math.floor(current.OFI[i] / 2));
              dataClose.NCR = dataClose.NCR.map((v, i) => v + Math.floor(current.NCR[i] / 2));
              totalOFI += current.OFI.reduce((a, b) => a + b, 0);
              totalNCR += current.NCR.reduce((a, b) => a + b, 0);
              totalOFIClose += current.OFI.reduce((a, b) => a + Math.floor(b / 2), 0);
              totalNCRClose += current.NCR.reduce((a, b) => a + Math.floor(b / 2), 0);
            }
          });
        }
      });
    }
  });

  document.getElementById("totalOFI").textContent = totalOFI;
  document.getElementById("totalNCR").textContent = totalNCR;
  document.getElementById("totalOFIClose").textContent = totalOFIClose;
  document.getElementById("totalNCRClose").textContent = totalNCRClose;

  const labelDivisi = ['HCGA', 'PRODUKSI', 'MRK', 'LOGISTIK', 'PEMASARAN', 'PKPB', 'TEKNOLOGI', 'PABRIK BWI'];
  let datasets = [];
  const isOFI = barType === 'barFilterOFI';
  const isNCR = barType === 'barFilterNCR';
  const isAll = barType === 'barFilterAll';

  if (isOFI || isAll) {
    datasets.push({
      label: 'OFI',
      data: data.OFI.map((v, i) => v - dataClose.OFI[i]),
      backgroundColor: '#0118D8',
      stack: 'OFI'
    });
    datasets.push({
      label: 'OFI Close',
      data: dataClose.OFI,
      backgroundColor: '#FFEB00',
      stack: 'OFI'
    });
  }
  if (isNCR || isAll) {
    datasets.push({
      label: 'NCR',
      data: data.NCR.map((v, i) => v - dataClose.NCR[i]),
      backgroundColor: '#28a745',
      stack: 'NCR'
    });
    datasets.push({
      label: 'NCR Close',
      data: dataClose.NCR,
      backgroundColor: '#FFEB00',
      stack: 'NCR'
    });
  }

  if (window.barChartInstance) window.barChartInstance.destroy();
  window.barChartInstance = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labelDivisi,
      datasets: datasets
    },
    options: {
      responsive: true,
      plugins: { legend: { display: true } },
      scales: {
        y: {
          beginAtZero: true,
          stacked: true,
          title: {
            display: true,
            text: 'Jumlah Temuan Audit'
          }
        }
      }
    }
  });

  const tbody = document.querySelector("#summaryTable tbody");
tbody.innerHTML = `
  <tr><th style="color: #0118D8;">OFI</th>${data.OFI.map(val => `<td>${val}</td>`).join('')}</tr>
  <tr><th style="color: #28a745;">NCR</th>${data.NCR.map(val => `<td>${val}</td>`).join('')}</tr>`;
}


    const lineDataFull = {
      labels: ['2023', '2024', '2025', '2026'],
      internal: {
        OFI: [2.1, 3.4, 2.3, 3.2],
        NCR: [4.0, 2.0, 3.1, 4.2]
      },
      eksternal: {
        OFI: [1.9, 2.3, 1.5, 2.4],
        NCR: [3.6, 2.5, 2.8, 3.0]
      }
    };

   function renderLineChart(source = 'all') {
  const ctx = document.getElementById('lineChart').getContext('2d');
  let datasets = [];
  let ofiData = [], ncrData = [];

  if (source === 'Internal' || source === 'all') {
    datasets.push({ label: 'OFI - Internal', data: lineDataFull.internal.OFI, borderColor: '#0118D8', fill: false });
    datasets.push({ label: 'NCR - Internal', data: lineDataFull.internal.NCR, borderColor: '#28a745', fill: false });
    ofiData = lineDataFull.internal.OFI;
    ncrData = lineDataFull.internal.NCR;
  }
  if (source === 'Eksternal' || source === 'all') {
    datasets.push({ label: 'OFI - Eksternal', data: lineDataFull.eksternal.OFI, borderColor: '#0118D8', borderDash: [5, 5], fill: false });
    datasets.push({ label: 'NCR - Eksternal', data: lineDataFull.eksternal.NCR, borderColor: '#28a745', borderDash: [5, 5], fill: false });
    if (source === 'Eksternal') {
      ofiData = lineDataFull.eksternal.OFI;
      ncrData = lineDataFull.eksternal.NCR;
    } else if (source === 'all') {
      ofiData = lineDataFull.internal.OFI.map((v, i) => (v + lineDataFull.eksternal.OFI[i]) / 2);
      ncrData = lineDataFull.internal.NCR.map((v, i) => (v + lineDataFull.eksternal.NCR[i]) / 2);
    }
  }

  if (window.lineChartInstance) window.lineChartInstance.destroy();
  window.lineChartInstance = new Chart(ctx, {
    type: 'line',
    data: { labels: lineDataFull.labels, datasets: datasets },
    options: {
      responsive: true,
      plugins: { legend: { display: true } },
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Jumlah Temuan Audit'
          }
        }
      }
    }
  });

  const tbody = document.querySelector("#lineChartTable tbody");
  tbody.innerHTML = `
    <tr><th style="color: #0118D8;">OFI</th>${ofiData.map(v => `<td>${v?.toFixed(1) ?? '-'}</td>`).join('')}</tr>
    <tr><th style="color: #28a745;">NCR</th>${ncrData.map(v => `<td>${v?.toFixed(1) ?? '-'}</td>`).join('')}</tr>
  `;
}

    window.onload = function () {
      renderBarChart();
      renderLineChart('Internal');
    };
  </script>
@endsection

