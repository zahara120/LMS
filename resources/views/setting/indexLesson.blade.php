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
        <h3 class="box-title">Data Lesson Training</h3>
        <div class="pull-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#provider">
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
        <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name Lesson</th>
                <th>Link</th>
                <th>Video</th>
                <th>Description</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($lesson as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nameLesson }}</td>
                <td>{{ $item->url }}</td>
                <td>{{ $item->file }}</td>
                <td>{{ $item->description }}</td>
                <td class="text-center" width="200px">
                    <a href="{{url('/lesson/'.$item->id)}} " class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="{{url('/lesson/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="{{ url('lesson/'.$item->id) }}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                        @method('delete')
                        @csrf         
                        <button type="submit" class="btn btn-xs btn-danger" >
                            <i class="fa fa-trash"></i> Delete
                        </button> 
                    </form> 
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    </div>
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


<!-- Modal -->
<div class="modal fade" id="provider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Lesson</h4>
        </div>
        <div class="modal-body">
            <form action="/lesson" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nameLesson">Name Lesson :</label>
                <input type="text" name="nameLesson" class="form-control" placeholder="Nama Lesson Training">
                @if ($errors->has('nameLesson'))
                <span class="help-block">
                <strong>{{ $errors->first('nameLesson') }}</strong>
                    </span>
                @endif
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

            <div class="form-group">
                <label class="control-label">Video :</label>
                <div class="controls">
                    <div id="uniform-undefined">
                        <input type="file" name="file" class="form-control">
                        {{-- <span class="filename">No file selected</span> --}}
                        {{-- <span class="action">Choose File</span> --}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="url">Link Zoom :</label>
                <input type="text" name="url" class="form-control" placeholder="Link Zoom">
                {{-- @if ($errors->has('url'))
                <span class="help-block">
                <strong>{{ $errors->first('url') }}</strong>
                </span>
                @endif --}}
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