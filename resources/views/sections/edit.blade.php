@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sections
            </div>
            <div class="card-body">
                <div class="card-text">
                    <form action="{{ route('sections.update', $section->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" class="form-control-file @error('logo') is-invalid @enderror" id="name" value="{{ $section->logo }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $section->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description">
                                {{ $section->description }}
                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        @forelse($section->users as $user)
                            <div class="form-check">
                                <input name="user_id[]" class="form-check-input" value="{{ $user->id }}"
                                       type="checkbox"
                                       id="defaultCheck1"
                                    {{ $user ? 'checked' : '' }}>
                                <label class="form-check-label" for="defaultCheck1" >{{$user->name}}</label>
                                <a href="#">{{ $user->email }}</a>
                            </div>
                            @empty
                            <p>No users</p>
                        @endforelse
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
