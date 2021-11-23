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

                <th>NIP</th>
                <th>Nama Peserta</th>

                <th>Tittle Training</th>
                <th>Status</th>
                <th>Waktu Regist</th>

                <th >Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($regist as $item)
            <tr>

                <td class="text-center">{{ $loop->iteration }}</td>
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
                
                <td class="text-center">
                    @if($item->status == 0)
                      <a href="/regist/{{$item->training->id}}/{{$item->id}}" type="button" class="btn btn-warning status">Status</a>
                    @else
                      <a type="button" class="btn btn-warning status" disabled>Status</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    </div>
</div>

@endsection