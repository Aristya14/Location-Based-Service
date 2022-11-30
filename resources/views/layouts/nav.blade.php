<!doctype html>
<html lang="en">
 
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
      <title>Daftar Produk</title>
  </head>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgb(88, 171, 157)">
    <!-- Container wrapper -->
    <div class="container">
      <!-- Navbar brand -->
      <a class="navbar-brand me-2" href="#">
        <img
          src="\storage\map-in.png"
          height="50"
          alt="Logo"
          loading="lazy"
          style="margin-top: -10px;margin-bottom:-10px;text-align:center"
        />
      </a>
  
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarButtonsExample"
        aria-controls="navbarButtonsExample"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">All Location</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/list">List My Location</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/create">Create New Location</a>
              </li>
          </ul>
        <!-- Left links -->
  
        
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <body>
    @yield('content')
  </body>