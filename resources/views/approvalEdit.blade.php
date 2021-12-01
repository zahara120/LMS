@extends('layout.template')
@section('title','Edit Training Submission')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Training Submission</h3>
    </div>

    <form role="form" action="/approval/{{$approval->id}}/update" method="post">
        @csrf
        @method('PUT')
        <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="titleTraining">Title Training :</label>
                    <input type="text" name="titleTraining" class="form-control" id="titleTraining" placeholder="Judul Training" value="{{$approval->titleTraining}}">
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
                    <input type="number" class="form-control" name="quota" placeholder="Jumlah Peserta" value="{{$approval->quota}}">
                </div>
            </div> 
        </div>

        <div class="form-group">
            <label for="objectiveTraining">Objective Training :</label>
            <input type="text" name="objectiveTraining" class="form-control" id="objectiveTraining" placeholder="Target Training" value="{{$approval->objectiveTraining}}">
        </div>  

        <div class="form-group">
            <label for="backgroundTraining">Background Training :</label>
            <input type="text" name="backgroundTraining" class="form-control" id="backgroundTraining" placeholder="Tujuan Training" value="{{$approval->backgroundTraining}}">
        </div>  
        
        <!-- /catatan -->
        <div class="form-group">
            <label>Catatan : </label>
        <textarea class="form-control" name="description" rows="3" placeholder="Catatan...">{{$approval->description}}</textarea>
        </div>

        <!-- /file -->
        {{-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
        </div> --}}

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

@endsection