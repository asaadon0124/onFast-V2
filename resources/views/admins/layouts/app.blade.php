@include('admins.layouts.header')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admins.layouts.navbar')
    @include('admins.layouts.sidebar')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admins.layouts.page_header')

    <!-- Main content -->
    <section class="content">
        @yield('content')
    
    </section>
  </div>

  @include('admins.layouts.footer')
