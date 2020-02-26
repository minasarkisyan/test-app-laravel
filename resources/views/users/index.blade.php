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
                        Users
                    </div>
                    <div class="ml-auto">
                        <a type="button" href="{{ route('users.create') }}" class="btn btn-success">Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <table class="table">
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th>{{$user->name}}</th>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td class="row">
                                <a type="button" href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary mr-2">Edit</a>
                                <form action="{{ route('sections.destroy', $user->id) }}" method="POST">
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
            {{ $users->links() }}
        </div>
    </div>
@endsection
