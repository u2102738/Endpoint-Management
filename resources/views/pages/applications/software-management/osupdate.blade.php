@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="crm mb-25">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                        <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                            <h4 class="text-capitalize fw-500 breadcrumb-title">{{ trans('menu.software-osupdate') }}</h4>
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

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default card-md mb-4">
                    <div class="card-body">
                        <div class="tab-wrapper">

                            <div class="dm-tab tab-horizontal">
                                <ul class="nav nav-tabs vertical-tabs" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab-v-1-tab" data-bs-toggle="tab" href="#tab-v-1" role="tab" aria-selected="true">By Device</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-v-2-tab" data-bs-toggle="tab" href="#tab-v-2" role="tab" aria-selected="false">By Group</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    {{-- By Device --}}
                                    <div class="tab-pane fade show active" id="tab-v-1" role="tabpanel" aria-labelledby="tab-v-1-tab">
                                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                                    <div class="project-search order-search  global-shadow mt-10">
                                                        <form action="" class="order-search__form">
                                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Filter by keyword" id="filterInput" aria-label="Search">
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="content-center">
                                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                                        <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal" data-bs-target="#send-reminder-device"><i class="fas fa-bell"></i> Send Reminder</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="table-responsive card-body-scrollable">
                                                <table class="table mb-0 table-borderless border-0" id="deviceTable">
                                                    <thead class="sticky-top">
                                                        <tr class="userDatatable-header">
                                                            <th scope="col">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bd-example-indeterminate">
                                                                        <div class="checkbox-theme-default custom-checkbox check-all-device">
                                                                            <input class="checkbox check-all-device" type="checkbox" id="check-23">
                                                                            <label for="check-23">
                                                                                <span class="checkbox-text ">
                                                                                    device name
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th scope="col text-center">
                                                                <span class="userDatatable-title">OS Version</span>
                                                            </th>
                                                            <th scope="col">
                                                                <span class="userDatatable-title">device owner</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($devices->isEmpty())
                                                            <tr>
                                                                <td colspan="3">
                                                                    <p class="text-center">No devices found!</p>
                                                                </td>
                                                            </tr>
                                                        @else
                                                            @foreach ($devices as $device)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="checkbox-group-wrapper">
                                                                                <div class="checkbox-group d-flex me-1">
                                                                                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                                        <input class="checkbox" type="checkbox" id="check-grp-{{ $device->id }}" name="device[]">
                                                                                        <label for="check-grp-{{ $device->id }}"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a href="{{ route('computer.device_detail', [app()->getLocale(), $device->id]) }}" class="text-dark">
                                                                            <div class="orderDatatable-title">
                                                                                <h6 class="device-name">{{ $device->name }}</h6>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="userDatatable-content">
                                                                        {{ $device->hardware->OS_Version }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="userDatatable-content text-center" style="text-transform: none;">
                                                                        {{ $device->device_owner }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>

                                                {{-- Send Update Reminder confirmation modal --}}
                                                <div class="modal-info-update-reminder modal fade show" id="send-reminder-device" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-info" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="modal-info-body d-flex">

                                                                    <div class="modal-info-text w-100">
                                                                        <h6>Send update reminder to this device(s)?</h6>
                                                                        <div class="overflow-y-scroll"></div>
                                                                        <p><i class="uil uil-exclamation-circle"></i> This process cannot be undone!</p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <form action="{{ route('software-management.sendReminderOSUpdate','en') }}" method="post" id="send-reminder-form">
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

                                            </div>
                                        </div>
                                    </div>

                                    {{-- By Group --}}
                                    <div class="tab-pane fade" id="tab-v-2" role="tabpanel" aria-labelledby="tab-v-2-tab">
                                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                                    <div class="project-search order-search  global-shadow mt-10">
                                                        <form action="" class="order-search__form">
                                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Filter by keyword" id="filterInput-Group" aria-label="Search">
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="content-center">
                                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                                        <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal" data-bs-target="#send-reminder-group"><i class="fas fa-bell"></i> Send Reminder</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="table-responsive card-body-scrollable">
                                                <table class="table mb-0 table-borderless border-0" id="deviceGroupTable">
                                                    <thead class="sticky-top">
                                                        <tr class="userDatatable-header">
                                                            <th scope="col">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bd-example-indeterminate">
                                                                        <div class="checkbox-theme-default custom-checkbox check-all-group">
                                                                            <input class="checkbox check-all-group" type="checkbox" id="check-24">
                                                                            <label for="check-24">
                                                                                <span class="checkbox-text ">
                                                                                    Group Name
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th scope="col">
                                                                <span class="userDatatable-title">Counter (Devices)</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($groupsWithOutdatedDevices->isEmpty())
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p class="text-center">No group found!</p>
                                                                </td>
                                                            </tr>
                                                        @else
                                                            @foreach ($groupsWithOutdatedDevices as $group)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="checkbox-group-wrapper">
                                                                                <div class="checkbox-group d-flex me-1">
                                                                                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                                        <input class="checkbox" type="checkbox" id="check-group-{{ $group->id }}" name="groups[]" data-group-id="{{ $group->id }}">
                                                                                        <label for="check-group-{{ $group->id }}"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="orderDatatable-title">
                                                                            <a class="text-dark cursor-true" data-bs-toggle="modal" data-bs-target="#osupdate-group-{{$group->id}}" data-group-id="{{ $group->id }}">
                                                                                <h6 class="group-name">{{ $group->name }}</h6>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="userDatatable-content text-center" style="text-transform: none;">
                                                                        {{ $group->devices_count }} / {{ $groupTotalDevices[$group->id] }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>

                                                {{-- Send Update Reminder confirmation modal --}}
                                                <div class="modal-info-update-reminder modal fade show" id="send-reminder-group" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-info" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="modal-info-body d-flex">

                                                                    <div class="modal-info-text w-100">
                                                                        <h6>Send update reminder to this group's devices?</h6>
                                                                        <div class="overflow-y-scroll"></div>
                                                                        <p><i class="uil uil-exclamation-circle"></i> This process cannot be undone!</p>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <form action="{{ route('software-management.sendReminderGroupOSUpdate','en') }}" method="post" id="send-reminder-group-form">
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

                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($groupsWithOutdatedDevices as $group)
                                        <div class="modal fade" id="osupdate-group-{{ $group->id }}" role="dialog" tabindex="-1" aria-labelledby="osupdate-group-label-{{ $group->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content radius-xl">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title fw-500" id="osupdate-group-label-{{ $group->id }}">OS Update - {{ $group->name }}</h6>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="generatereport-modal">
                                                            <div class="table-responsive card-body-scrollable">
                                                                <table class="table mb-0 table-borderless border-0">
                                                                    <thead class="sticky-top">
                                                                        <tr class="userDatatable-header">
                                                                            <th scope="col">
                                                                                <div class="text-center">
                                                                                    <span class="userDatatable-title">Device Name</span>
                                                                                </div>
                                                                            </th>
                                                                            <th scope="col">
                                                                                <div class="text-center">
                                                                                    <span class="userDatatable-title">Device Owner</span>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if (count($group->devices) == 0)
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <p class="text-center">No Device Found !</p>
                                                                                </td>
                                                                            </tr>
                                                                        @else
                                                                            @foreach ($group->devices as $device)
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="orderDatatable-title text-center">
                                                                                            <a href="{{ route('computer.device_detail', [app()->getLocale(), $device->id]) }}" class="text-dark">
                                                                                                <h6>{{ $device->name }}</h6>
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="orderDatatable-title text-center">
                                                                                            {{ $device->device_owner }}
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

