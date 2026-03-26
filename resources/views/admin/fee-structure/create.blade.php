@extends('admin.layout')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fee Structure</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Fee Structure</li>
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
                            <h3 class="card-title">Add Fee Structure</h3>
                        </div>

                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <form action="{{ route('fee-structure.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Select Class</label>
                                        <select name="class_id" class="form-control" required>
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Select Academic Year</label>
                                        <select name="academic_year_id" class="form-control" required>
                                            <option value="" disabled selected>Select Academic Year</option>
                                            @foreach ($academic_year as $academic_year)
                                            <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('academic_year_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Select Fee Head</label>
                                        <select name="fee_head_id" class="form-control" required>
                                            <option value="" disabled selected>Select Fee Head</option>
                                            @foreach ($fee_head as $fee_head)
                                            <option value="{{ $fee_head->id }}">{{ $fee_head->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('fee_head_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>            
                                <div class="row" style="margin-top: 20px;">
                                    <div class="form-group col-md-4">
                                        <label for="name">January Fee</label>
                                        <input type="text" name="january" class="form-control" id="name" placeholder="Enter January Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">February Fee</label>
                                        <input type="text" name="february" class="form-control" id="name" placeholder="Enter February Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">March Fee</label>
                                        <input type="text" name="march" class="form-control" id="name" placeholder="Enter March Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">April Fee</label>
                                        <input type="text" name="april" class="form-control" id="name" placeholder="Enter April Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">May Fee</label>
                                        <input type="text" name="may" class="form-control" id="name" placeholder="Enter May Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">June Fee</label>
                                        <input type="text" name="june" class="form-control" id="name" placeholder="Enter June Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">July Fee</label>
                                        <input type="text" name="july" class="form-control" id="name" placeholder="Enter July Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">August Fee</label>
                                        <input type="text" name="august" class="form-control" id="name" placeholder="Enter August Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">September Fee</label>
                                        <input type="text" name="september" class="form-control" id="name" placeholder="Enter September Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">October Fee</label>
                                        <input type="text" name="october" class="form-control" id="name" placeholder="Enter October Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">November Fee</label>
                                        <input type="text" name="november" class="form-control" id="name" placeholder="Enter November Fee" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">December Fee</label>
                                        <input type="text" name="december" class="form-control" id="name" placeholder="Enter December Fee" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Fee Structure</button>
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
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection