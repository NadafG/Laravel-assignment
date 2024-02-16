@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Enter Family Information</h2>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">
                <form method="POST" action="{{ url('/family') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="surname">Name:</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surname">Surname:</label>
                                <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}">
                                @error('surname')
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
                            <label for="mobile">Mobile No:</label>
                            <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}">
                            @error('mobile_no')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" value="{{ old('address') }}">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">State:</label>

                                <select id="state" class="form-control @error('state') is-invalid @enderror">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                                    @endforeach
                                </select>

                                @error('state')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City:</label>
                                <select id="city" class="form-control @error('city') is-invalid @enderror">
                                    <option value="">Select city</option>
                                </select>
                                @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pincode">Pincode:</label>
                                <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}">
                                @error('pincode')
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

                    <div class="row">
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="hobbies">Hobbies:</label>
                                <div id="hobbies_container">
                                   @foreach(old('hobbies', ['']) as $hobby)
                                        <input type="text" name="hobbies[]" class="form-control @error('hobbies') is-invalid @enderror" value="{{ $hobby }}">
                                    @endforeach
                                </div>
                                <button type="button" id="add_hobby" class="btn btn-secondary mt-2">Add Hobby</button>
                                @error('hobbies')
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
                        <a href="{{ route('family.details') }}" class="btn btn-danger">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        // Script for handling dynamic hobbies field
        document.getElementById('add_hobby').addEventListener('click', function () {
            var container = document.getElementById('hobbies_container');
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'hobbies[]';
            input.className = 'form-control';
            container.appendChild(input);
        });

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

          // Fetch districts for the selected state
          document.getElementById('state').addEventListener('change', function () {
            var selectedState = this.value;
            var states = @json($states);
            var districts = {};
            states.forEach(function(state) {
                districts[state.state] = state.districts;
            });

            var districtDropdown = document.getElementById('city');
            districtDropdown.innerHTML = '<option value="">Select city</option>';
            
            districts[selectedState].forEach(function(district) {
                var option = document.createElement('option');
                option.text = district;
                option.value = district;
                districtDropdown.add(option);
            });
        });
    </script>
@endsection
