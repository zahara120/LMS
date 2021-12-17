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
        <h3 class="box-title">Data Venue Training</h3>
        <div class="pull-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModal">
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
                <th>Name Venue</th>
                <th class="text-center">Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($venue as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nameVenue }}</td>
                <td class="text-center" width="200px">
                    {{-- <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#editmodal">
                        <i class="fa fa-pencil"></i> Edit
                    </button> --}}
                    <a href=" " class="btn btn-xs btn-info" >
                        <i class="fa fa-eye"></i> View
                    </a>
                    <a href="{{url('/venue/'.$item->id.'/edit')}}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                    <form action="{{ url('venue/'.$item->id) }}" class="inline" method="post" onclick="return confirm('Are you sure want to delete this data?')">
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Venue Training</h4>
        </div>
        <div class="modal-body">
            <form action="/venue" method="post">
            @csrf
            <div class="form-group {{$errors->has('nameVenue') ? ' has-error' : ' '}}">
                <label for="nameVenue">Name Venue :</label>
                <input type="text" name="nameVenue" class="form-control" id="nameVenue" placeholder="Nama Venue Training">
                @if ($errors->has('nameVenue'))
                <span class="help-block">
                <strong>{{ $errors->first('nameVenue') }}</strong>
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
        <form action="{{route('venue.import')}}" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              @csrf
              Templates can be downloaded <a href="{{route('venue.template')}}">here</a>
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
                <label for="nameCategory">Location Venue :</label>
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