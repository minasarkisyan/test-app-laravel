@extends('layouts.app')

@section('content')

    <div class="col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header font-weight-bold">
                <div class="d-flex justify-content-between">
                    <div>
                        Sections
                    </div>
                    <div class="ml-auto">
                        <a type="button" href="{{ route('sections.create') }}" class="btn btn-success">Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <table class="table">
                        <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <th>
                                <img src="{{ asset('images/' . $section->logo) }}" width="50" height="50" alt="logo">
                            </th>
                            <td>
                                <p class="font-weight-bold">
                                    {{$section->name}}
                                </p>
                                {{$section->description}}
                            </td>
                            <td>
                                @forelse($section->users as $user)
                                    <p>{{ $loop->iteration }}.{{ $user->name }}</p>
                                @empty
                                <p>No users</p>
                                @endforelse
                            </td>
                            <td class="row">
                                <a type="button" href="{{ route('sections.edit', $section->id) }}" class="btn btn-secondary mr-2">Edit</a>
                                <form action="{{ route('sections.destroy', $section->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">
            {{ $sections->links() }}
        </div>
    </div>
@endsection
