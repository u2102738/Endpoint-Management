@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main user-member justify-content-sm-between">
                <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                    <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                        <h4 class="text-capitalize fw-500 breadcrumb-title">{{ trans('menu.computer-group') }}</h4>
                    </div>
                </div>
                <div class="action-btn">
                    <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal" data-bs-target="#new-role">
                    <i class="las la-plus fs-16"></i>create group</a>
                    {{-- Modal --}}
                    <div class="modal fade new-role" id="new-role" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content radius-xl">
                                <div class="modal-header">
                                    <h6 class="modal-title fw-500" id="staticBackdropLabel">Create New Group</h6>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="uil uil-times"></i>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="new-member-modal">
                                        <form method="post" action="{{ route('computer.groupStore', app()->getLocale()) }}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group mb-20">
                                                <input type="text" class="form-control" name="name" placeholder="Group Name">
                                                @if ($errors->has('name'))
                                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-20">
                                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Group description"></textarea>
                                                @if ($errors->has('description'))
                                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group textarea-group">
                                                <label>Device</label>
                                                <hr>
                                                <div class="dm-tag-mode">
                                                    <div class="dm-select">
                                                        <select name="devices[]" id="select-tag" class="form-control" multiple="multiple">
                                                            @foreach ($devices as $device)
                                                                <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('devices')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="button-group d-flex pt-25">
                                                <button class="btn btn-primary btn-default btn-squared text-capitalize" type="submit">create group</button>
                                                <button class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" data-bs-dismiss="modal" aria-label="Close">cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Close Modal --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Notify on success --}}
    @if (session('success'))
        <div class=" alert alert-success alert-dismissible fade show mb-10" role="alert">
            <div class="alert-content">
                <p><i class="fas fa-check-circle"></i> <strong>Success!</strong> {{ session('success') }}</p>
                <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg" aria-hidden="true">
                </button>
            </div>
        </div>
    {{-- Notify on error --}}
    @elseif (session('error'))
        <div class=" alert alert-danger alert-dismissible fade show mb-10" role="alert">
            <div class="alert-content">
                <p><i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> {{ session('error') }}</p>
                <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                    <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg" aria-hidden="true">
                </button>
            </div>
        </div>
    @endif

    @if (count($groups) == 0)
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="min-vh-60 content-center">
                    <div class="error-page text-center">
                        <h5 class="fw-500">No Group Found!</h5>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach ($groups as $group)
                <div class="col-xxl-4 col-md-6 mb-25">
                    <div class="user-group px-30 pt-30 pb-25 radius-xl bg-white">
                        <div class="border-bottom">
                            <div class="media user-group-media d-flex justify-content-between">
                                <div class="media-body d-flex align-items-center">
                                    <img class="me-20 wh-70 rounded-circle bg-opacity-primary" src="{{ asset('assets/img/ugl1.png') }}" alt="author">
                                    <div>
                                        <a href="{{ route('computer.groupEdit', [app()->getLocale(), $group->id]) }}">
                                            <h6 class="mt-0 fw-500">{{ $group->name }}</h6>
                                        </a>
                                        <p class="fs-13 color-light mb-0">{{ $group->devices()->where('group_id', $group->id)->count() }} Device(s)</p>
                                    </div>
                                </div>
                                <div class="mt-n15">
                                    <div class="dropdown dropdown-click">
                                        <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('assets/img/svg/more-horizontal.svg') }}" alt="more-horizontal" class="svg">
                                        </button>
                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-right dropdown-menu">
                                            <a class="dropdown-item" href="#">view</a>
                                            <a class="dropdown-item" href="{{ route('computer.groupEdit', [app()->getLocale(), $group->id]) }}" class="edit">edit</a>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $group->id }}">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-group-people">
                                <p class="mt-15">{{ $group->description }}</p>
                            </div>
                        </div>
                        <div class="user-group-project">
                            <div class="d-flex justify-content-between user-group-progress-top">
                                <div>
                                    <p class="fs-14 fw-500 color-dark mb-0">Devices</p>
                                </div>
                                <div>
                                    <span class="color-light fs-12">{{ $group->devices()->where('group_id', $group->id)->count() }}</span>
                                </div>
                            </div>

                            <div class="user-group-progress-bar">
                                <p class="color-light fs-12 mb-0">{{ $group->devices->count() }} / {{ $devices->count() }} of Devices</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Delete confirmation modal --}}
                <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $group->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-info-body d-flex">
                                    <div class="modal-info-text">
                                        <h6>Are you sure you want to delete this group?</h6>
                                        <p><i class="uil uil-exclamation-circle"></i> This process cannot be undone!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('computer.groupDelete', [app()->getLocale(), $group->id]) }}" method="post" id="delete-{{ $group->id }}">
                                    @csrf
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-default btn-squared border-normal bg-normal px-20" data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary btn-default btn-squared px-30">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal --}}
            @endforeach
        </div>
    @endif
</div>
@endsection
