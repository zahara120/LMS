@extends('layout.template')
@section('title','Setting')

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Approver</h3>
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
        <table id="table"  class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Approver 1</th>
                <th>Approver 2</th>
                <th>Approver 3</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($approver as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->approversatu->name}}</td>
                <td>{{ $item->approverdua->name }}</td>
                <td>{{ $item->approvertiga->name }}</td>
                <td class="text-center" width="200px">
                    <a href=" " class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="{{url('/approver/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="{{ url('approver/'.$item->id) }}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
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
          <h4 class="modal-title" id="myModalLabel">Add User</h4>
        </div>
        <div class="modal-body">
            <form action="/approver" method="post">
            @csrf
            <div class="form-group {{$errors->has('user_id') ? ' has-error' : ' '}}">
                <label for="name">Name :</label>
                <select class="form-control select2" name="user_id" value="{{ old('user_id') }}" placeholder="user" style="width: 100%;">
                    @foreach($user as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('user_id'))
                <span class="help-block">
                <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
                @endif
            </div>   

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Approver 1 : </label>
                    <select class="form-control select2" name="approversatu_id" placeholder="approver1" style="width: 100%;">
                        <option value="">select approval name</option>
                        @foreach($user as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('approversatu_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('approversatu_id') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Approver 2 : </label>
                        <select class="form-control select2" name="approverdua_id" placeholder="approver2" style="width: 100%;">
                            <option value="">select approval name</option>
                            @foreach($user as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('approverdua_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('approverdua_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Approver 3 : </label>
                        <select class="form-control select2" name="approvertiga_id" placeholder="approver3" style="width: 100%;">
                            <option value="">select approval name</option>
                            @foreach($user as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('approvertiga_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('approvertiga_id') }}</strong>
                            </span>
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