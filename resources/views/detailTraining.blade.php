@extends('layout.template')
@section('title','Detail Training')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Detail Training</h3>
    </div>
    <div class=" form-horizontal box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label" for="nameLesson">Title Training :</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="{{ $training->approval->titleTraining }}" placeholder="Nama Lesson Training" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label" for="nameLesson">Method Training :</label>
            <div class="col-sm-8">
                <input type="text"  class="form-control" value="{{ $training->mandatoryTraining }}" placeholder="Nama Lesson Training" disabled>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label" for="nameLesson">Mandatory Training :</label>
            <div class="col-sm-8">
                <input type="text"  class="form-control" value="{{ $training->mandatory }}" placeholder="Nama Lesson Training" disabled>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
        <form action="/regist/{{ $training->id }}/store" method="post">
            @csrf
            <button class="btn btn-success" type="submit">Registration</button>
        </form>
    </div>
</div>
@endsection