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
        <h3 class="box-title">Data Provider Training</h3>
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
                <th>Name Provider</th>
                <th>Type Provider</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($provider as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nameProvider }}</td>
                <td>{{ $item->typeProvider }}</td>
                <td class="text-center" width="200px">
                    <a href=" " class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="{{url('/provider/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="{{ url('provider/'.$item->id) }}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
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

@endsection


<!-- Modal -->
<div class="modal fade" id="provider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Provider</h4>
        </div>
        <div class="modal-body">
            <form action="/provider" method="post">
            @csrf
            <div class="form-group {{$errors->has('nameProvider') ? ' has-error' : ' '}}">
                <label for="nameProvider">Name Provider :</label>
                <input type="text" name="nameProvider" value="{{ old('nameProvider') }}" class="form-control" id="nameProvider" placeholder="Nama Provider Training">
                @if ($errors->has('nameProvider'))
                <span class="help-block">
                    <strong>{{ $errors->first('nameProvider') }}</strong>
                </span>
                @endif
            </div>   

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{$errors->has('typeProvider') ? ' has-error' : ' '}}">
                    <label>Type Provider : </label>
                    <select class="form-control select2" name="typeProvider" placeholder="Type Provider" style="width: 100%;">
                        {{-- <option selected="">Name Category</option> --}}
                        <option value="External"{{old('typeProvider') == 'External' ? ' selected' : ' '}}>External</option>
                        <option value="Internal"{{old('typeProvider') == 'Internal' ? ' selected' : ' '}}>Internal</option>
                    </select>
                    @if ($errors->has('typeProvider'))
                        <span class="help-block"><strong>{{ $errors->first('typeProvider') }}</strong></span>
                    @endif
                    </div>
                </div>
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
          <h4 class="modal-title" id="myModalLabel">Import Provider</h4>
        </div>
        <form action="{{route('provider.import')}}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              @csrf
              Templates can be downloaded <a href="{{route('provider.template')}}">here</a>
              <div class="form-group">
                  <label for="file">File :</label>
                  <input type="file" name="file" class="form-control" required="required">
              </div>   
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
        </form>
      </div>
    </div>
  </div>