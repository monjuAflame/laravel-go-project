@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div> {{ isset($role) ? 'Update' : 'Create' }} Role
                <div class="page-title-subheading">{{ isset($role) ? 'Update' : 'Create' }} Role Here.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button> --}}
            <div class="d-inline-block">
                <a href="{{ route('app.roles.index') }}" class="btn-shadow btn btn-danger">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-arrow-circle-left fa-w-20"></i>
                    </span>
                    Role List
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
           <form action="{{ isset($role) ? route('app.roles.update', $role->id) : route('app.roles.store') }}" method="post">
            @csrf
            @isset($role)
                @method('PUT')
            @endisset
            <div class="card-body">
                <h5 class="card-title">
                    Manage Roles
                </h5>
                <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" required autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="text-center">
                    <strong>Manage Permissions for Role</strong>
                    @error('permissions')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox mt-2">
                        <input type="checkbox" class="custom-control-input" id="select-all">
                        <label for="select-all" class="custom-control-label">Select All</label>
                    </div>
                </div>
                @forelse ($modules->chunk(2) as $key => $chunks)
                    <div class="form-row mt-3">
                        @foreach ($chunks as $key => $module)
                            <div class="col">
                                <h5>Module: {{ $module->name }}</h5>
                                @foreach ($module->permissons as $key => $permission)
                                    <div class="mb-3 ml-4">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input 
                                                    type="checkbox" 
                                                    class="custom-control-input" 
                                                    id="permission-{{ $permission->id }}" 
                                                    name="permissions[]" 
                                                    value="{{ $permission->id }}""
                                                    @isset($role)
                                                        @foreach ($role->permissions as $rolePermisson)
                                                            {{ $permission->id == $rolePermisson->id ? 'checked' : '' }}
                                                        @endforeach
                                                    @endisset
                                                >
                                            <label for="permission-{{ $permission->id }}" class="custom-control-label">
                                            {{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="col text-center">
                        <strong>No Module Found !</strong>
                    </div>
                @endforelse

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa fa-plus-circle mr-1"></i>
                    @isset($role)
                    <span>Update</span>
                    @else
                    <span>Create</span>
                    @endisset
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $('#select-all').click(function(event){
            if(this.checked){
                $(':checkbox').each(function(){
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function(){
                    this.checked = false;
                })
            }
        })
    </script>
@endpush

