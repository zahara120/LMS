@extends('layout.template')
@section('title','HOME PAGE')

@section('content')
@if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-teal"><i class="fa fa-mortar-board"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah Training</span>
            <span class="info-box-number">{{ $total_training }} <small>Course</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah User</span>
            <span class="info-box-number">{{ $total_user }} <small>Person</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-maroon"><i class="fa fa-rocket"></i></span>
  
          <div class="info-box-content">
              <span class="info-box-text">Jumlah User</span>
              <span class="info-box-number">{{ $total_user }} <small>Person</small></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-plane"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah Training</span>
            <span class="info-box-number">{{ $total_training }} <small>Course</small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>
@endif

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Home Page</h3>
    </div>
    @if($password == true)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Change Password!</h4>
            Your password is still the default, please change the password 
            <a type="button" data-toggle="modal" data-target="#modal-default">here</a>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
    <div class="box-body table-responsive">
        <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Status Training</th>
                <th>Title Training</th>
                <th>Mandatory Training</th>
                <th>Method Training</th>
                {{-- <th>Venue</th>
                <th>Room</th> --}}
                <th>Registration Date</th>
                <th>Quota</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($training as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                @if($item->end_date < $date)
                <td><label class="label label-danger">PENDAFTARAN TUTUP</label></td>
                @else
                <td><label class="label label-success">PENDAFTARAN AKTIF</label></td>
                @endif
                <td>{{ $item->approval->titleTraining }}</td>
                <td>{{ $item->mandatory }}</td>
                <td>{{ $item->mandatoryTraining }}</td>
                {{-- <td>{{ $item->venue->nameVenue }}</td>
                <td>{{ $item->room->nameRoom }}</td> --}}
                <td>{{ $item->start_date }} s.d {{ $item->end_date }}</td>
                <td>
                    {{ $item->approval->quota }} / 
                    <?php $quota = 0;?>
                    @foreach($registTrainings as $rt)
                        @if($rt->training_id == $item->id AND $rt->regist->status == 1)
                            <?php $quota++;?>
                        @endif
                    @endforeach
                    {{$quota}}
                </td>
                <td class="text-center">
                    <a href="{{route('regist.create', $item->id)}}" class="btn btn-xs btn-success" >
                        <i class="fa fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
</div>

@endsection