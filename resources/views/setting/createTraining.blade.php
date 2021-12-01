@extends('layout.template')
@section('title','Create Training')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Create Training</h3>
    </div>

    <form role="form" action="/training/{{$approval->id}}/approval" method="post">
        @csrf
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
                <select class="form-control select2" name="approval_id" placeholder="titleTraining" style="width: 100%;" disabled>
                    <option value="{{ $approval->titleTraining }}">{{ $approval->titleTraining }}</option>
                </select>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Mandatory for Employee :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" name="mandatory" value="yes"> Yes</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="radio" name="mandatory" value="no"> No</label>
                    </div>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Metode Training :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" onclick="javascript:onlineorofflineCheck();" name="mandatoryTraining" id="online" value="online"> Online</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="radio" onclick="javascript:onlineorofflineCheck();" name="mandatoryTraining" id="offline" value="offline"> Offline</label>
                    </div>
                </div>
            </div>


            <div id="ifoffline" style="display:none">
                {{-- Venue: <input type='text' id='venue' name='venue'><br> --}}
                <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Location :</label>
                <div class="col-lg-4">
                    <select class="form-control select2" id="venue_id" name="venue_id" placeholder="nameVenue" style="width: 100%;">
                        <option value="">Name Venue</option>
                        @foreach($venue as $item)
                        <option value="{{ $item->id }}">{{ $item->nameVenue }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2">
                    <select class="form-control select2" id="room_id" name="room_id" placeholder="nameRoom" style="width: 100%;">
                        {{-- <option value="">Room</option>
                        @foreach($room as $item)
                        <option value="{{ $item->id }}">{{ $item->nameRoom }}</option>
                        @endforeach --}}
                    </select>
                </div>
                </div>
            </div>

            <div class="form-group row mt-2">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Pendaftaran:</label>
                    <div class="col-lg-3">
                    <div class="input-group">
                    {{-- <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div> --}}
                    <input type="date" name="start_date" class="form-control pull-right" id="reservationtime">
                    </div>
                    </div>

                    <div class="col-lg-1">
                        <label>s.d.</label>
                    </div>

                    <div class="col-lg-4">
                    <div class="input-group">
                    {{-- <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div> --}}
                    <input type="date" name="end_date" class="form-control pull-right" id="reservationtime">
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

            <!-- /catatan -->
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Catatan : </label>
                <div class="col-sm-8">
                <textarea class="form-control" name="catatan" rows="3" placeholder="Catatan..."></textarea>
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Publish :</label>
                <div class="col-lg-2">
                    <div class="checkbox">
                        <label><input type="checkbox" name="publish" id="online" value="yes"> Yes</label>
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

</script>

{{-- jS TRAINING DETAIL --}}
{{-- onclick="getDetail({{$item->id}},{{$item->titleTraining}},$item->category_id}},{{$item->subcategory_id}},{{$stock->quota}},{{$stock->status}})" --}}
<script type="text/javascript">
    function getDetail(idApproval,titleTraining,category,subcategory,quota,status) {
        $.ajax({
                url: '/training/' + idApproval,
                type: "GET",
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                        document.getElementById('idApproval').disabled = true;
                        document.getElementById('titleTraining').disabled = true;
                        document.getElementById('category').disabled = true;
                        document.getElementById('subcategory').disabled = true;

                        document.getElementById('idApproval').value = idApproval;
                        document.getElementById('titleTraining').value = titleTraining;
                        document.getElementById('category').value = category;
                        document.getElementById('subcategory').value = subcategory;
                        document.getElementById('qouta').value=qouta;
                }
            });
    }
</script>

{{-- <script type="text/javascript">
$('#country').change(function(){
        var idVenue = this.val();
            if(idVenue) {
            $.ajax({
                url: "{{url('training')}}"?venue_id="+idVenue,
                type: "GET",
                success: function (data) {
                    if(data){
                        $('#room').empty();
                        $('#room').append('<option>Choose Room</option>');
                        $.each(data, function (key, value) {
                            $('#room').append('<option value="'+ key +'">' + value + '</option>');
                        });
                        }else{
                            $('#room').empty();
                        }
                     }
                   });
               }else{
                 $('#room').empty();
               }
            });
            });
</script> --}}
    

{{-- <script type="text/javascript">
        $(document).ready(function () {
        $('#venue').on('change', function () {
            //$('#country').change(function(){
            var idVenue = this.val();
            if(idVenue) {
            $.ajax({
                url: "{{url('training')}}",
                type: "GET",
                //dataType: 'json',
                success: function (data) {
                    if(data){
                        $('#room').empty();
                        $('#room').append('<option>Choose Room</option>');
                        $.each(data, function (key, value) {
                            $('select[name="room"]').append('<option value="'+ key +'">' + value.id + '</option>');
                        });
                        }else{
                            $('#room').empty();
                        }
                     }
                   });
               }else{
                 $('#room').empty();
               }
            });
            });
</script> --}}

<script type="text/javascript">
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

{{-- <div class="form-group">
    <div class="radio">
      <label>
        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
        Option one is this and that&mdash;be sure to include why it's great
      </label>
    </div>
</div>

<div class="mb-2">
    <label for="category_id" class="block">Category ID</label>
    <select wire:model="category_id" name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-blue-900">
        <option>Select Option</option>
    </select>
</div>


<div class="mb-2">
    <label for="sub_category_id" class="block">Sub-Category ID</label>
    <select wire:model="sub_category_id" name="sub_category_id" id="sub_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-blue-900">
        <option>Select Option</option>
    </select>
</div> --}}

@endsection