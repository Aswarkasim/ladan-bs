  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">
          <a href="/admin/posts/post" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>

        @if (Request::is('admin/posts/post/create'))
          <form action="/admin/posts/post" method="POST" enctype="multipart/form-data">  
        @else
          <form action="/admin/posts/post/{{$post->slug}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf

          <div class="row">
            <div class="col-6">

              <div class="form-group">
                <label for="">Judul</label>
                <input type="text" class="form-control  @error('title') is-invalid @enderror"  name="title"  value="{{isset($post) ? $post->title : old('title')}}" placeholder="Judul">
                @error('title')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

             

              <div class="form-group">
                <label for="">Kategori</label>
                <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" >
                  <option value="">-- Kategori --</option>
                  @foreach ($kategori as $item)
                      <option value="{{$item->id}}"
                        <?php 
                          if(isset($post)){
                            if($post->kategori_id == $item->id){
                              echo 'selected';
                            }
                          }
                          ?>
                        >{{$item->nama}}</option>
                  @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

                <div class="form-group">
                <label for="">Gambar</label>
                <input type="file" class="form-control  @error('image') is-invalid @enderror"  name="image"  value="{{isset($post) ? $post->image : old('image')}}" placeholder="Judul">
                @error('image')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror

                @if (isset($post))
                    <img src="/{{$post->image}}" width="100%" class="mt-2" alt="">
                @endif
              </div>

            </div>
            <div class="col-6">
               <div class="form-group">
                <label for="">Isi Berita</label>
                <textarea class="form-control  @error('title') is-invalid @enderror" id="summernote"  name="body" placeholder="Isi Artikel">{{isset($post) ? $post->title : old('title')}}</textarea>
                @error('title')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>
            </div>
          </div>
          

     
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

<script src="/plugins/summernote/summernote-bs4.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

