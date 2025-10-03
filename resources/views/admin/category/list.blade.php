@extends('layouts.master')

@section('title', 'Category')

@section('content')
<main id="js-page-content" role="main" class="page-content">

    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Category <span class='fw-300'></span>
        </h1>

        <div class="row" style="margin-left:auto; margin-right:auto; gap: 12px">
            <a href=" {{ route('category.create') }}">
            <button type="button"  class="btn btn-success btn-lg waves-effect waves-themed shadow">
                <span class="mr-1 fal fa-plus"></span>
                Add New
            </button>
            </a>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Category <span class="fw-300"><i>list</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <th style="width: 10px;">#</th>
                                <th >Name</th>
                                <th style="width: 25;">Edit</th>
                                <th style="width: 85px;">Delete</th>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@section('footerScript')
<script>
    $(document).ready(function() {
        var table = $('#dt-basic-example').dataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searching: true,
            ajax: {
                url: "{{ route('category.get-category') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    className: 'text-center',
                },

                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'edit',
                    name: 'edit',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'delete',
                    name: 'delete',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },

            ]
        });
    });

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


