<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AssetCOD | Dashboard</title>

  @include('Administrator.Layout.cssLink')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">
    @include('Administrator.Layout.header')
    @include('Administrator.Layout.sidebar')
    @yield('content')
    @include('Administrator.Layout.footer')
  </div>

  @include('Administrator.Layout.jsLink')

  @yield('scripts')
 

</body>

</html>
