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
                    @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists() AND $quota >= 1)
                        <a href="{{route('training.user.index', $item->id)}}" class="btn btn-xs btn-primary" >
                            <i class="fa fa-eye"></i> User
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
</div>

@endsection