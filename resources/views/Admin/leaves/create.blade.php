@extends('dashboard.includes.master')

@section('title', trans('words.add_leave'))

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>{{ trans('words.add_leave') }}</h4>
            </div>

            <form action="{{ route('admin.leave') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- Arabic Leave Type --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Leave_Type') }} (AR)</label>
                        <input type="text" name="leave_type_ar" class="form-control" value="{{ old('leave_type_ar') }}">
                        @error('leave_type_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- English Leave Type --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Leave_Type') }} (EN)</label>
                        <input type="text" name="leave_type_en" class="form-control" value="{{ old('leave_type_en') }}">
                        @error('leave_type_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Hours Balance --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Hours_Balance') }}</label>
                        <input type="number" name="balance_hours" class="form-control">
                        @error('balance_hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Year --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Year') }}</label>
                        <input type="number" name="year" class="form-control" value="{{ old('year', date('Y')) }}">
                        @error('year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">{{ trans('words.save') }}</button>
                    <a href="{{ route('admin.all.leaves') }}" class="btn btn-secondary">{{ trans('words.cancel') }}</a>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
