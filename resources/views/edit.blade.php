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
@foreach($posts as $post)
  <form  action="{{action('PostController@update',$post->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" placeholder="Enter Your name" class="form-control" value="<?php echo $post->name; ?>">
    </div>
    <div class="form-group">
      <label>Detail</label>
      <input type="text" name="detail" placeholder="Enter your detail" class="form-control" value="{{$post->detail}}">
    </div>
    <div class="form-group">
      <label>Author</label>
      <input type="text" name="author" placeholder="Enter author name" class="form-control"  value="{{$post->author}}">
    </div>
      <input type="submit" class="btn btn-primary">
      <a href="{{action('PostController@index')}}" class="btn btn-primary">Back</a>
  </form>
  @endforeach
</div>
</div>
@endsection('content')
