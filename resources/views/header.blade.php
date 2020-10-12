<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Nov 2019 07:34:08 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <!--  Social tags      -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.minf066.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="../uploads/{{Session::get('udata')->photo}}"/>
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                {{Session::get('udata')->fname}}&nbsp;{{Session::get('udata')->lname}}
              </span>
            </a>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="/admin">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/admin/wing">
              <i class="fa fa-building-o" aria-hidden="true"></i>
              <p> Wing </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#society" aria-expanded="false">
              <i class="fa fa-user-circle" aria-hidden="true"></i>
              <p> Society Members
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="society" style="">
              <ul class="nav">
                 <li class="nav-item ">
                    <a class="nav-link" href="/admin/society-member">
                      <p> Society Members </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="/admin/verify-society-member">
                      <!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
                      <p> Verify Society Members </p>
                    </a>
                  </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/admin/amenitie">
              <i class="material-icons">insert_invitation</i>
              <p> Amenities </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/admin/maintenance">
              <i class="fa fa-money" aria-hidden="true"></i>
              <p> Maintenance </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#service" aria-expanded="false">
              <i class="material-icons">store</i>
              <p> Services
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="service" style="">
              <ul class="nav">
                 <li class="nav-item ">
                    <a class="nav-link" href="/admin/service-type">
                      <p> Service Type </p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="/admin/service-provider">
                      <!-- <i class="fa fa-user-circle" aria-hidden="true"></i> -->
                      <p> Service Provider </p>
                    </a>
                  </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/admin/wallet">
              <i class="fa fa-money" aria-hidden="true"></i>
              <p> Wallet </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/admin/broadcast-message">
              <i class="fa fa-commenting" aria-hidden="true"></i>
              <p> Broadcast Message </p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#">Society Management System</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/logout">Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
    </div>
  </div>