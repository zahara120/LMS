@extends('layout.template')
@section('title','User Detail')

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<div class="box">
    <div class="box-body table-responsive">
        <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>NIP</th>
                <th>Name User</th>
                <th>Role</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($training->regist as $regist)
                @if($regist->status == 1)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$regist->user->nip}}</td>
                        <td>{{$regist->user->name}}</td>
                        <td>
                            @foreach ($regist->user->role as $user)
                                {{ $user->nameRole }}
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
                @endif
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
                        <option value=""></option>
                    </select>
                    </div>
                </div>
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