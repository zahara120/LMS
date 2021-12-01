@extends('layout.template')
@section('title','Edit Answer')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Answer</h3>
    </div>

    <form class="form-horizontal" role="form" action="{{ url('/questionoption/'.$questionoption->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Answer :</label>
            <div class="col-sm-4">
                <input type="text" name="question" value="{{ $questionoption->option_text }}" class="form-control" id="question" placeholder="Question">
            </div>

        </div>

    </div>

        <div class="modal-footer">
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
  
        </form>

</div>

@endsection