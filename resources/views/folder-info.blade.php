@extends('layouts.layout')
@section('content')
@section('content_header')
@include('partials.title')
@endsection
               
<!-- Page Content  -->
<div id="content">
    <div class="breadcrumb-area mb-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" onclick="return false;">{{Auth::user()->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">index</li>
                <li class="breadcrumb-item"><a href="{{route('folder-information', 1)}}">{{$id == 1 ? 'folder' : 'files'}}</a></li>
            </ol>
        </nav>
    </div>

{{--<div class="summary-section">
    <div class="summary-item">
        <span class="badge bg-primary">Total Folders: {{ $sections->count() }}</span>
    </div>
    <div class="summary-item">
        <span class="badge bg-secondary">Total Subfolders: {{ $totalSubFolder }}</span>
    </div>
    <div class="summary-item">
        <span class="badge bg-success">Total Files: {{ $totalFiles }}</span>
    </div>
</div>--}}
 <span class="badgee d-inline-flex align-items-center">
  <i class="fas fa-folder me-2" style="font-size: 1.5rem; color: #1ea1d7;"></i>
  {{$sections->count() }}
</span>

    <div class="main-content-area">
        <div class="main-section">
          

            @foreach($sections as $section)
               <div class="dashbord email-content">
                   <div class="title-section">
                       <strong>{{$section->description}}</strong>
                   </div>

                   <div class="icon-text-section">
                        <div class="icon-section">
                            <i class="fa fa-folder" style="font-size: 18px;"></i> <!-- Smaller icon -->
                        </div>
                        <div class="text-section">
                            <h1>{{$section->children->count()}}</h1> <!-- Smaller text size for count -->
                            <span>Main Folders</span> <!-- Smaller text for label -->
                        </div>
                        <div style="clear:both;"></div>
                    </div>

                    <div class="icon-text-section">
                        <div class="icon-section">
                            <i class="fa fa-folder-open" style="font-size: 18px;"></i> <!-- Smaller icon -->
                        </div>
                        <div class="text-section">
                            <h1>{{$section->grandchildren()->count()}}</h1> <!-- Smaller text size for count -->
                            <span>Subfolders</span> <!-- Smaller text for label -->
                        </div>
                        <div style="clear:both;"></div>
                    </div>

                    <div class="icon-text-section">
                        <div class="icon-section">
                            <i class="fa fa-file" style="font-size: 18px;"></i> <!-- Smaller icon -->
                        </div>
                        <div class="text-section">
                            <h1>{{$section->countAllFiles()}}</h1> <!-- Smaller text size for count -->
                            <span>Total Files</span> <!-- Smaller text for label -->
                        </div>
                        <div style="clear:both;"></div>
                    </div>


                   <!-- View Detail Link -->
                   <div class="detail-section">
                       <a href="{{route('folder-index', $section->id)}}">
                           <p>View Detail</p>
                           <i class="fa fa-arrow-right" aria-hidden="true"></i>
                       </a>
                   </div>
               </div>
            @endforeach
        </div>
    </div>

    <style>
        .main-section {
            width: 90%; /* Adjusted width for a smaller layout */
            margin: 0 auto;
        }
        .dashbord {
            margin-top: 15px; /* Reduced top margin */
            margin-right: 10px;
            display: inline-block;
            width: 22%; /* Reduced width for smaller size */
            color: #959595;
            border-radius: 3px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: adds slight shadow for better visual separation */
        }
        .title-section {
            border-radius: 5px 5px 0px 0px;
            text-align: center;
            background-color: #1ea1d7; /* Updated background color */
            color: #fff; /* White text color */
            padding: 7px 0px;
        }
        .icon-text-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #f1f1f1;
    padding: 3px 8px;  /* Reduced padding for all sections */
}

.icon-section {
    font-size: 18px; /* Smaller icon size for all icons */
    color: #c7c7c7;
}

.text-section {
    flex: 1;
    text-align: right;
}

.text-section h1 {
    margin: 0;
    font-size: 18px; /* Smaller size for count in all sections */
}

.text-section span {
    font-size: 12px;  /* Smaller font size for the label in all sections */
    color: #777;
}

        .detail-section {
            background-color: #b3b3b3;
            cursor: pointer;
            border-radius: 0px 0px 5px 5px;
        }
        .detail-section a {
            color: #fff;
        }
        .detail-section a p {
            display: inline-block;
            margin: 0px;
            font-size: 12px;
            padding: 8px 12px; /* Adjusted padding */
        }
        .detail-section a i {
            float: right;
            padding: 8px 5px 0px 0px;
        }
        .dashbord .detail-section:hover {
            background-color: #d9d9d9;
        }


        .summary-section {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 20px;
}

.summary-item {
    display: inline-block;
}



#content > div.main-content-area {
    height: 350px; /* Set a fixed height for the scrollable area */
    overflow-y: auto; /* Enable vertical scrolling */
    margin-top: 10px; /* Small margin from the top */
    margin-bottom: 10px; /* Small margin from the bottom */
    margin-left: 10px; /* Add a small margin on the left */
    margin-right: 10px; /* Add a small margin on the right */
    padding-right: 15px; /* Add padding for the scrollbar */
    border: 1px solid #d7d7d7;
}

/* Custom Scrollbar Styling */
#content > div.main-content-area::-webkit-scrollbar {
    width: 8px; /* Width of the scrollbar */
}

#content > div.main-content-area::-webkit-scrollbar-thumb {
    background-color: #1ea1d7; /* Background color of the scrollbar */
    border-radius: 10px; /* Rounded corners */
    border: 2px solid #ffffff; /* Optional: border for better contrast */
}

#content > div.main-content-area::-webkit-scrollbar-track {
    background-color: rgba(0, 0, 0, 0.1); /* Light background for the scrollbar track */
    border-radius: 10px;
}


    </style>
</div>
@endsection

<script type="text/javascript">
    // Add additional JavaScript if needed
</script>
