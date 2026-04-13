@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Teacher</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Teacher</h3>
                        </div>

                        <form action="{{ route('teacher.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row" style="margin-top: 20px;">
                                    <div class="form-group col-md-4">
                                        <label>Teacher Name</label>
                                        <input type="text" name="teacher_name" class="form-control" placeholder="Enter Teacher Name" value="{{ old('teacher_name') }}">
                                        @error('teacher_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Teacher's Father Name</label>
                                        <input type="text" name="father_name" class="form-control" placeholder="Enter Father Name" value="{{ old('father_name') }}">
                                        @error('father_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Teacher's Mother Name</label>
                                        <input type="text" name="mother_name" class="form-control" placeholder="Enter Mother Name" value="{{ old('mother_name') }}">
                                        @error('mother_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                                        @error('dob')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone') }}">
                                        @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" placeholder="Enter Password" value="{{ old('password') }}">
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Teacher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('customJs')
<script>
    $(function() {
        // form ready
    });
</script>
@endsection