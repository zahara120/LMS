@extends('layout.template')
@section('title','Setting')

{{-- @if(session('succes'))
    <div class="alert alert-success" role="alert">
    {{session('succes')}}
    </div>
@endif --}}

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Test</h3>
        <div class="pull-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">
                create
            </button>
            <a href="" type="button" class="btn btn-success btn-flat">
                Export
            </a>
            <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#upload">
                Import
            </button>
            {{-- <a href="/categorytraining/create" class="btn btn-primary btn-flat">
                create
            </a> --}}
        </div>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name Test</th>
                <th>Type Test</th>
                <th>Duration</th>
                <th>Description</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($test as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nameTest }}</td>
                <td>{{ $item->typeTest }}</td>
                <td>{{ $item->timeTest }}</td>
                <td>{{ $item->description }}</td>
                <td class="text-center" width="200px">
                    <a href=" " class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <a href="" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> Delete
                    </a> 
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    </div>
</div>

@endsection


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Subcategory Training</h4>
        </div>
        <div class="modal-body">
            <form action="/exam" method="post">
            @csrf
            <div class="form-group">
                <label for="nameTest">Name test :</label>
                <input type="text" name="nameTest" class="form-control" id="nameTest" placeholder="Nama Test">
                @if ($errors->has('nameTest'))
                <span class="help-block">
                <strong>{{ $errors->first('nameTest') }}</strong>
                    </span>
                @endif
            </div>   

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Type Test : </label>
                    <select class="form-control select2" name="typeTest" placeholder="Type Test" style="width: 100%;">
                        {{-- <option selected="">Name Category</option> --}}
                        <option value="PreTest">Pre-Test</option>
                        <option value="PostTest">Post-Test</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Category Training : </label>
                    <select class="form-control select2" id="category_id" name="category_id" placeholder="categoryTraining" style="width: 100%;">
                        <option value="">Name Category</option>
                        @foreach($category as $item)
                        <option value="{{ $item->id }}">{{ $item->nameCategory }}</option>
                        @endforeach
                    </select>
                    {{-- <div class="col-lg-2">
                        <select class="form-control select2" id="subcategory" name="subcategory" placeholder="subcategoryTraining" style="width: 100%;">
                        </select>
                    </div> --}}
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Subcategory Training :</label>
                        <select class="form-control select2" id="subcategory_id" name="subcategory_id" placeholder="subcategoryTraining" style="width: 100%;">
                        </select>
                    </div>
                </div>
                    
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Lesson : </label>
                    <select class="form-control select2" id="lesson_id" name="lesson_id" placeholder="subcategoryTraining" style="width: 100%;">
                    </select>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-6">
            <!-- time Picker -->
            <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Time picker:</label>

                  <div class="input-group">
                    <input type="time" name="timeTest" class="form-control timepicker">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            </div>
            </div>

            <div class="form-group">
                <label>Description :</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Description ..."></textarea>
            </div>

            {{-- <div class="form-group">
                <label for="description">Description :</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                @if ($errors->has('description'))
                <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>    --}}

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            $('#category_id').on('change', function() {
            var idCategory = this.value;
            $("#subcategory_id").html('');
            $.ajax({
            url:"{{url('api/fetch-subcategory')}}",
            type: "POST",
            data: {
            category_id: idCategory,
            _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result){
            $('#subcategory_id').html('<option value="">Select Subcategory</option>'); 
            $.each(result.subcategory_trainings,function(key,value){
            $("#subcategory_id").append('<option value="'+value.id+'">'+value.nameSubcategory+'</option>');
            });
            $('#lesson_id').html('<option value="">Select Lesson</option>'); 
            }
            });
            });    
            $('#subcategory_id').on('change', function() {
            var idSubcategory = this.value;
            $("#lesson_id").html('');
            $.ajax({
            url:"{{url('api/fetch-lesson')}}",
            type: "POST",
            data: {
            subcategory_id: idSubcategory,
            _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result){
            $('#lesson_id').html('<option value="">Select Lesson</option>'); 
            $.each(result.lessons,function(key,value){
            $("#lesson_id").append('<option value="'+value.id+'">'+value.nameLesson+'</option>');
            });
            }
            });
            });
            });
        </script>
            

      </div>
    </div>
  </div> 

  <!-- Modal Upload Import -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Import Category Training</h4>
        </div>
        <div class="modal-body">
            <form action=" " method="post">
            @csrf
            <div class="form-group">
                <label for="nameCategory">File :</label>
                <input type="file" name="importCategory" class="form-control" id="importCategory">
            </div>   

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </form>
        </div>
      </div>
    </div>
  </div>