@extends('layout.template')
@section('title','Detail Lesson')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Add Category</h3>
    </div>

    <tr>
        <th>Name Category</th>
        <th>Name Subcategory</th>
        <th>Name Lesson</th>
        <th>Link</th>
        <th>Video</th>
        <th>Action</th>
    </tr>
    {{-- @foreach ($lesson as $item) --}}
    <tr>
        {{-- <td>{{ $item->category->nameCategory }}</td>
        <td>{{ $item->subcategory->nameSubcategory }}</td> --}}
        <td>{{ $lesson->nameLesson }}</td>
        <td>{{ $lesson->url }}</td>
        <iframe height="400"  width="600" src="/videos/{{$lesson->file}}"></iframe>
        {{-- <td>{{ $item->file }}</td> --}}
        <td>{{ $lesson->description }}</td>
    </tr>
    {{-- @endforeach --}}
</div>

@endsection