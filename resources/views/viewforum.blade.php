@extends('layout.template')
@section('content')


<section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          {{ $forum->titleForum }}
          <small class="pull-right">{{ $forum->created_at->diffForHumans() }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-xs-12 invoice-col">
        {{-- content --}} <p>{{ $forum->content }}</p>
        
        <ul class="list-inline">
            <div  class="btn-group">
                <button class="btn btn-default"><i class="fa fa-thumbs-o-up margin-r-5"></i>Like</button>
                <button id = "btn-comment" class="btn btn-default"><i class="fa fa-comments-o margin-r-5"></i>Comment</button>
            </div>
            {{-- <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>--}}
        </ul>
      

    {{-- <div class="row"> --}}
    <div class="modal-body">
    <form action = "/comment/{{$forum->id}}/forum" style="display:none" id="comment" method="post">
       @csrf
      <input type="hidden" name="forum_id" value="{{ $forum->id }}"> 
      <input type="hidden" name="parent" value="0">
      <div class="form-group">
      <textarea class="form-control" name="content" id="comment-ckeditor" rows="3" placeholder="Type a comment ..."></textarea>
      <input type="submit" class="btn btn-primary" value="submit">
    </div>
    </form>

    <p><h4>Komentar</h4></p>

    </div>
    {{-- </div> --}}

    {{-- <input style="display:none" id="comment" class="form-control input-sm" type="text" placeholder="Type a comment"> --}}

    <div class="modal-body">
    <div class="post">
      @foreach($forum->comment()->where('parent',0)->latest()->get() as $item)
      <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{asset('style/dist/img/default-user.jpg')}}" alt="user image">
                  <span class="username">
                    <a href="#">{{ $item->user->name }}</a>
                  <form action="/comment/{{$item->id}}/delete" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="pull-right btn" type="submit"><i class="fa fa-times"></i></button>
                    </form>
                  </span>
              <span class="description">{{ $item->created_at->diffForhumans() }}</span>
        
              <p>{!! $item->content !!}</p>

              <form action="/comment/{{$forum->id}}/forum" class="form-horizontal" method="post">
                @csrf
                <input type="hidden" name="forum_id" value="{{ $forum->id }}"> 
                <input type="hidden" name="parent" value="{{  $item->id  }}">
                <div class="form-group margin-bottom-none">
                  <div class="col-sm-10">
                    <input class="form-control input-sm" name="content" placeholder="Type a comment">
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary pull-right btn-block btn-sm">Send</button>
                  </div>
                </div>
              </form>
              {{-- <input class="form-control input-sm" type="text" placeholder="Type a comment"> --}}
      </div>
      @foreach($item->childs as $child)
      <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{asset('style/dist/img/default-user.jpg')}}" alt="user image">
                  <span class="username">
                    <a href="#">{{ $child->user->name }}</a>
                    <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                    <form action="/comment/{{$child->id}}/deleteChild" class=" pull-right" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                      @csrf         
                      @method('delete')
                      <button class="pull-right btn" type="submit"><i class="fa fa-times"></i></button>
                  </form>
                  </span>
             <p> <span class="description">{{ $child->created_at->diffForhumans() }}</span></p>
        
              <p>{!! $child->content !!}</p>
      </div>
      @endforeach

      @endforeach
    </div>
    </div>

    </div>
  <!-- /.col -->

  </div>
 </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
      $('#btn-comment').click (function () {
          $('#comment').toggle('slide');
      });
  });
</script>

@endsection

@section('scripts')
<script>
  ClassicEditor
      .create( document.querySelector( '#comment-ckeditor' ) )
      .catch( error => {
          console.error( error );
      } );
</script>

@endsection
