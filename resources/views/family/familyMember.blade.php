@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Add Family Member</h2>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('family.members.store', ['family_id' => $family_id]) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="surname">Name:</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div> 
                    </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="birthdate">Birthdate:</label>
                            <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}">
                            @error('birthdate')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Education:</label>
                            <input type="text" name="education" class="form-control @error('education') is-invalid @enderror" value="{{ old('education') }}">
                            @error('education')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                 
                <div class="row">
                    <div class="col-md-6">    
                        <div class="form-group">
                            <label>Marital Status:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="marital_status" value="Married" {{ old('marital_status') == 'married' ? 'checked' : '' }}>
                                <label class="form-check-label">Married</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="marital_status" value="Unmarried" {{ old('marital_status') == 'unmarried' ? 'checked' : '' }}>
                                <label class="form-check-label">Unmarried</label>
                            </div>
                            @error('marital_status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">    
                        <div class="form-group" id="wedding_date_group" style="display:none;">
                            <label for="wedding_date">Wedding Date:</label>
                            <input type="date" name="wedding_date" value="{{ old('wedding_date') }}" class="form-control @error('name') is-invalid @enderror">
                            @error('wedding_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
            
                        <a href="{{ route('family.member.show', ['family_id' => $family_id]) }}" class="btn btn-danger">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
       
       $(document).ready(function() {
            var maritalStatusRadios = $('input[name="marital_status"]');
            var weddingDateGroup = $('#wedding_date_group');
            
            function toggleWeddingDateField() {
                if (maritalStatusRadios.filter(':checked').val() === 'Married') {
                    weddingDateGroup.show();
                } else {
                    weddingDateGroup.hide();
                }
            }
            
            // Initial execution of the function
            toggleWeddingDateField();
            
            // Event listener for change in marital status
            maritalStatusRadios.change(toggleWeddingDateField);
        });


    </script>
@endsection
