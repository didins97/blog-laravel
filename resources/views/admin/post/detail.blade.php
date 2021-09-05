<div class="container">
    <div class="form-group">
        {{-- <label class="font-weight-bold" for="image">Gambar</label> --}}
        <br>
        <img src="{{ asset( $posts->gambar ) }}" class="rounded mx-auto d-block" width="400" alt="">
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="form-group">
                <label class="font-weight-bold" for="judul">Judul</label>
                <br>
                <p>{{ $posts->judul }}</p>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-group">
                <label class="font-weight-bold" for="judul">Category</label>
                <br>
                <p>{{ $posts->category->name }}</p>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-group">
                <label class="font-weight-bold" for="judul">Tags</label>
                <br>
                <ul class="list-inline">
                    @foreach ($posts->tags as $tag)
                    <li class="list-inline-item">{{ $tag->name }}
                    <li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
            <dt class="col-sm-3">Description lists</dt>
            <dd class="col-sm-9">A description list is perfect for defining terms.</dd>
    </div>
</div>
{{-- <div class="row">
    <div class="col-sm-6">
        
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label  class="font-weight-bold" for="judul">Judul</label>
            <br>
            <p>{{ $posts->judul }}</p>
</div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label class="font-weight-bold" for="judul">Category</label>
        <br>
        <p>{{ $posts->category->name }}</p>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label class="font-weight-bold" for="judul">Tags</label>
        <br>
        @foreach ($posts->tags as $tag)
        <ul>
            <li>{{ $tag->name }}</li>
        </ul>
        @endforeach
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <label class="font-weight-bold" for="judul">Tags</label>
        <br>
        <p>{{$posts->content}}</p>
    </div>
</div>
</div> --}}
