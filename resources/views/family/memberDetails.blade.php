<!-- In resources/views/family/details.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        </br></br>
        <div class="row">
            <div class="col-md-8">
            <h2>Family Member Details - {{ $family_name->name.' '.$family_name->surname }}</h2>
            </div>
            <div class="col-md-4 text-right">
            <a href="{{ route('details') }}" class="btn btn-success">Home</a>
            <a href="{{ route('family.member.create', ['family_id' => $family_name->id]) }}" class="btn btn-primary">Add Family Member</a>
            </div>
        </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Marital Status</th>
                    <th>Wedding Date</th>
                    <th>Education</th>
                    <th>Created At</th>
                    <th>photo</th>
                </tr>
            </thead>
            <tbody>
            <?php   $profile = asset(Storage::url('uploads'));?>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->birthdate }}</td>
                        <td>{{ $member->marital_status }}</td>
                        <td>{{ $member->wedding_date }}</td>
                        <td>{{ $member->education }}</td>
                        <td>{{ $member->created_at }}</td>
                        <td>
                        <td> <img src="{{ $profile.'/'.$member->photo }}" style="max-width: 100px;" class="card-img-top" alt="Thumbnail"></td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $members->links() }} <!-- Display pagination links -->
    </div>
@endsection
