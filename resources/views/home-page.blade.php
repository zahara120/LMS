@extends('layout.template')
@section('title','HOME PAGE')

@section('content')
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
                <td>SEDANG BEJALAN  SEDANG BERLANGSUNG</td>
                <td>{{ $item->approval->titleTraining }}</td>
                <td>{{ $item->mandatory }}</td>
                <td>{{ $item->mandatoryTraining }}</td>
                {{-- <td>{{ $item->venue->nameVenue }}</td>
                <td>{{ $item->room->nameRoom }}</td> --}}
                <td>{{ $item->start_date }} s.d {{ $item->end_date }}</td>
                <td>{{ $item->approval->quota }} / 0</td>
                <td class="text-center">
                    {{-- <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#editmodal">
                        <i class="fa fa-pencil"></i> Edit
                    </button> --}}
                    <a href="{{url('training/'.$item->id)}}" class="btn btn-xs btn-success" >
                        <i class="fa fa-eye"></i> Detail
                    </a>
    
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
</div>

@endsection