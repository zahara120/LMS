@extends('layout.template')
@section('title','Registration Detail')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Registration Detail</h3>
    </div>

    <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Title Training :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="approval_id" placeholder="titleTraining" style="width: 100%;" disabled>
                <option>{{$training->approval->titleTraining}}</option>
            </select>
            </div>
        </div>
        @if($training->venue_id)
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Venue :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->venue->nameVenue}}" disabled>
            </div>
        </div>
        @endif

        @if($training->room_id)
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Room :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->room->nameRoom}}" disabled>
            </div>
        </div>
        @endif

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Lesson :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->lesson->nameLesson}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Mandatory :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->mandatory}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Mandatory Training :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->mandatoryTraining}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Catatan :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->catatan}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Publish :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->publish}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Start Date :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->start_date}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">End Date :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$training->end_date}}" disabled>
            </div>
        </div>
        <form action="/regist/{{$regist}}" method="post">
        @csrf
        @method('PUT')
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Decision :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" name="status" id="approve" onclick="javascript:statusCheck();" value="1">Terima</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                        <label><input type="radio" name="status" id="reject" onclick="javascript:statusCheck();" value="2">Tolak</label>
                    </div>
                </div>
            </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">

    function statusCheck() {
        if (document.getElementById('reject').checked) {
            document.getElementById('ifreject').style.display = 'block';
        }
        else document.getElementById('ifreject').style.display = 'none';
    
    }

</script>

@endsection