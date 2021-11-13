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
    <form action = "" style="display:none" id="comment" method="post">
       @csrf
      <input type="hiden" name="forum_id" value="{{ $forum->id }}"> 
      <input type="hiden" name="parent" value="0">
      <div class="form-group">
      <textarea class="form-control" name="comment" rows="3" placeholder="Type a comment ..."></textarea>
      <input type="submit" class="btn btn-primary" value="submit">
    </div>
    </form>
    </div>
    {{-- </div> --}}

    {{-- <input style="display:none" id="comment" class="form-control input-sm" type="text" placeholder="Type a comment"> --}}


    <p><h4>Komentar</h4></p>

    <div class="modal-body">
    <div class="post">
      <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{asset('style/dist/img/default-user.jpg')}}" alt="user image">
                  <span class="username">
                    <a href="#">snkndksdnknk</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
              <span class="description"><a href="#">dkjsnkdnskndk</a> | <span class="timestamp">snksdkdksn</span>
      </div>
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
