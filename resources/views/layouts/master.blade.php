<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <!-- Google Fonts for Material Icons and Roboto -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::asset('Css/main.css')}}" />
  @yield('styles')
</head>
<body>
  <div class="container">
    <!-- Sidebar Navigation -->
    <div class="navigation">
      <ul>
        <!-- Brand / Logo -->
        <li>
          <a href="#">
            <span class="icon material-icons"></span>
            <span class="title-dashboad">MyAdmin</span>
          </a>
        </li>
        <!-- Menu Items -->
        <li>
          <a href="#">
            <span class="icon material-icons">dashboard</span>
            <span class="title">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('doctors.index')}}">
            <span class="icon material-icons">people</span>
            <span class="title">Doctors </span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon material-icons">task</span>
            <span class="title">Tasks</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon material-icons">notifications</span>
            <span class="title">Notifications</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon material-icons">settings</span>
            <span class="title">Settings</span>
          </a>
        </li>
        <li>
          <a href="{{route('logout')}}">
            <span class="icon material-icons">logout</span>
            <span class="title">Sign Out</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Main content area -->
    <div class="main">
      <!-- Top bar -->
      <div class="topbar">
        <!-- Hamburger toggle for sidebar -->
        <div class="toggle">
          <span class="material-icons">menu</span>
        </div>
        <!-- Page title -->
        <div class="pageTitle">@yield('Page-Title')</div>
        <!-- User icon -->
        <div class="user">
          <span class="material-icons">account_circle</span>  
        </div>
      </div>

      <!-- Dashboard Cards -->


      <!-- Details Section: User table and Notifications -->
    @yield('mainContent')
    </div>
  </div>
  @yield('scripts')
  <script src="{{URL::asset('JS/main.js')}}"></script>
</body>
</html>
