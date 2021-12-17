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
        <h3 class="box-title">Data Survey</h3>
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
        <table id="table"  class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name Survey</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($survey as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nameSurvey }}</td>
                <td class="text-center">
                    {{-- <a href=" " class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a> --}}
                    {{-- <a href="" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> Delete
                    </a>  --}}
                    <form action="{{ url('survey/'.$item->id) }}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                        @method('delete')
                        @csrf         
                        <button type="submit" class="btn btn-xs btn-danger" >
                            <i class="fa fa-trash"></i> Delete
                        </button> 
                    </form>
                    <a class="btn btn-xs btn-primary" type ="button" href="/questionnaire/{{ $item->id }}/survey/create"> 
                        <i class="fa fa-pencil"></i> + Questionnaires
                    </a>
                    <a class="btn btn-xs btn-info" type ="button" href="/questionoption/{{$item->id}}/survey/create"> 
                        <i class="fa fa-pencil"></i> + Answer
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
          <h4 class="modal-title" id="myModalLabel">Add Survey</h4>
        </div>
        <div class="modal-body">
            <form action="/survey" method="post">
            @csrf
            <div class="form-group {{$errors->has('nameSurvey') ? ' has-error' : ' '}}">
                <label for="nameTest">Name Survey :</label>
                <input type="text" name="nameSurvey" class="form-control" id="nameSurvey" placeholder="Nama Survey">
                @if ($errors->has('nameSurvey'))
                <span class="help-block">
                <strong>{{ $errors->first('nameSurvey') }}</strong>
                    </span>
                @endif
            </div>   

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