@extends('layout.template')
@section('title','Edit Questionnaire')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Questionnaire</h3>
    </div>

    <form class="form-horizontal" role="form" action="{{ url('/questionnaire/'.$questionnaire->id.'/'.$survey_id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="box-body">
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Question :</label>
            <div class="col-sm-8">
                <input type="text" name="question" value="{{ $questionnaire->question }}" class="form-control" id="question" placeholder="Question">
            </div>
        </div>
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Type Answer :</label>
            <div class="col-lg-4">
                <div class="checkbox">
                    <label><input type="radio" name="typeAnswer" id="essay" value="essay" {{$questionnaire->typeAnswer == 'essay' ?  'checked' : ''}}> Essay</label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="checkbox">
                  <label><input type="radio" name="typeAnswer" id="multiplechoice" value="multiplechoice" {{$questionnaire->typeAnswer == 'multiplechoice' ?  'checked' : ''}}> Multiple Choice</label>
                </div>
            </div>
        </div>
    </div>

        <div class="modal-footer">
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
  
        </form>

</div>

@endsection