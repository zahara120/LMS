@extends('layout.template')
@section('title','Edit Question')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Question</h3>
    </div>

    <form class="form-horizontal" role="form" action="{{ url('/question/'.$question->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Question :</label>
            <div class="col-sm-8">
                <input type="text" name="question" value="{{ $question->question }}" class="form-control" id="question" placeholder="Question">
            </div>
        </div>
    </div>

        <div class="modal-footer">
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
  
        </form>

</div>

@endsection