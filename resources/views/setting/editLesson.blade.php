@extends('layout.template')
@section('title','Edit Lesson')

@section('content')



<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Lesson</h3>
    </div>

    <form action="/lesson" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="box-body">

            <div class="form-group">
                <label for="nameLesson">Name Lesson :</label>
                <input type="text" name="nameLesson" class="form-control" value="{{ $lesson->nameLesson }}" placeholder="Nama Lesson Training">
                @if ($errors->has('nameLesson'))
                <span class="help-block">
                <strong>{{ $errors->first('nameLesson') }}</strong>
                    </span>
                @endif
            </div>   

            <div class="form-group">
                <label class="control-label">Video :</label>
                <div class="controls">
                    <div id="uniform-undefined">
                        <input type="file" name="file" class="form-control">
                        
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <label>Category Training : </label>
                <select class="form-control select2" id="category_id" name="category_id" value="{{ $lesson->category->nameCategory }}" placeholder="categoryTraining" style="width: 100%;">
                <option value="{{ $lesson->category->nameCategory }}"> {{ $lesson->category->nameCategory }} </option>
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
                    <select class="form-control select2" id="subcategory_id" name="subcategory_id" value="{{ $lesson->subcategory->nameSubcategory }} placeholder="subcategoryTraining" style="width: 100%;">
                    <option value="{{ $lesson->subcategory->nameSubcategory }}"> {{ $lesson->subcategory->nameSubcategory }} </option>
                    <option value="">Name SubCategory</option>
                    @foreach($subcategory as $item)
                    <option value="{{ $item->id }}">{{ $item->nameSubcategory }}</option>
                    @endforeach
                </select>
                </div>
            </div>
                </div>
           

            <div class="form-group">
                <label for="url">Link Zoom :</label>
                <input type="text" name="url" class="form-control"value="{{ $lesson->url }}" placeholder="Link Zoom">
                
            </div> 

            <div class="form-group">
                <label>Description :</label>
                <input type = "textarea" class="form-control" name="description" rows="3" value="{{ $lesson-> description }}"placeholder="Description ...">
            </div>

            

        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         -->
         <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>
        </div>
      </div>
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
                    category_id: idCategory,
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
