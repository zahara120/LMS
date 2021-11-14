@extends('layout.template')
@section('title','Approval Detail')

@section('content')

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Approval Detail</h3>
    </div>

    <div class="box-body">

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Title Training :</label>
            <div class="col-sm-8">
            <select class="form-control select2" name="approval_id" placeholder="titleTraining" style="width: 100%;" disabled>
                <option>{{$approval->titleTraining}}</option>
            </select>
            </div>
        </div>

        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Status :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$approval->status}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Quota :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$approval->quota}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Objective Training :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$approval->objectiveTraining}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Background Training :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$approval->backgroundTraining}}" disabled>
            </div>
        </div>
        
        <div class="form-group row mt-2">
            <label class="col-sm-3 control-label">Description :</label>
            <div class="col-sm-8">
                <input class="form-control select2" type="text" value="{{$approval->description}}}" disabled>
            </div>
        </div>
        <form action="/approval/{{$approval->id}}" method="post">
        @csrf
        @method('PUT')
            <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Decision :</label>
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label><input type="radio" name="status" id="approve" onclick="javascript:statusCheck();" value="1">Terima</label>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="checkbox">
                        <label><input type="radio" name="status" id="reject" onclick="javascript:statusCheck();" value="2">Tolak</label>
                    </div>
                </div>
            </div>

            <div id="ifreject" style="display:none">
                <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Alasan :</label>
                <div class="col-sm-8">
                    <input type="text" name="alasan" placeholder="alasan">
                </div>
            </div>
            </div>

            {{-- <div class="form-group row mt-2">
                <label class="col-sm-3 control-label">Alasan :</label>
                <div class="col-sm-8">
                    <input type="text" name="alasan" placeholder="Alasan">
                </div>
            </div> --}}
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">

    function statusCheck() {
        if (document.getElementById('reject').checked) {
            document.getElementById('ifreject').style.display = 'block';
        }
        else document.getElementById('ifreject').style.display = 'none';
    
    }

</script>

@endsection