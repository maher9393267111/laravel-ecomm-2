{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Home Page</title>
</head>
<body>
    
<div>
    <h1 class=" bg-green-200" >  Admin Page</h1>
</div>



</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
  @include("admin.css")
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html 👀👀 -->
    
@include('admin.sidebar')



      <!-- partial  👀👀 -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('admin.header')
        <!-- partial -->
      
{{-- //content --}}
@include('admin.body')


        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
  
@include('admin.script')


  </body>
</html>