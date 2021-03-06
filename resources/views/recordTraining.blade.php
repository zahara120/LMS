@extends('layout.template')
@section('title','Record Training')

{{-- @if(session('succes'))
    <div class="alert alert-success" role="alert">
    {{session('succes')}}
    </div>
@endif --}}

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Training</h3>
        <div class="pull-right">
        <a href="/create/training" class="btn btn-primary btn-flat">create</a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Title Training</th>
                <th>Mandatory Training</th>
                <th>Method Training</th>
                {{-- <th>Venue</th>
                <th>Room</th> --}}
                <th>Lesson</th>
                <th>Date</th>
                <th>Quota</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($training as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->approval->titleTraining }}</td>
                <td>{{ $item->mandatory }}</td>
                <td>{{ $item->mandatoryTraining }}</td>
                {{-- <td>{{ $item->venue->nameVenue }}</td>
                <td>{{ $item->room->nameRoom }}</td> --}}
                <td>{{ $item->lesson->nameLesson }}</td>
                <td>{{ $item->start_date }} s.d. {{ $item->end_date }}</td>
                <td>
                    {{ $item->approval->quota }} / 
                    <?php $quota = 0;?>
                    @foreach($registTrainings as $rt)
                        @if($rt->training_id == $item->id && $rt->regist->status == 1)
                            <?php $quota++;?>
                        @endif
                    @endforeach
                    {{$quota}}
                </td>
                <td class="text-center" width="200px">
                    <a href=" " class="btn btn-xs btn-warning" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="training/{{$item->id}}/{{$item->approval->id}}/edit" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>

                    @if(auth()->user()->role()->where('nameRole', '=', 'Admin')->exists() )
                    <a href="{{route('training.user.index', $item->id)}}" class="btn btn-xs btn-success" >
                        <i class="fa fa-eye"></i> User
                    </a>
                    @endif
                    
                    <form action="" class="inline" onclick="return confirm('Are you sure want to delete this data?')">
                        {{-- @method('delete')
                        @csrf          --}}
                        <button type="submit" class="btn btn-xs btn-danger" >
                            <i class="fa fa-trash"></i> Delete
                        </button> 
                    </form>
    
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
 
    </div>
</div>

@endsection

