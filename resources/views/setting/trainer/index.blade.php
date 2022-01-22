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
        <h3 class="box-title">Data Trainer</h3>
        <div class="pull-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#provider">
                create
            </button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <table id="table"  class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Lesson</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($trainers as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{$item->lesson->nameLesson}}</td>
                <td class="text-center" width="200px">
                    <a href="{{route('trainers.edit', $item->id)}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="{{route('trainers.destroy', $item->id)}}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
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


<!-- Modal Create -->
<div class="modal fade" id="provider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add User</h4>
        </div>
        <div class="modal-body">
            <form action="{{route('trainers.store')}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lesson : </label>
                        <select class="form-control select2" name="lesson_id" placeholder="Lesson" style="width: 100%;">
                            <option value="">Select Lesson</option>
                            @foreach($lessons as $item)
                            <option value="{{ $item->id }}">{{ $item->nameLesson }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('lesson_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lesson_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <table>
                            <thead>
                                <th>List box 1</th>
                                <th>Transfer Values</th>
                                <th>List box 3</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select id="lb1" class="form-control" style="width: 100%;" multiple>
                                            @foreach($users as $item)    
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="button" id="but1" value=">>">
                                        <input type="button" id="but2" value="<<">
                                    </td>
                                    <td>
                                        <select id="lb2" class="form-control" name="trainer_id[]" placeholder="Trainer" style="width: 100%;" multiple></select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @section('scripts')
                        <script>
                            $ (function()
                            {
                                $("#but1").click(function()
                                {
                                    $("#lb1 option:selected").each(function()
                                    {
                                        $(this).remove().appendTo("#lb2");
                                    });
                                });
                                
                                $("#but2").click(function()
                                {
                                    $("#lb2 option:selected").each(function()
                                    {
                                        $(this).remove().appendTo("#lb1");
                                    });
                                });
                            });
                        </script>
                        @endsection
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
