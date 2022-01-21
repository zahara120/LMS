@extends('layout.template')
@section('title','Create Training')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Create Training</h3>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
        <form role="form" action="/training" method="post">
        @csrf
        <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="titleTraining">Title Training :</label>
                    <input type="text" name="titleTraining" class="form-control" id="titleTraining" placeholder="Judul Training">
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <label>Category Training : </label>
                <select class="form-control select2" id="category_id" name="category_trainings_id" placeholder="categoryTraining" style="width: 100%;">
                    <option value="">Name Category</option>
                    @foreach($category as $item)
                    <option value="{{ $item->id }}">{{ $item->nameCategory }}</option>
                    @endforeach
                </select>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Subcategory Training :</label>
                    <select class="form-control select2" id="subcategory_id" name="subcategory_trainings_id" placeholder="subcategoryTraining" style="width: 100%;">
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="quota">Jumlah Peserta :</label>
                    <input type="number" class="form-control" name="quota" placeholder="Jumlah Peserta">
                </div>
            </div> 
        </div>

        <div class="form-group">
            <label for="objectiveTraining">Objective Training :</label>
            <input type="text" name="objectiveTraining" class="form-control" id="objectiveTraining" placeholder="Target Training">
        </div>  

        <div class="form-group">
            <label for="backgroundTraining">Background Training :</label>
            <input type="text" name="backgroundTraining" class="form-control" id="backgroundTraining" placeholder="Tujuan Training">
        </div>  

        {{-- <div class="box-header with-border">
            <h3 class="box-title">Detail Training</h3>
        </div> --}}
        <!-- /file -->
        {{-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
        </div> --}}

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

            <div id="ifonline" style="display:none">
                <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Link :</label>
                <div class="col-sm-8">
                    <input class="form-control select2" type="text" name="url">
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

            <div class="form-group row mt-2" id="budget">
                <label class="col-sm-3 control-label">Budget : </label>
                {{--<div class="col-sm-4">
                    <select class="form-control select2" id="costtype_id" name="costtype_id[]" placeholder="Cost Type" style="width: 100%;">
                        <option value="">Cost Type</option>
                        @foreach($costtype as $item)
                        <option value="{{ $item->id }}">{{ $item->costType }}</option>
                        @endforeach
                    </select>
                </div>--}}

                <div class="col-sm-3">
                    <input type="number" class="form-control" name="budget[]" placeholder="Budget">
                </div>
    
                <div class="col-lg-1">
                    <a href="#" class="btn btn-primary addbudget" id="addbudget" style="float:right"><i class="fa fa-plus"></i></a>
                </div>
            </div>

            <div class="budget"></div>

            {{-- <div class="form-group row mt-2">
                <label class="col-sm-2 control-label">Question : </label>
                <div class="col-sm-8">
                <input type="text" class="form-control" name="question[]" placeholder="Pertanyaan">
                </div>

                <div class="col-lg-2">
                    <a href="#" class="btn btn-primary addquestion" style="float:right">Add Question</a>
                </div>
            </div>

            <div class="question"></div> --}}

            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Training provider :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" onclick="javascript:providerCheck();" name="providerTraining" id="external" value="external"> External</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                      <label><input type="radio" onclick="javascript:providerCheck();" name="providerTraining" id="internal" value="internal"> Internal</label>
                    </div>
                </div>
            </div>

            <div id="ifexternal" style="display:none">
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Name Provider :</label>
                <div class="col-lg-6">
                <select class="form-control select2" name="provider_id" placeholder="ProviderTraining" style="width: 100%;">
                    @foreach($providerexternal_id as $item)
                    <option value="{{ $item->id }}">{{ $item->nameProvider }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            </div>

            <div id="ifinternal" style="display:none">
                <div class="form-group row mt-2">
                    <label class="col-sm-3 control-label">Name Provider :</label>
                    <div class="col-lg-6">
                    <select class="form-control select2" name="provider_id" placeholder="ProviderTraining" style="width: 100%;">
                        @foreach($providerinternal_id as $item)
                        <option value="{{ $item->id }}">{{ $item->nameProvider }}</option>
                        @endforeach
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

                    <div class="col-lg-2">
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

            <div class="form-group row mt-2">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Post Test :</label>
                    <div class="col-lg-3">
                        <select class="form-control select2" name="posttest_id" placeholder="LessonTraining" style="width: 100%;">
                            @foreach($posttest_id as $item)
                            <option value="{{ $item->id }}">{{ $item->nameTest }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label>Pre Test :</label>
                    </div>

                    <div class="col-lg-3">
                        <select class="form-control select2" name="pretest_id" placeholder="LessonTraining" style="width: 100%;">
                            @foreach($pretest_id as $item)
                            <option value="{{ $item->id }}">{{ $item->nameTest }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <div class="form-group row mt-2">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Evaluasi I (Materi) :</label>
                    {{--<div class="col-lg-3">
                        <select class="form-control select2" name="surveysatu_id" placeholder="Budget" style="width: 100%;">
                            @foreach($survey as $item)
                            <option value="{{ $item->id }}">{{ $item->nameSurvey }}</option>
                            @endforeach
                        </select>
                    </div>--}}

                    <div class="col-lg-2">
                        <label>Evaluasi II (Trainer) :</label>
                    </div>

                    {{--<div class="col-lg-3">
                        <select class="form-control select2" name="surveydua_id" placeholder="Budget" style="width: 100%;">
                        @foreach($survey as $item)
                        <option value="{{ $item->id }}">{{ $item->nameSurvey }}</option>
                        @endforeach
                        </select>--}}
                    </div>

                </div>
            </div>

            <?php $n = 1; ?>
            
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">SESSION :</label>
            </div>

            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Sesi</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Trainer</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td class="text-center">{{ $n }}</td>
                    <td><input type="datetime-local" name="starttime[0]" placeholder="Enter Start Time" class="form-control" />
                    </td>
                    <td><input type="datetime-local" name="endtime[0]" placeholder="Enter Start Time" class="form-control" />
                    </td>
                    <td><input type="text" name="trainer[0]" placeholder="Trainine" id="trainer" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary"><i class="fa fa-plus"></i></button></td>
                </tr>
            </table>

            <!-- /catatan -->
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Catatan : </label>
                <div class="col-sm-8">
                <textarea class="form-control" name="description" rows="3" placeholder="Catatan..."></textarea>
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
    <a href="{{ url()->previous() }}" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id').on('change', function () {
            var idCategory = this.value;
            $("#subcategory_id").html('');
            $.ajax({
                url: "{{url('api/fetch-subcategory')}}",
                type: "POST",
                data: {
                    category_trainings_id: idCategory,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#subcategory_id').html('<option value="">Select Subcategory</option>');
                    $.each(result.subcategory_trainings, function (key, value) {
                        $("#subcategory_id").append('<option value="' + value.id + '">' + value.nameSubcategory + '</option>');
                    });
                }
            });
        });
    });
</script>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">

    function onlineorofflineCheck() {
        if (document.getElementById('offline').checked) {
            document.getElementById('ifoffline').style.display = 'block';
            document.getElementById('ifonline').style.display = 'none';
        }
        else if(document.getElementById('online').checked) {
            document.getElementById('ifonline').style.display = 'block';
            document.getElementById('ifoffline').style.display = 'none';
        }
        
    }

    function providerCheck() {
        if (document.getElementById('external').checked) {
            document.getElementById('ifexternal').style.display = 'block';
            document.getElementById('ifinternal').style.display = 'none';
        }
        else if(document.getElementById('internal').checked) {
            document.getElementById('ifinternal').style.display = 'block';
            document.getElementById('ifexternal').style.display = 'none';
        }
        
    }

</script>

@endsection