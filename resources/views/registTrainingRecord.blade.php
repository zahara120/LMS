@extends('layout.template')
@section('title','Regist Training Record')

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Regist Training Record</h3>
    </div>
    <div class="box-body table-responsive">
        <table  id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                 @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                <th>NIP</th>
                <th>Nama Peserta</th>
                @endif
                <th>Tittle Training</th>
                <th>Status</th>
                <th>Waktu Regist</th>
                 @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                <th >Action</th>
                @endif
            </tr> 
        </thead>
        <tbody>
            <?php $number = 0;?>
            @foreach ($regist as $item)
            @if(Auth::user()->id == $item->user_id || Auth::user()->role()->where('nameRole', '=', 'Admin')->exists())
            <tr>
                <!-- <td class="text-center">{{ $loop->iteration }}</td> -->
                 <?php $number++ ?>
                <td class="text-center">{{ $number }}</td>
                <td>{{ $item->user->nip }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->training->approval->titleTraining }}</td>
                <td>
                    @if ($item->status==0)
                    <label class="label label-warning">Pending</label>
                    @elseif ($item->status==1)
                    <label class="label label-success">Approve</label>
                    @elseif($item->status == 2) 
                    <label class="label label-danger">Reject</label>
                    @endif
                    </td>
                <td>{{ $item->created_at }}</td> 
                 @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists())
                <td class="text-center">
                    @if($item->status == 0)
                      <a href="/regist/{{$item->id}}" type="button" class="btn btn-warning status">Status</a>
                    @else
                      <a type="button" class="btn btn-warning status" disabled>Status</a>
                    @endif
                </td>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody> 
    </table>
    </div>
</div>

@endsection