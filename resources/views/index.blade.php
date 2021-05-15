<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Server Checkup</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html" style="color:white;">Server Checkup</a>
          <a class="navbar-brand brand-logo-mini" style="color:white;" href="index.html">S</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
              <a class="nav-link" href="/log-viewer">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Log Checker</span>
              </a>
              <a class="nav-link" href="/logoutr">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Logout</span>
              </a>
            </li>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
              </div>
            </div>
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2" id="bannerClose"> Server Usage  </h2>
              <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
        
                <div class="dropdown ml-0 ml-md-4 mt-2 mt-lg-0">
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border {">
                
                  <div class="d-md-block d-none">
                    <a href="#" class="text-light p-1"><i class="mdi mdi-view-dashboard"></i></a>
                    <a href="#" class="text-light p-1"><i class="mdi mdi-dots-vertical"></i></a>
                  </div>
                </div>
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Ram Usage</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $ram }}%</h2>
                            <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-lightbulb icon-md absolute-center text-dark"></i></div>
                            <p class="mt-4 mb-0">{{ $memusage }}GB /{{ $memtotal }}GB</p>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{ $ram }}%</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Disk Usage</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $disk_usage }}%</h2>
                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                            <p class="mt-4 mb-0">{{ $disk_used }}GB / {{ $disk_total }}GB</p>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">{{ $disk_usage }}%</h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">IP Server</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $server_name }}</h2>
                            <h5 class="mb-2 text-dark font-weight-normal">PHP Version</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $php_version }}</h2>
                            <h5 class="mb-2 text-dark font-weight-normal">PHP Load</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $php_load }}GB</h2>
                            <h5 class="mb-2 text-dark font-weight-normal">Load Time</h5>
                            <h2 class="mb-4 text-dark font-weight-bold">{{ $load_time }} Second</h2>
                          </div>
                        </div>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Path Log Configuration</h4>
                    <p class="card-description">
                    @if(Session::has('success_write_config'))
                    <button type="button" class="btn btn-success btn-fw">Success Write File Config Goto <a href="/log-viewer">Log Viewer</a></button>
                    @endif
                    @if(Session::has('failed_write_config'))
                    <button type="button" class="btn btn-danger btn-fw">Failed Write File Config</button>
                    @endif
                    </p>
                    <p class="card-description"> Basic form elements </p>
                    <form method="post" action="/postConfig" class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Path To Log</label>
                        <input type="text" name="log_path" class="form-control" name="log_path" id="exampleInputName1" value="{{ $log_config->current_path }}">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputName1">Prefix Pattern</label>
                        <input type="text" name="prefix_pattern" class="form-control" id="exampleInputName1" value="{{ $log_config->pattern_prefix }}">
                      </div>
                      <div class="form-group">
                      <label for="exampleInputName1">Date Pattern</label>
                        <input type="text" name="date_pattern" class="form-control" id="exampleInputName1" value="{{ $log_config->pattern_date}}">
                      </div>
                      {{ csrf_field() }}
                      <div class="form-group">
                      <label for="exampleInputName1">Extension Pattern</label>
                        <input type="text" name="extension_pattern" class="form-control" id="exampleInputName1" value="{{ $log_config->pattern_extension }}">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>