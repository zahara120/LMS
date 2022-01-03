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
        <h3 class="box-title">Data Category Training</h3>
        <div class="pull-right">
            
            {{-- search --}}

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">
                create
            </button>
            <a href="/exportCategoryTraining" type="button" class="btn btn-success btn-flat">
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
                <th>Name Category</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($category as $key=>$item)
            <tr>
                <td class="text-center">{{ $category->firstItem() + $key }}</td>
                <td>{{ $item->nameCategory }}</td>
                <td class="text-center" width="200px">
                
                    <a href="{{url('/categorytraining/'.$item->id)}}" class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="{{url('/categorytraining/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    
                    {{-- <a href="/daftar/destroy/{{$student->id_siswa}}" class="btn btn-xs btn-danger" onclick="return confirm('yakin?');">Delete</a> --}}

                    <form action="{{ url('categorytraining/'.$item->id) }}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                    @method('delete')
                    @csrf         
                    <button type="submit" class="btn btn-xs btn-danger" >
                        <i class="fa fa-trash"></i> Delete
                    </button> 
                    </form>

                    {{-- <a href="{{ url('categorytraining/'.$item->id) }}" class="btn btn-xs btn-danger"  onclick="return confirm('Are you sure want to delete this data?');">
                        <i class="fa fa-trash"></i> Delete
                    </a>  --}}
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    {{-- pagination --}}
    {{-- <div class="pull-right">
        {{ $category->links()}}
    </div>
    <div class="pull-left">
        Showing
        {{ $category->firstItem() }}
        to
        {{ $category->lastItem() }}
        of
        {{ $category->total() }}
    </div>
    </div> --}}
</div>

@endsection


<!-- Modal Create -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Category Training</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" style="display:none"></div>
            <form action="/categorytraining" method="post">
            @csrf
            <div class="form-group">
                <label for="nameCategory">Name Category Training :</label>
                <input id="nameCategory" type="text" class="form-control" name="nameCategory" value="{{ old('nameCategory') }}">
                <!-- @if ($errors->has('nameCategory'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nameCategory') }}</strong>
                    </span>
                @endif -->
                <!-- ini udah pake yang di database -->
                <!-- {{$errors}} -->
                <!-- @error('nameCategory')
                    <span class="help-block">
                        @foreach($alert as $item)
                            <strong>{{ $item->message }}</strong>
                        @endforeach
                    </span>
                @enderror -->
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="formSubmit">Add</button>
        </form>
        </div> 
      </div>
    </div>
  </div>

  @section('scripts')
  <script>
        $(document).ready(function(){
            $('#formSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/categorytraining') }}",
                    method: 'post',
                    data: {
                        nameCategory: $('#nameCategory').val()
                    },
                    success: function(result){
                        if(result.errors)
                        {
                            $('.alert-danger').html('');

                            $.each(result.errors, function(key, value){
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $('#myModal').modal('hide');
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
  @endsection

<!-- Modal Upload Import -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Import Category Training</h4>
        </div>
        <form action="{{route('category.import')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                Templates can be downloaded <a href="{{route('category.template')}}">here</a>
                <div class="form-group">
                    <label for="file">File :</label>
                    <input type="file" name="file" class="form-control" required="required">
                </div>   
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Import</button>
            {{-- {{ Form::close() }} --}}
            </div>
        </form>
      </div>
    </div>
  </div>
<!-- Modal Edit -->
{{-- <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Category Traning</h4>
        </div>
        <div class="modal-body">
            <form action="/categorytraining" method="post">
            @csrf
            <div class="form-group">
                <label for="nameCategory">Name Category :</label>
                <input type="text" name="nameCategory" class="form-control" id="nameCategory" placeholder="Nama Category Training">
                @if ($errors->has('nameCategory'))
                <span class="help-block">
                <strong>{{ $errors->first('nameCategory') }}</strong>
                    </span>
                @endif
            </div>   

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div> --}}