@extends('layout.template')
@section('title','FORUM')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Forum</h3>
        <div class="pull-right">
            
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">
                Add Forum
            </button>
            
        </div>
    </div>

    {{-- <div class="right">
        <a href="" class="btn btn-sm btn-primary">Add New Post
    </div> --}}
    @foreach($forum as $item)
    <div class="box-header with-border">
        <!-- Post -->
        <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="{{asset('style/dist/img/default-user.jpg')}}" alt="user image">
                  <span class="username">
                    <a href="{{url('/forum/'.$item->id)}}">{{ $item->titleForum }}</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
              <span class="description"><a href="#">{{  $item->user->name  }} </a> | <span class="timestamp">{{ $item->created_at->diffForHumans() }}</span>
            </div>
            
            <ul class="list-inline">
                <li class="pull-right">
                    {{-- <a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Reply</a> --}}
                </li>
            </ul>
          </div>
          <!-- /.post -->
    </div>



    @endforeach
    </div>

    {{-- <div class="card mb-2">
        <div class="card-body p-2 p-sm-3">
            <div class="media forum-item">
                <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                <div class="media-body">
                    <h6><a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body">Laravel 7 database backup</a></h6>
                    <p class="text-secondary">
                        lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
                    </p>
                    <p class="text-muted"><a href="javascript:void(0)">jlrdw</a> replied <span class="text-secondary font-weight-bold">3 hours ago</span></p>
                </div>
                <div class="text-muted small text-center align-self-center">
                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 18</span>
                    <span><i class="far fa-comment ml-2"></i> 1</span>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="card-body py-3">
        <div class="row no-gutters align-items-center">
            <div class="col"> <a href="javascript:void(0)" class="text-big" data-abc="true">How can i change the username?</a>
                <div class="text-muted small mt-1">Started 25 days ago &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">Neon Mandela</a></div>
            </div>
            <div class="d-none d-md-block col-4">
                <div class="row no-gutters align-items-center">
                    <div class="col-4">12</div>
                    <div class="media col-8 align-items-center"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg" alt="" class="d-block ui-w-30 rounded-circle">
                        <div class="media-body flex-truncate ml-2">
                            <div class="line-height-1 text-truncate">1 day ago</div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">by Tim cook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <ul class="list-unstyled activity-list">
        @foreach($forum as $item)
        <li>
            <img src="{{asset('style/dist/img/default-user.jpg')}}" alt="Avatar" class="img-circle pull left avatar">
            <p><a href="#">{{ $item->user->name }}</a>{{ $item->titleForum }} <span class="timestamp">{{ $item->creates_at->diffForHumans() }}</span></p>
        </li>
        <li>
            <img src="assets/img/user1.png" alt="Avatar" class="img-circle pull-left avatar">
            <p><a href="#">Michael</a> has achieved 80% of his completed tasks <span class="timestamp">20 minutes ago</span></p>
        </li>
        @endforeach
    </ul> --}}
    
    
</div>

@endsection

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Forum</h4>
        </div>
        <div class="modal-body">
            <form action="/forum" method="post">
            @csrf
            <div class="form-group">
                <label for="nameSubcategory">Title Forum :</label>
                <input type="text" name="titleForum" class="form-control" id="titleForum" placeholder="Judul Forum">
                @if ($errors->has('titleForum'))
                <span class="help-block">
                <strong>{{ $errors->first('titleForum') }}</strong>
                    </span>
                @endif
            </div>   

            <div class="form-group">
                <label>Content :</label>
                <textarea class="form-control" name="content" rows="3" placeholder="Content ..."></textarea>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>
      </div>
    </div>
  </div> 

