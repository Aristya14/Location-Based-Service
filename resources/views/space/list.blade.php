@extends('layouts.nav')
@section('content')
  <body>
    <h3 style="font-family: Lucida Handwriting; margin:25px 0 25px 0; text-align:center">
        List My Location</h3>
        <div class="container" style="text-align:center; position:inline-block;">
        @foreach($data as $d)
          
            <div class="card" style="width: 20rem; float:left; margin: 25px; background-color:rgb(222, 245, 236)">
              <div>
                  <img src="{{ asset('storage/uploads/' . $d->image) }}" class="card-img-top"style="width: 120px; height:150px;text-align:center; margin-top: 10px;">
              </div>  
              <div class="card-body">
                    <p class="card-text"><b>{{ $d->name }}</b></p>
                    <p class="card-text">{{ $d->street }}</p>
                      <a href="{{ route('map.show' , $d->slug) }}" class="btn" style="background-color: rgb(188, 190, 189)">Detail</a>
                      
                </div>
            </div>
        @endforeach
        </div>
              
 
          <footer class="text-muted" style="clear: both;">
              <hr>
              <div class="container">
                  <p class="float-right">
                      <a href="#">Back to top</a>
                  </p>
              </div>
          </footer>
 
 
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
              integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
              crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
              integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
              crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
              integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
              crossorigin="anonymous"></script>
  </body>
 @endsection
</html>