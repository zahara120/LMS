@extends('layout.template')
@section('title','Edit Trainer')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Trainer</h3>
    </div>

    <form class="form-horizontal" action="{{route('trainers.edit', $trainer->id)}}" method="post">
        @method('PUT')
        @csrf
        <div class="box-body">
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Lesson : </label>
                <div class="col-sm-8">
                    <select class="form-control select2" name="lesson_id" placeholder="Lesson" style="width: 100%;">
                        <option value="{{ $trainer->lesson->id }}">{{ $trainer->lesson->name }}</option>
                        @foreach($lessons as $item)
                        <option value="{{ $item->id }}">{{ $item->nameLesson }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('lesson_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lesson_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {{--<div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Trainer Name :</label>
                <div class="col-sm-8">
                    <input type="text" name="trainer_id" value="{{ $trainer->user->name }}" class="form-control" id="trainer_id" placeholder="Trainer Name">
                </div>
            </div>--}}
        </div>

        <div class="modal-footer">
            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>   
    </form>
</div>

@endsection