@extends('layout.template')
@section('title','Approval Record')

@section('content')
@if(session('succes'))
<div class="alert alert-success" role="alert">
    {{session('succes')}}
</div>
@endif

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Approval Record</h3>
        <div class="pull-right">
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#provider">
                create
            </button>
            <a href="" type="button" class="btn btn-success btn-flat">
                Export
            </a>
            <button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#upload">
                Import
            </button> --}}
            {{-- <a href="/categorytraining/create" class="btn btn-primary btn-flat">
               create
            </a> --}}
        </div> 
    </div>
    <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Tittle Training</th>
                <th>Category Training</th>
                <th>Kuota</th>
                <th>Status</th>
                <th>Waktu Pengajuan</th>
                <th >Action</th>
                {{-- <th class="text-center">Action</th> --}}
            </tr> 
        </thead>
        <tbody>
            @foreach ($approval as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->titleTraining }}</td>
                <td>{{ $item->category->nameCategory }}</td>
                {{-- <td>{{ $item->category->nameCategory }}</td> --}}
                <td>{{ $item->quota }}</td>
                <td>
                    @if ($item->status==0)
                    <label class="label label-warning">Pending</label>
                    @elseif ($item->status==1)
                    <label class="label label-success">Approve</label>
                    @elseif($item->status == 2) 
                    <label class="label label-danger">Reject</label>
                    @endif
                    </td>
                <td>{{ $item->created_at }}</td>
                {{-- <td>
                    <label class="label {{ ($item->status == 0) ? 'label-danger' :'label-success' }}">{{ ($item->status==0)?'Pending':'Approve' }}</label>
                </td> --}}
                <td>
                    {{-- <form role="form" action="/approval/{id}" method="post">
                    @csrf
                    <div class="form-group col-md-6">
                        <select name="status">
                          <option value="0" @if($item->status==0)selected @endif>Pending</option>
                          <option value="1" @if($item->status==1)selected @endif>Approve</option>
                          <option value="2" @if($item->status==2)selected @endif>Reject</option> 
                        </select>
                    </div>
                    </form> --}}
    
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning ">Status</button>
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          {{-- <li><a href="/approval/{id},$application->id" status=2 onclick="updateleave(this);removedropdown(this)">Reject</a></li>
                          <li><a href="/approval/{id},$application->id" status=1 onclick="updateleave(this);removedropdown(this)">Approval</a></li> --}}
                          <li><a data-url="{{route('status.update', $item->status)}}" status=2 onclick="updateleave(this);removedropdown(this)">Reject</a></li>
                          <li><a data-url="{{route('status.update', $item->status)}}" status=1 onclick="updateleave(this);removedropdown(this)">Approval</a></li>
                        </ul>
                    </div>
            
                    <div class="col-md-4">
                    @if($item->status==1)
                    <a class="btn btn-info " type ="button" href="/training" > Detail</a>
                    @else
                    <button class="btn btn-info "  data-toggle="modal" data-target="#yModal" disabled> Detail</button>
                    @endif
                    </div> 
         
                    {{-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"  data-status="1">
                              Approve
                            </button>
                            <a class="dropdown-item"  data-status="2">
                              Rejected
                            </button>
                        </div>
                    </div> --}}
                </td>
            </tr>
            @endforeach
        </tbody> 
    </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$('.dropdown-item').click((event) => {
    updateleave(event.target);
    removedropdown(event.target);
  });
  
  function updateleave(el) {
    let data = {
          status:$(el).data('status')
    };
    $.ajax({
      url: $(el).data('url'),
      type: 'PUT',
      data: {
        _token:CSRF_TOKEN,
        status:data
      },
      dataType: 'JSON',
      success: function(result) {
          if (result.error) {
            alert(result.error);
          } else {
            location.reload();
          }
      },
      error: function(err) {
          alert('something went wrong');
      }
    });
  }
  
  function removedropdown(el) {
    // to remove the dropdown after select 
    const dropdown = el.closest('.dropdown'); //get dropdown
    const selected = $(`<label>${$(el).text()}</label>`); //create selected label    
    selected.appendTo($(dropdown).parent()); //append label to dropdown's parent before...
    dropdown.remove(); //...removing dropdown
  }

</script>
@endsection
