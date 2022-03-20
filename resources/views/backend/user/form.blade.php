@extends('layouts.backend.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

    </style>
@endpush
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> {{ isset($user) ? 'Update' : 'Create' }} Role
                    <div class="page-title-subheading">{{ isset($user) ? 'Update' : 'Create' }} User Here.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button> --}}
                <div class="d-inline-block">
                    <a href="{{ route('app.users.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ isset($user) ? route('app.users.update', $user->id) : route('app.users.store') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <h5 class="card-title">
                                    User Info
                                </h5>
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $user->name ?? old('name') }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email ?? old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" placeholder="******"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        {{ isset($user) ? '' : '' }}>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation"
                                        name="password_confirmation" placeholder="******" {{ isset($user) ? '' : '' }}>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>
                                <div class="position-relative form-group">
                                    <label for="role">Select Role</label>
                                    <select id="role"
                                        class="form-control select js-example-basic-single @error('role') is-invalid @enderror"
                                        name="role_id">
                                        <option value="">Select</option>
                                        @foreach ($roles as $key => $role)
                                            <option @if (isset($user)) {{ $user->role->id == $role->id ? 'selected' : '' }} @endif value="{{ $role->id }}">
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="position-relative form-group">
                                    <label for="avatar">Avatar (Only Image are allowed) </label>
                                    <input type="file" name="avatar" id="avatar"
                                        class="dropify @error('avatar') is-invalid @enderror"
                                        data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar', 'thumb') : '' }}">
                                    @error('avatar')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                        <label class="custom-control-label" for="status">Select Status</label>
                                      </div>
                                </div>

                                <button type="button" class="btn btn-danger" onClick="resetForm('userFrom')">
                                    <i class="fas fa-redo"></i>
                                    <span>Reset</span>
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    @isset($user)
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Update</span>
                                    @else
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Create</span>
                                    @endisset
                                </button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
