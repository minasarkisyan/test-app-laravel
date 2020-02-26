@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sections
            </div>
            <div class="card-body">
                <div class="card-text">
                    <form action="{{ route('sections.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" class="form-control-file @error('logo') is-invalid @enderror" id="name" placeholder="Upload image">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        @foreach($users as $user)
                            <div class="form-check">
                                <input name="user_id[]" class="form-check-input" value="{{ $user->id }}" type="checkbox" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1" >{{$user->name}}</label>
                                <a href="#">{{ $user->email }}</a>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
