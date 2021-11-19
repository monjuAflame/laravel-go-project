@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-check icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Role
                <div class="page-title-subheading">All Roles Available Here.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button> --}}
            <div class="d-inline-block">
                <a href="{{ route('app.roles.create') }}" class="btn-shadow btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Create Role
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Permission</th>
                            <th class="text-center">Updated At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td class="text-center text-muted">{{ $key+1 }}</td>
                            <td class="text-center">{{ $role->name }}</td>
                            <td class="text-center">
                                @if ($role->permissions->count() > 0)
                                    <div class="badge badge-info">{{ $role->permissions->count() }}</div>
                                @else
                                    <div class="badge badge-danger">No Permission Found !</div>
                                @endif
                            </td>
                            <td class="text-center">{{ $role->updated_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('app.roles.edit', $role->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                @if ($role->deletable == true)
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $role->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $role->id }}"
                                              action="{{ route('app.roles.destroy',$role->id) }}" method="POST"
                                              style="display: none;">
                                            @csrf()
                                            @method('DELETE')
                                        </form>
                                    @endif
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

