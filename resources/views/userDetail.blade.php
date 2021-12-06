@extends('layout.template')
@section('title','User Detail')

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
            @if($training->end_date < $date)
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#provider" disabled>
                insert trainee
            </button>
            @else
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#provider">
                insert trainee
            </button>
            @endif
        </div>
    </div>
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
                            <a href="" class="btn btn-xs btn-primary">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <form action="{{route('training.user.delete', $regist->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button> 
                            </form>
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
            <form action="{{route('training.user.store', $training->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>User : </label>
                        <select class="form-control select2" name="user_id" style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="name">Title Training :</label>
                <input type="text" name="titleTraining" class="form-control" value="{{$training->approval->titleTraining}}" disabled>
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