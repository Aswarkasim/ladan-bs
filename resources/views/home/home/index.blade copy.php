
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($banner as $key => $item)
    <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$item->urutan == '1' ? 'active' : ''}}"></li>
    @endforeach
  </ol>
  <div class="carousel-inner">

    @foreach ($banner as $item)
        
    <div class="carousel-item {{$item->urutan == '1' ? 'active' : ''}}">
      <img class="first-slide" src="{{$item->image}}" alt="First slide">
      <div class="container">
        <div class="carousel-caption text-left">
          <h1>{{$item->topik}}</h1>
          <p>{{$item->desc}}</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
        </div>
      </div>
    </div>
    @endforeach

  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="container">
  <div class="row">
    @foreach ($post as $item)
    <div class="col-3 overflow-hidden">
      <div class="rounded shadow-sm p-0">
        <div class="img-post-wrapper">
          <img src="/{{$item->image}}" class="img-post" alt="">
        </div>
        <div class="p-2">
          <a href="/home/post/show/{{$item->slug}}"><h5><strong>{{$item->title}}</strong></h5></a>
          <>{!!$item->excerpt!!} <a href="">Baca Selengkapnya &rightarrow;</a></p>
        </div>
      </div>
    </div>
    @endforeach

    
  </div>
</div>

