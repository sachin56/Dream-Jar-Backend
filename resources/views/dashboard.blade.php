@extends('layouts.master')

@section('title', 'Home')

@section('headerStyle')
<style>

    .dash_large_btn h3{
        font-size: 1.2rem;
    }

    .header-btn{
        padding-top: 2px !important;
    }

    @media only screen and (max-width : 1399px) {
        .dash_large_btn{
            margin-bottom: 10px;
        }
    }   

    @media only screen and (max-width : 575px) {
        .subheader-title {
            font-size: 16px;
        }

        .tab-content{
            padding: 15px 0 !important;
        }

        div.dataTables_wrapper div.dataTables_length label {
            font-size: 11px;
        }

        .dash_large_btn h3 {
            font-size: 15px !important;
        }

        .dash_large_btn {
            min-height: 50px;
        }

        .page-wrapper .page-content {
            font-size: 12px;
        }

        .table{
            width: 100px !important;
        }

        #ongoingCaseList_length{
            display: none;
        }

    } 
</style>
@stop

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-3 mb-3 flex-stretch">
        @if(isset($dashboardButtons) && count($dashboardButtons) > 0)
            @foreach($dashboardButtons as $button)
                @can($button->permission)
                    <div class="col mt-2">
                        <a href="{{ route($button->url) }}">
                            <div class="p-4 bg-{{ $button->color }}-500 rounded overflow-hidden position-relative text-white waves-effect w-100 dash_large_btn">
                                <h3 class="d-block l-h-n m-0 fw-500">
                                    {{ $button->name }}
                                </h3>
                                <i class="fal fa-file-alt position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3.5rem"></i>
                            </div>
                        </a>
                    </div>
                @endcan
            @endforeach
        @endif
    </div>

    @php $user = Auth::user(); @endphp

    @if($user->can('new-case-opening-list') || $user->can('ongoing-list-edit'))
    <div class="row">
        <div class="col-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">
                        <ul class="nav nav-pills" role="tablist">
                            @php $hasNewCasePermission = $user->can('new-case-opening-list'); @endphp
                            @can('ongoing-list-edit')
                                <h1 class="subheader-title" style="display: flex; align-items: center; gap: 10px;">
                                   <b>My Ongoing Case List</b> <span id="recordCount" class="badge badge-danger p-2" style="max-width: fit-content; font-size: 13px;"></span>
                                </h1>
                            @endcan
                        </ul>

                        <div class="tab-content p-3">
                            {{-- Uncomment this block if needed in future --}}

                            @can('ongoing-list-edit')
                                <div class="tab-pane fade active show" id="tab_default-3" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered w-100" id="ongoingCaseList">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    @can('case-details-create')
                                                        <th style="width: width: 100px;">Case Label</th>
                                                    @endcan
                                                    <th style="width: 118px !important;">Case Type</th>
                                                    <th style="width: 95px;">Case Number</th>
                                                    <th style="width: 115px;">Added Date</th>
                                                    <th>Complaint</th>
                                                    <th>Suspects Name(s)</th>
                                                    <th style="width: 200px;">Current Office & User</th>
                                                    <th>View / Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @endif

    <div class="row">
        @if($user->can('resources-create') || $user->can('resources-view'))
        <div class="col-12 col-lg-10 col-xl-6">

            <div class="alert border-faded bg-transparent text-secondary fade show bg-light" role="alert">
                <div class="d-flex align-items-sm-center flex-column flex-sm-row">
                    <div class="flex-1 d-flex align-items-center mb-3 mb-sm-0">
                        <div class="alert-icon">
                            <span class="icon-stack icon-stack-md">
                                <i class="base-7 icon-stack-3x color-success-600"></i>
                                <i class="fal fa-plus icon-stack-1x text-white"></i>
                            </span>
                        </div>
                        <span class="h5 mb-0">Add Resources</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @can('resources-create')
                            <a href="{{ route('resources.create') }}" class="btn btn-success btn-lg waves-effect waves-themed shadow">
                                <span class="mr-1 fal fa-plus"></span> Add Resources
                            </a>
                        @endcan
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        @can('resources-view')
                            <a href="{{ route('resources.view-resources') }}" class="btn btn-lg btn-primary">
                                <span class="mr-1 fal fa-list"></span> View Resources
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(Auth::user()->designation_id === 15)
            <div class="col-lg-6">
                <div class="alert border-faded bg-transparent text-secondary fade show bg-light">
                    <div class="d-flex align-items-center">
                        <span class="icon-stack icon-stack-md mr-2">
                            <i class="base-7 icon-stack-3x color-warning-600"></i>
                            <i class="fal fa-calendar icon-stack-1x text-white"></i>
                        </span>
                        <div class="flex-1">
                            <span class="h5">Calendar</span>
                        </div>
                        <button type="button" class="btn btn-lg btn-primary waves-effect waves-themed" data-toggle="modal" data-target=".default-example-modal-right">
                            <span class="mr-1 fal fa-eye"></span>
                            View Calendar</button>
                    </div>
                </div>

                <div class="modal fade default-example-modal-right show" tabindex="-1" role="dialog" aria-modal="true" >
                    <div class="modal-dialog modal-dialog-right">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4 js-get-date"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="panel-3" class="panel" style="border: none; box-shadow: none;">
                                    <div class="panel-container show">
                                        <div class="panel-content"  style="padding: 0; border: none !important; box-shadow: none;">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($user->can('letters-generate'))
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-hdr">
                        <h2>Reports and Letters</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- Add any buttons/links for reports and letters here --}}
                            <a href="{{ route('letters.generate') }}" class="btn btn-lg btn-info">
                                <span class="mr-1 fal fa-envelope"></span> Generate Letters
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@stop


@section('footerScript')
    <script>

        function submitDeleteForm(form) {
                new Swal({
                title: "Are you sure?",
                text: "do you want to delete this?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes Delete",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            return false;
        }

        function confirmStatusChange(form) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to change the status?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn-success',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

            return false;
        }
    </script>
@stop
