@extends('layouts.layout')
@section('content')
@section('content_header')
@include('partials.title')
@endsection
               
<!-- Page Content  -->
<div id="content">
    <div class="breadcrumb-area mb-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

        </nav>
    </div>

 <span class="badgee d-inline-flex align-items-center">
  <i class="fas fa-folder me-2" style="font-size: 1.5rem; color: #1ea1d7;"></i>
</span>

    <div class="main-content-area">
        <div class="main-section">
          

            <div class="container">
  <h3>Switch to Other Company</h3>

  <div class="mb-3">
    <label for="company">Company</label>
    <select id="company" class="form-select">
        <option value="">Select Company</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}" 
                @if($company->id == Auth::user()->company_id) selected @endif>
                {{ $company->company_name }}
            </option>
        @endforeach
    </select>
</div>

  <div class="mb-3">
    <label for="unit">Operating Unit</label>
    <select id="unit" class="form-select">
        <option value="">Select Unit</option>
        @foreach($units as $unit)
            <option value="{{ $unit->id }}" 
                @if($unit->id == Auth::user()->company_branch_id) selected @endif>
                {{ $unit->unit_name }}
            </option>
        @endforeach
    </select>
</div>

  <div class="mb-3">
    <label for="department">Department</label>
    <select id="department" class="form-select">
        <option value="">Select Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" 
                @if($department->id == Auth::user()->department_id) selected @endif>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
</div>

  <div class="mb-3">
    <label for="section">Section</label>
    <select id="section" class="form-select">
        <option value="">Select Section</option>
        @foreach($sections as $section)
            <option value="{{ $section->id }}" 
                @if($section->id == Auth::user()->section_id) selected @endif>
                {{ $section->name }}
            </option>
        @endforeach
    </select>
</div>

  <button id="switchBtn" class="btn btn-primary">Switch</button>
</div>


        </div>
    </div>

    <style>
       


    </style>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

    $(document).on('change', '#company', function(){
        var companyId = $(this).val();
        if(companyId){
            $.get('/get-units/' + companyId, function(data){
                $('#unit').empty().append('<option value="">Select Unit</option>');
                $.each(data, function(index, unit){
                    $('#unit').append('<option value="'+unit.id+'">'+unit.unit_name+'</option>');
                });
                $('#unit').prop('disabled', false);

                $('#department').empty().append('<option value="">Select Department</option>').prop('disabled', true);
                $('#section').empty().append('<option value="">Select Section</option>').prop('disabled', true);
            });
        }
    });

    $(document).on('change', '#unit', function(){
        var unitId = $(this).val();
        if(unitId){
            $.get('/get-departments/' + unitId, function(data){
                $('#department').empty().append('<option value="">Select Department</option>');
                $.each(data, function(index, dept){
                    $('#department').append('<option value="'+dept.id+'">'+dept.name+'</option>');
                });
                $('#department').prop('disabled', false);

                $('#section').empty().append('<option value="">Select Section</option>').prop('disabled', true);
            });
        }
    });

    $(document).on('change', '#department', function(){
        var deptId = $(this).val();
        if(deptId){
            $.get('/get-sections/' + deptId, function(data){
                $('#section').empty().append('<option value="">Select Section</option>');
                $.each(data, function(index, sec){
                    $('#section').append('<option value="'+sec.id+'">'+sec.name+'</option>');
                });
                $('#section').prop('disabled', false);
            });
        }
    });

});


$(document).on('click', '#switchBtn', function(){
    var companyId = $('#company').val();
    var unitId = $('#unit').val();
    var departmentId = $('#department').val();
    var sectionId = $('#section').val();

    if(companyId && unitId && departmentId && sectionId){
        $.ajax({
            url: '/switch/user-company',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                company_id: companyId,
                unit_id: unitId,
                department_id: departmentId,
                section_id: sectionId
            },
            success: function(response){
                if(response.status == 'success'){
                    alert('Switched Successfully!');
                    location.reload(); // ya kisi aur page par redirect karwana chaho to
                } else {
                    alert('Failed to switch');
                }
            }
        });
    } else {
        alert('Please select all fields.');
    }
});

</script>
