@extends('layout.template')
@section('title','Edit Venue')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Venue</h3>
    </div>

        <form  class="form-horizontal" role="form" action="{{ url('venue/'.$venue->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="box-body">
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Venue :</label>
            <div class="col-sm-8">
                <input class="form-control select2" name="nameVenue" type="text" value="{{ $venue->nameVenue}}" >
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