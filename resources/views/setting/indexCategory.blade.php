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
                    {{-- <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#editmodal">
                        <i class="fa fa-pencil"></i> Edit
                    </button> --}}
                    <a href="{{url('/categorytraining/'.$item->id)}}" class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    
                    {{-- <a href="/daftar/destroy/{{$student->id_siswa}}" class="btn btn-xs btn-danger" onclick="return confirm('yakin?');">Delete</a> --}}

                    <a href="categorytraining/{{$item->id}}" class="btn btn-xs btn-danger"  onclick="return confirm('yakin?');">
                        <i class="fa fa-trash"></i> Delete
                    </a> 
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
            {{-- {!! Form::open(array('url' => '/categorytraining','method' => 'POST')) !!} --}}
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
          {{-- {{ Form::close() }} --}}
        </form>
        </div>
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