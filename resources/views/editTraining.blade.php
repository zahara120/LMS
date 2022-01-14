@extends('layout.template')
@section('title','Edit Training')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Edit Training</h3>
    </div>

    <form action="/training/{{$training->id}}/{{$training->approval->id}}/update" method="post">
        @csrf
        @method('PUT')
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Title Training :</label>
                <div class="col-sm-8">
                    <input type="text" name="titleTraining" class="form-control" value="{{$training->approval->titleTraining}}" placeholder="Judul Training">
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Mandatory for Employee :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <input type="hidden" value="{{$training->mandatory}}" id="mandatory">
                        <label><input type="radio" name="mandatory" id="yes" value="yes"> Yes</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="radio" name="mandatory" id="no" value="no"> No</label>
                    </div>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Metode Training :</label>
                <input type="hidden" value="{{$training->mandatoryTraining}}" id="mandatoryTraining">
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" onclick="onlineorofflineCheck();" name="mandatoryTraining" id="online" value="online"> Online</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="radio" onclick="onlineorofflineCheck();" name="mandatoryTraining" id="offline" value="offline"> Offline</label>
                    </div>
                </div>
            </div>

            <div class="form-group row mt-2" id="ifoffline" style="{{$training->mandatoryTraining == "offline" ? 'display:block' : 'display:none'}}">
                <label class="col-sm-3 control-label">Location :</label>
                <div class="col-lg-4">
                    <select class="form-control select2" id="venue_id" name="venue_id" placeholder="nameVenue" style="width: 100%;">
                        <option value="">Name Venue</option>
                        @foreach($venue as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $training->venue->id ? 'selected' : '' }}>{{ $item->nameVenue }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2">
                    <select class="form-control select2" id="room_id" name="room_id" placeholder="nameRoom" style="width: 100%;">
                        <option value="">Room</option>
                        @foreach($room as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $training->room->id ? 'selected' : '' }}>{{ $item->nameRoom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mt-2">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Pendaftaran:</label>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control pull-right" value="{{$training->start_date}}">
                        </div>
                    </div>

                    <div class="col-lg-1">
                        <label>s.d.</label>
                    </div>

                    <div class="col-lg-4">
                        <div class="input-group">
                            <input type="date" name="end_date" class="form-control pull-right" value="{{$training->end_date}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Lesson Training :</label>
                <div class="col-sm-8">
                    <select class="form-control select2" name="lesson_id" placeholder="LessonTraining" style="width: 100%;">
                        @foreach($lesson as $item)
                            <option value="{{ $item->id }}">{{ $item->nameLesson }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mt-2">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Post Test :</label>
                    <div class="col-lg-3">
                        <select class="form-control select2" name="posttest_id" style="width: 100%;">
                            @foreach($posttest_id as $item)
                                <option value="{{ $item->id }}">{{ $item->nameTest }}</option>
                            @endforeach 
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label>Pre Test :</label>
                    </div>

                    <div class="col-lg-3">
                        <select class="form-control select2" name="pretest_id" style="width: 100%;">
                            @foreach($pretest_id as $item)
                                <option value="{{ $item->id }}">{{ $item->nameTest }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <!-- /catatan -->
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Catatan : </label>
                <div class="col-sm-8">
                <textarea class="form-control" name="catatan" rows="3" placeholder="Catatan...">{{$training->catatan}}</textarea>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Publish :</label>
                <div class="col-lg-2">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="publish" id="online" value="{{ $training->publish }}" {{($training->publish == 'yes') ? 'checked="checked"' : ''}}> Yes</label>
                    </div>
                </div>
            </div>
        </div>
    <div class="box-footer">
    <a href="{{route('approval.index')}}" type="button" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">

    function onlineorofflineCheck() {
        if (document.getElementById('offline').checked) {
            document.getElementById('ifoffline').style.display = 'block';
        }
        else document.getElementById('ifoffline').style.display = 'none';
    }

    var value = $('#mandatory').val()
    if(value === 'yes'){
        $("#yes").attr('checked', 'checked');
    }
    else{
        $("#no").attr('checked', 'checked');
    }

    var value = $('#mandatoryTraining').val()
    if(value === 'online'){
        $("#online").attr('checked', 'checked');
    }
    else{
        $("#offline").attr('checked', 'checked');
    }

    $(document).ready(function () {
        $('#venue_id').on('change', function () {
            var idVenue = this.value;
            $("#room_id").html('');
            $.ajax({
                url: "{{url('api/fetch-room')}}",
                type: "POST",
                data: {
                    venue_id: idVenue,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#room_id').html('<option value="">Select Room</option>');
                    $.each(result.rooms, function (key, value) {
                        $("#room_id").append('<option value="' + value.id + '">' + value.nameRoom + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection