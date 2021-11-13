@extends('layout.template')
@section('title','Edit Room')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Room</h3>
    </div>

        <form  class="form-horizontal" role="form" action="{{ url('room/'.$room->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="box-body">
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Room :</label>
            <div class="col-sm-8">
                <input class="form-control select2"  name="nameRoom" type="text" value="{{ $room->nameRoom}}" >
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Venue :</label>
            <div class="col-sm-8">
                <select class="form-control select2" name="nameVenue" value="{{ $room->venue->nameVenue }}" style="width: 100%;" >
                    @foreach($venue as $item)
                        <option value="{{ $item->id }}">{{ $item->nameVenue }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>

</div>
@endsection