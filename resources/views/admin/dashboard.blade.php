<?php 
    use Carbon\Carbon;  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="{{asset('CSS/administry.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/std.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/mainpage.css')}}">    

    <link rel="stylesheet" href="{{asset('CSS/std_control.css')}}">  <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('css\adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head> 
<body style="overflow: hidden; height: calc(100% - 61px)">
    <main>
        <header> 
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="DARA Logo" class="ahh">
            </div>
        </header>

        <div class="main" style="height: 100%;">
            <div class="left">
                <div class="profile">
                    <h2>{{ auth()->user()->first_name }}</h2>
                </div>

                <nav class="nav-links">
                    <a href="" style="color: #04128e; font-weight: normal;"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="admin/user-control">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-users"
                            >
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Manage Users
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                    </div>

                    <a href="admin/edit" class="unq">Edit Account</a>
                    <a href="admin/recovery" class="unq">Recovery</a>
                    
                    <div class="asd2" style=" width: 100%; 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                    </div>
                    
                    <form action="/out" method="POST">
                        @csrf
                        <button class="lgt">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-log-in"
                                >
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>

                            Logout
                        </button>
                    </form>
                </nav>
            </div>

            <div class="right" style="overflow-x: hidden; display: flex; flex-direction: column; flex-wrap: nowrap; justify-content: flex-start; align-items: normal;">
                <div class="tp">
                    <main class="app-main" style="padding: 0;">
                        <div class="app-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <!-- Total Users -->
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box text-bg-primary">
                                            <div class="inner">
                                                <h3>{{ $totalUsers }}</h3>
                                                <p>Total User(s)</p>
                                            </div>
                                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"/>
                                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"/>
                                            </svg>
                                            <a href="admin/user-control" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                                        </div>
                                    </div>

                                    <!-- Unread Notifications -->
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box text-bg-danger">
                                            <div class="inner">
                                                <h3>{{ $totalMsgs }}</h3>
                                                <p>Account(s) Suspended</p>
                                            </div>

                                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 62 62" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <g>
                                                    <g>
                                                        <circle cx="24.87" cy="13.811" r="13.811"/>
                                                        <path d="M6.972,52.484l9.718,2.56c4.215,1.109,11.004,0.979,15.173-0.293l3.93-1.205c2.209,2.614,5.505,4.281,9.188,4.281    c6.633,0,12.03-5.397,12.03-12.03c0-6.635-5.397-12.032-12.03-12.032c-1.124,0-2.207,0.167-3.239,0.456    c-2.494-3.016-5.696-5.299-9.631-6.58c-2.292,1.345-4.947,2.129-7.791,2.129c-2.857,0-5.527-0.792-7.826-2.149    c-7.347,2.302-12.55,7.888-15.278,15.2C-0.311,46.905,2.757,51.374,6.972,52.484z M44.95,35.346    c5.732,0,10.378,4.646,10.378,10.38c0,5.732-4.646,10.379-10.378,10.379s-10.379-4.646-10.379-10.379    C34.572,39.992,39.217,35.346,44.95,35.346z"/>
                                                        <path d="M39.138,51.036c0.365,0.402,0.866,0.604,1.37,0.604c0.446,0,0.896-0.16,1.251-0.485l3.19-2.916l3.189,2.916    c0.356,0.325,0.805,0.485,1.251,0.485c0.502,0,1.003-0.203,1.37-0.604c0.691-0.755,0.638-1.93-0.118-2.621l-2.943-2.691    l2.943-2.691c0.756-0.691,0.809-1.864,0.118-2.621c-0.691-0.757-1.864-0.808-2.621-0.118l-3.189,2.918l-3.19-2.918    c-0.757-0.691-1.929-0.638-2.621,0.118c-0.691,0.757-0.639,1.93,0.118,2.621l2.944,2.691l-2.944,2.691    C38.5,49.106,38.448,50.281,39.138,51.036z"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            <a href="admin/recovery" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-6">
                                        <div class="small-box text-bg-light">
                                            <div class="inner">
                                                <h3>STATIC</h3>
                                                <p>Total Space Used</p>
                                            </div>
                                            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                
                                                <g>
                                                    <path class="st0" d="M0,25.6v119.467h512V25.6H0z M110.933,110.916h-51.2v-51.2h51.2V110.916z"/>
                                                    <path class="st0" d="M0,315.733h512V196.267H0V315.733z M59.733,230.383h51.2v51.2h-51.2V230.383z"/>
                                                    <path class="st0" d="M0,486.4h512V366.933H0V486.4z M59.733,401.05h51.2v51.2h-51.2V401.05z"/>
                                                </g>
                                            </svg>
                                            <a href="admin/storage" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <!-- Study Overview -->
                <div class="md">
                    <div style="width: 100%; margin-right: 20px;" class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Study Overview</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="fw-bold fs-5">STATIC</span> 
                                    <span>Total Studies in the Database</span>
                                </p>
                                <p class="ms-auto d-flex flex-column text-end">
                                    <span class="STATIC">
                                        <i class="bi STATIC"></i> 
                                        STATIC
                                    </span>
                                    <span class="text-secondary">Since last month</span>
                                </p>
                            </div>
                            <div class="position-relative mb-4">
                                <div id="visitors-chart"></div>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="me-2"><i class="bi bi-square-fill text-primary"></i> Studies Published</span>
                                <span><i class="bi bi-square-fill text-secondary"></i> Studies Unpublished</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container" style="width: 300px" >
                        <h2>Study Distribution Overview</h2>
                        <canvas id="studyStatusChart" width="300" height="300" style="display: block; box-sizing: border-box;"></canvas>
                        <div id="legend" style="margin-top: 10px; width: auto; display: flex;">
                            <div class="xd3left" style="width: 100%">

                            </div>
                            <div class="xd3right" style="width: 100%">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Users Online -->
                <div class="bt">
                    <div class="recent-activity">
                        <h2>Recent Users Online</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Online</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentUsersOnline as $user)
                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ Carbon::parse($user->last_login)->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="ft">
                    <footer class="main-footer" style="color: #869099;;">
                        <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                        All rights reserved.
                        <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 3.2.0
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>

        <footer>
        </footer>
    </main>
</body>
</html>

    <!-- <script>
        // ✅ 1. PIE CHART - Role Distribution
        const userRolesData = json($studyDistribution);
        const studyStatusCtx = document.getElementById('studyStatusChart').getContext('2d');
        const half = Math.ceil(userRolesData.length / 2);
        const leftData = userRolesData.slice(0, half);  // First half
        const rightData = userRolesData.slice(half);    // Second half

        const studyStatusChart = new Chart(studyStatusCtx, {
            type: 'pie',
            data: {
                labels: userRolesData.map(item => item.status),
                datasets: [{
                    label: 'Study Count',
                    data: userRolesData.map(item => item.count),
                    backgroundColor: ['black', '#28a745', 'grey', '#FF9F40', '#0d6efd', '#dc3545']
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        color: '#fff',
                        formatter: (value, context) => context.chart.data.labels[context.dataIndex],
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        anchor: 'center',   
                        align: 'center',    
                        offset: 0,        
                        borderRadius: 4,
                        backgroundColor: '#00000088', 
                        padding: 6
                    }
                }
            }
        });

        const leftLegendContainer = document.querySelector('.xd3left');
        leftLegendContainer.innerHTML = leftData.map((item, index) => `
            <div style="display: flex; align-items: center; margin-bottom: 10px; flex-direction: row-reverse">
                <div style="
                    width: 20px;
                    height: 20px;
                    background-color: ${studyStatusChart.data.datasets[0].backgroundColor[index]}; /* Using the background color from the chart */
                    margin-right: 10px;
                    margin-left: 10px;
                    border-radius: 4px;">
                </div>
                <span style="font-size: 14px;">${item.status}</span>
            </div>
        `).join('');

        const rightLegendContainer = document.querySelector('.xd3right');
        rightLegendContainer.innerHTML = rightData.map((item, index) => `
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <div style="
                    width: 20px;
                    height: 20px;
                    background-color: ${studyStatusChart.data.datasets[0].backgroundColor[index + half]}; /* Offset the color for the second half */
                    margin-right: 10px;
                    border-radius: 4px;">
                </div>
                <span style="font-size: 14px;">${item.status}</span>
            </div>
        `).join('');

        // ✅ 2. LINE GRAPH - Number of Studies Published Per Month
        const studiesPerMonth = json($studiesPerMonth);
        const documentOverviewCtx = document.getElementById('documentOverviewChart').getContext('2d');

        // Generate last 8 months dynamically
        const now = new Date();
        const monthLabels = [];
        const studiesData = Array(8).fill(0);

        for (let i = 7; i >= 0; i--) {
            const date = new Date();
            date.setMonth(now.getMonth() - i);
            monthLabels.push(date.toLocaleString('default', { month: 'long' }));
        }

        // Fill in the data based on the last 8 months
        studiesPerMonth.forEach(item => {
            const date = new Date();
            date.setMonth(item.month - 1);
            const monthName = date.toLocaleString('default', { month: 'long' });
            const index = monthLabels.indexOf(monthName);
            if (index !== -1) {
                studiesData[index] = item.total;
            }
        });

        const documentOverviewChart = new Chart(documentOverviewCtx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Number of Studies Published',
                    data: studiesData,
                    backgroundColor: 'rgba(4, 18, 142, 0.2)',
                    borderColor: '#04128e',
                    borderWidth: 2,
                    pointBackgroundColor: '#04128e',
                    pointRadius: 4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month',
                            color: '#666',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Studies',
                            color: '#666',
                            font: {
                                weight: 'bold'
                            }
                        },
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Ensure whole numbers only
                        }
                    }
                }
            }
        });

    </script> -->
</body>
</html>

<script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset ('js/adminlte.js')}} "></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>

    <!-- <script>
      const visitors_chart_options = {
        series: [
            {
                name: 'Studies Published',
                data: json($published)
            },
            {
                name: 'Studies Unpublished',
                data: json($unpublished)
            }
        ],
        chart: {
            height: 200,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        colors: ['#0d6efd', '#adb5bd'],
        stroke: {
            curve: 'smooth'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            }
        },
        legend: {
            show: false
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: json($months)
        }
    };

    const visitors_chart = new ApexCharts(
    document.querySelector('#visitors-chart'),
    visitors_chart_options,
    );
    visitors_chart.render();
    </script> -->
