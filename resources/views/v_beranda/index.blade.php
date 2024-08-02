@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Admin -->
            @if (auth()->user()->roles == 'ADMIN')
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Admin </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $admin }}</h6>
                                    <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            <!-- Guru -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="card-body">
                        <h5 class="card-title">Guru</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $guru }}</h6>
                                <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Operator -->
            @if (auth()->user()->roles == 'OPERATOR' || auth()->user()->roles == 'ADMIN')
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Operator</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-user-pen"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $operator }}</h6>
                                    <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            <!-- Tahfidz -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">Tahfidz</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $tahfidz }}</h6>
                                <span class="text-success small fw-bold pt-1">Jumlah Keseluruhan</span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">Trafik Jumlah Tahfiz Bedasarkan Status</h5>


                        <div id="barChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">10 Santri dengan Hafalan Terendah Tahun
                            {{ \Carbon\Carbon::now()->year }}</h5>

                        <div id="lowestBarChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">10 Santri dengan Hafalan Tertinggi Tahun
                            {{ \Carbon\Carbon::now()->year }}</h5>

                        <div id="highestBarChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-md-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Santri Berdasarkan Juz</h5>
                        <div id="GroupByJuzChart"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Jumlah',
                    data: [{{ $activeStudents }}, {{ $graduatedStudents }}]
                }],
                chart: {
                    type: 'bar',
                    height: 600
                },
                xaxis: {
                    categories: ['Aktif', 'Lulus'], // Kategori bar chart
                    title: {
                        text: 'Status'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah'
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value); // Membulatkan angka tanpa desimal
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        distributed: true, // Distribusi warna per kategori
                    }
                },
                colors: ['#0D6efd', '#198754']
            };

            var chart = new ApexCharts(document.querySelector("#barChart"), options);
            chart.render();
            var options = {
                series: [{
                    name: '',
                    data: [
                        @foreach ($tahfidzSmalles as $hafalan)
                            {{ $hafalan['total_juz'] }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                xaxis: {
                    categories: [
                        @foreach ($tahfidzSmalles as $hafalan)
                            '{{ $hafalan['name'] }}',
                        @endforeach
                    ], // Nama tahfidz
                    title: {
                        text: 'Tahfidz'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Juz'
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value); // Membulatkan angka tanpa desimal
                        }
                    }
                },
                colors: ['#198754'],
                tooltip: {
                    y: {
                        formatter: function(value, {
                            seriesIndex,
                            dataPointIndex
                        }) {
                            // Accessing the name and juz_details from the data array
                            const data = @json($tahfidzSmalles);
                            const name = data[dataPointIndex].name;
                            const juzDetails = data[dataPointIndex].juz_details;

                            // Format the tooltip text
                            return `Total Juz: ${value}<br>Detail Juz: ${juzDetails}`;
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#lowestBarChart"), options);
            chart.render();

            var options = {
                series: [{
                    name: '',
                    data: [
                        @foreach ($tahfidzLargest as $hafalan)
                            {{ $hafalan['total_juz'] }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                xaxis: {
                    categories: [
                        @foreach ($tahfidzLargest as $hafalan)
                            '{{ $hafalan['name'] }}',
                        @endforeach
                    ], // Nama tahfidz
                    title: {
                        text: 'Nama Siswa'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Juz'
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value); // Membulatkan angka tanpa desimal
                        }
                    }
                },
                colors: ['#198754'],
                tooltip: {
                    y: {
                        formatter: function(value, {
                            seriesIndex,
                            dataPointIndex
                        }) {
                            // Accessing the name and juz_details from the data array
                            const data = @json($tahfidzLargest);
                            const name = data[dataPointIndex].name;
                            const juzDetails = data[dataPointIndex].juz_details;

                            // Format the tooltip text
                            return `Total Juz: ${value}<br>Detail Juz: ${juzDetails}`;
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#highestBarChart"), options);
            chart.render();
            var groupedJuzData = @json($groupedJuzData);

            // Extract categories and data
            var categories = groupedJuzData.map(item => item.category);
            var data = groupedJuzData.map(item => item.count);

            // Chart options
            var options = {
                series: [{
                    name: 'Santri',
                    data: data
                }],
                chart: {
                    type: 'bar',
                    height: 600
                },
                xaxis: {
                    categories: categories, // Categories for the X-axis
                    title: {
                        text: 'Juz'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Santri'
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value); // Round the values without decimals
                        }
                    }
                },
                colors: ['#0D6efd'] // Single color for all bars
            };

            // Create and render the chart
            var chart = new ApexCharts(document.querySelector("#GroupByJuzChart"), options);
            chart.render();

        });
    </script>
@endsection
