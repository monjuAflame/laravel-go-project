@extends('layouts.backend.app')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>User
                <div class="page-title-subheading">All User Available Here.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-star"></i>
            </button> --}}
            <div class="d-inline-block">
                <a href="{{ route('app.users.create') }}" class="btn-shadow btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Create User
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
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Joined At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td class="text-center text-muted">{{ $key+1 }}</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="rounded-circle"
                                                    src="{{ config('app.placeholder') . '160.png' }}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">{{ $user->name }}</div>
                                            <div class="widget-subheading opacity-7">
                                                @if ($user->role)
                                                    {{ $user->role->name }}
                                                    @else
                                                    No Role Found
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">
                                @if ($user->status==true)
                                    <div class="badge badge-info">Active</div>
                                @else
                                    <div class="badge badge-danger">Inctive</div>
                                @endif
                            </td>
                            <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="{{ route('app.users.edit', $user->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteData({{ $user->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Delete</span>
                                </button>
                                <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('app.users.destroy',$user->id) }}" method="POST"
                                        style="display: none;">
                                    @csrf()
                                    @method('DELETE')
                                </form>
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

