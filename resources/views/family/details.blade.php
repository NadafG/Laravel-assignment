<!-- In resources/views/family/details.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        </br></br>
        <div class="row">
            <div class="col-md-6">
                <h2>Family Details</h2>
            </div>
            <div class="col-md-6 text-right">
               
                <a href="{{ route('family.create') }}" class="btn btn-primary">Create New Family</a>
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
                    <th>Surname</th>
                    <th>Birthdate</th>
                    <th>Mobile No</th>
                    <th>Pincode</th>
                    <th>Created At</th>
                    <th>Photo</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
             <?php   $profile = asset(Storage::url('uploads'));?>
                @foreach ($families as $family)
                    <tr>
                        <td>{{ $family->name }}</td>
                        <td>{{ $family->surname }}</td>
                        <td>{{ $family->birthdate }}</td>
                        <td>{{ $family->mobile_no }}</td>
                        <td>{{ $family->pincode }}</td>
                        <td>{{ $family->created_at }}</td>
                        <td> <img src="{{ $profile.'/'.$family->photo }}" style="max-width: 100px;" class="card-img-top" alt="Thumbnail"></td>
                        <td>
                        <a href="{{ route('family.member.show', ['family_id' => $family->id]) }}" class="btn btn-primary">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $families->links() }} <!-- Display pagination links -->
    </div>
@endsection
