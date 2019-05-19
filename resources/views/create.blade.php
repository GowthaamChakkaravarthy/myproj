@extends('layout')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>

</div>
@endif


<div class="container" style="margin-left: 500px; margin-top: 30px;">
<div class="col-md-5">

  <form  action="{{action('PostController@store')}}" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" placeholder="Enter Your name" class="form-control">
    </div>
    <div class="form-group">
      <label>Detail</label>
      <input type="text" name="detail" placeholder="Enter your detail" class="form-control">
    </div>
    <div class="form-group">
      <label>Author</label>
      <input type="text" name="author" placeholder="Enter author name" class="form-control">
    </div>
      <input type="submit" class="btn btn-primary">
  </form>
</div>
</div>
@endsection('content')
