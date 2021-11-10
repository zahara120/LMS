@extends('layout.template')
@section('title','Training')

@section('content')
<div class="box">
    @include('layout.nav')
    {{-- <div class="box-body"> --}}
    <div class="panel-body">
    <?php $i = 1; ?>
        @foreach($questions as $item)
            {{-- @if ($i > 1) <hr /> @endif --}}
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{!! nl2br($item->question) !!}</strong>

                        <input type="hidden"name="questions[{{ $i }}]"value="{{ $item->id }}">
                        @foreach($item->options as $question)
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="answers[{{ $item->id }}]" value="{{ $question->id }}">
                                {{ $question->option_text }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
    </div>
    </div>
{{-- </div> --}}

@endsection