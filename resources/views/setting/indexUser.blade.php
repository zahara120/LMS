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
        <h3 class="box-title">Data User Training</h3>
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
                <th>NIM</th>
                <th>Name User</th>
                <th>Role</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($user as $item)
            <tr>
                {{-- <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->role->nameRole}}</td> --}}
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->name }}</td>
                {{-- <td>{{ $item->role }}</td> --}}
                <td>
                    @foreach ($item->role as $role)
                    {{ $role->nameRole }}
                    @endforeach
                </td>
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
<div class="modal fade" id="provider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add User</h4>
        </div>
        <div class="modal-body">
            <form action="/user" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama">
                @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>   

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Role : </label>
                    <select class="form-control select2" name="nameRole" placeholder="Role" style="width: 100%;">
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->nameRole }}</option>
                        @endforeach
                    </select>
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
          <h4 class="modal-title" id="myModalLabel">Import Category Training</h4>
        </div>
        <div class="modal-body">
            <form action="#" method="post">
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