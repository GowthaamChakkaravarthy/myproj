@extends('layout')

@section('content')

@if($message=Session::get('success'))
<div class="alert alert-success">
  <p>{{$message}}</p>
</div>
@endif

<div class="row">
  <div class="col-md-4" >
    <h1>Rck Str Work</h1>
  </div>
  <div class="col-md-4" style="margin-top:10px!important;">
    <a href="{{action('PostController@create')}}" class="btn btn-primary">Add</a>
  </div>
  <div class="col-md-4" style="margin-top: 10px;">
      <form action="/search" method="get">
         <div class="input-group">
           <input class="form-control" type="text" name="search" placeholder=" Search Here. . ">
            <span class="input-group-prepend">
           <button type="submit" class="btn btn-primary">Search</button></span>
         </div>

      </form>
  </div>
</div>
<form  action="/deleteall" method="post">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete All</button>
<div class="table table-responsive">
  <table class="table table-bordered" width="500px">
      <thead>
        <tr>
          <th><input type="checkbox" class="selectall"</th>
          <th>Name</th>
          <th>Detail</th>
          <th>Author</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        @foreach($posts as $post)
        <tr>

          <td><input type="checkbox" name="ids[]" class="selectbox" value="{{$post->id}}">{{$no++}}</td>
          <td>{{$post->name}}</td>
          <td>{{$post->detail}}</td>
          <td>{{$post->author}}</td>
          <td>
             <a href="{{action('PostController@show', $post->id)}}" class="btn btn-primary">Show</a>
              <a href="{{action('PostController@edit', $post->id)}}" class="btn btn-warning">Edit</a>
              <button formaction="{{action('PostController@destroy', $post->id)}}" type="submit"class="btn btn-danger">Delete</button>
           </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th><input type="checkbox" class="selectall2"</th>
          <th>Name</th>
          <th>Detail</th>
          <th>Author</th>
          <th>Action</th>
        </tr>
      </tfoot>
  </table>
</div>
</form>
<center>
{{$posts->links()}}
</center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $('.selectall').click(function(){
    $('.selectbox').prop('checked',$(this).prop('checked'));
    $('.selectall2').prop('checked',$(this).prop('checked'));
  });
  $('.selectall2').click(function(){
    $('.selectbox').prop('checked',$(this).prop('checked'));
    $('.selectall').prop('checked',$(this).prop('checked'));
  });
  $('.selectbox').change(function(){

    var total=$('.selectbox').length;
    var number=$('.selectbox:checked').length;
    if (total==number) {
      $('.selectall').prop('checked',true);
      $('.selectall2').prop('checked',true);
    }else {
      $('.selectall').prop('checked',false);
      $('.selectall2').prop('checked',false);
    }
  })
</script>

@endsection('content')
