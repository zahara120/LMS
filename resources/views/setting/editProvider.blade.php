@extends('layout.template')
@section('title','Edit Provider')

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Provider</h3>
    </div>

        <form  class="form-horizontal" role="form" action="{{ url('provider/'.$provider->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="box-body">
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Name Provider :</label>
            <div class="col-sm-8">
                <input class="form-control select2" name="nameProvider" type="text" value="{{ $provider->nameProvider}}" >
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Type Provider :</label>
            <div class="col-sm-8">
                <select class="form-control select2" name="typeProvider"  value="{{ $provider->typeProvider }}" style="width: 100%;" >
                    <option value="External" {{ $provider->typeProvider == 'External' ? 'selected' : ''  }}>External</option>
                    <option value="Internal" {{ $provider->typeProvider == 'Internal' ? 'selected' : ''  }}>Internal</option>
                </select>
            </div>
        </div>

    </div>

        <div class="modal-footer">
            <a href="{{ url()->previous() }}" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>

</div>
@endsection