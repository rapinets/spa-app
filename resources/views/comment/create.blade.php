@extends('layout')



@section('modal')

<div class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('comment.store') }}">
                    @csrf

                    <div class="visually-hidden">
                        <input type="text" id="parent" name="parent" value="{{$_GET['comment']}}">
                    </div>

                    <div class="row mb-3">
                    <label for="textarea" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea class="@error('content') is-invalid @enderror form-control" id="textarea" name="content" style="height: 100px"></textarea>
                            @error('content')
                                <div class="alert">Fill in the field</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Add</button>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
