@extends('layouts.layout')

@section('content')

@section('content_header')
    @include('partials.title')
@endsection

<div id="content">
    <div class="breadcrumb-area mb-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" onclick="return false;">Nishat</a></li>
                <li class="breadcrumb-item active" aria-current="page">sections</li>
            </ol>
        </nav>
    </div>
    <div class="main-content-area">
        <div class="file-view-area">
            <div class="row">
                <div class="audit-logs">
                    <p class="mb-2 text-primary font-600">Sections</p>
                    <table class="table table-striped section-table">
                        <thead>
                            <tr>
                                <th>Section Name</th>
                                <th>Department</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- create section model -->

<div class="modal fade" id="sectionAddModal" tabindex="-1" aria-labelledby="    exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="section_form" action="" method="post">
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <div class="form-group">
                            <label>Section Name</label>
                            <input required type="text" id="section-name" class="form-control" name="name">

                            <div class="d-none" id='form-section_name'>
                                <span id="error-section_name" style="color: red"></span>
                            </div>

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                         <select required id="company_id" class="form-control" name="company">
                            <option value="" disabled="" selected="">Select location</option>
                            @foreach ($companies as $company)
                             <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="mb-3" id="unit_company">
                        <div class="form-group">
                            <select required id="unit_id" class="form-control" name="unit">
                                <option value="">Select unit</option>
                                <option v-for='unit in units' :value="unit.id">@{{ unit.unit_name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3" id="unit_department">
                        <div class="form-group">
                            <select required id="department_id" class="form-control" name="department">
                                <option value="">Select department</option>
                                <option v-for='department in departments' :value="department.id">@{{ department.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- delete department model -->

<div class="modal fade" id="sectionDelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style=" text-align: left;">
                <p>Are you sure you want to delete section?</p>
                <form id="section_delete" action="" method="post">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <div class="d-none" id='form-fname'><span id="error-fname" style="color: red"></span></div>
                        <input type="hidden" name="sec_id" id="sectionDel">
                        <div class="big" id="textTitle" style="font-size: 2.2rem;"></div>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript">
    /* ---- department list ----  */

    $(function() {
        var table = $('.section-table').DataTable({
            "paging": false,
            "ordering": false,
            "searching": false,
            "info": false,
            // "lengthChange": false
            language: {
                "zeroRecords": " "
            },
            ajax: {
                url: "{!! route('section-table-data') !!}",
                data: function(data) {
                    data.search_grid = $('#search_grid').val()
                },
                method: "get",
            },
            columns: [

                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'department',
                    name: 'department'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });

    });

    /* ---- department sotre ----  */

    $(document).on('submit', '#section_form', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('store-section') }}",
            data: $('#section_form').serialize(),
            success: function(data) {
                if (data.success) {
                    $('#sectionAddModal').modal('hide');
                    $('#section_form')[0].reset();
                    $('.section-table').DataTable().ajax.reload();
                } else {
                    $("#form-section_name").removeClass('d-none');
                    document.getElementById('error-section_name').innerHTML =
                        "Section name already exists.";
                    setTimeout(function() {
                        $('#form-section_name').addClass('d-none');
                    }, 4000);
                }

            },
        });
    });


    /* ---- department delete ----  */

    $(document).on('click', '.delSection', function(e) {
        var name = $(this).data("name");
        $('#sectionDel').val($(this).data("id"));
        $('#textTitle').html('"' + name + '"');
        $('#sectionDelModal').modal('show');
    });

    /* ---- reset department create form ----  */

    $(document).ready(function() {
        $(document).on('shown.bs.modal', '#sectionAddModal', function() {
            $('#section_form')[0].reset();
            $('#section-name').focus();
        });
    });

    $(document).on('change', '#unit_id', function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{ route('get-unit-departments') }}",
            dataType: 'JSON',
            data: {
                unit_id: $(this).val()
            },
            success: function(response) {
                departmentData.departments = response.departments;
            },
        });
    });


    $(document).on('submit', '#section_delete', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('section-delete') }}",
            data: $('#section_delete').serialize(),
            success: function(data) {
                $('#sectionDelModal').modal('hide');
                $('.section-table').DataTable().ajax.reload();
            },
        });
    });

    $(document).on('change', '#company_id', function(e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{ route('get-unit-company') }}",
            dataType: 'JSON',
            data: {
                company_id: $(this).val()
            },
            success: function(response) {
                unitData.units = response.units;
            },
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('search_grid').placeholder = 'Search section..';
    })

    $(document).on('keyup', '#search_grid', function(e) {
        $('.section-table').DataTable().ajax.reload();
    });


    var departmentData = new Vue({

        el: '#unit_department',
        data: {
            departments: ''
        }

    });

    var unitData = new Vue({

        el: '#unit_company',
        data: {
            units: ''
        }

    });
</script>
@endsection
