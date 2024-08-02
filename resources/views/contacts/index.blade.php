@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contacts</h1>
        <form method="GET" action="{{ route('contacts.index') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email">
            <button type="submit">Search</button>
        </form>
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">Add Contact</a>
        <table class="table">
            <thead>
                <tr>
                    <th><a href="{{ route('contacts.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">Name</a></th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th><a href="{{ route('contacts.index', ['sort_by' => 'created_at', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">Created At</a></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->address }}</td>
                        <td>{{ $contact->created_at }}</td>
                        <td>
                            <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $contacts->links() }}
    </div>
@endsection
