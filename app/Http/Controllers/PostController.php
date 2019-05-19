<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->paginate(3);
        return view('index',['posts'=> $posts]);
    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
      $request->validate([
        'name'=>'required',
        'detail'=>'required',
        'author'=>'required'
      ]);
      $name=$request->get('name');
      $detail=$request->get('detail');
      $author=$request->get('author');
      $posts=DB::insert('insert into posts(name,detail,author) values(?,?,?)',[$name,$detail,$author]);
          if ($posts) {
            $red =redirect('posts')->with('success','Data has been added');
          }else {
            $red =redirect('posts/create')->with('danger','Data has been failed');
          }
          return $red;
    }
    public function show($id){
      $posts = DB::select('Select * from posts where id=?',[$id]);
      return view('show',['posts'=> $posts]);
    }
    public function edit($id){
      $posts = DB::select('Select * from posts where id=?', [$id]);
      return view('edit',['posts'=> $posts]);

    }
    public function update(Request $request, $id){
      $request->validate([
        'name'=>'required',
        'detail'=>'required',
        'author'=>'required'
      ]);
      $name=$request->get('name');
      $detail=$request->get('detail');
      $author=$request->get('author');
      $posts= DB::update('update posts set name=?, detail=?, author=? where id=?',[$name,$detail,$author,$id]);
          if ($posts) {
            $red =redirect('posts')->with('success','Update data has been added');
          }else {
            $red =redirect('posts/edit'.$id)->with('danger','Failed data has been failed');
          }
          return $red;
    }
    public function destroy($id){
        $posts =DB::delete('Delete from posts where id=?',[$id]);
        $red =redirect('posts');
        return $red;
    }
    public function search(Request $request){
      $search=$request->get('search');
      $posts=DB::table('posts')->where('name','like','%'.$search.'%')->paginate(3);
      return view('index',['posts'=>$posts]);
    }
    public function deleteAll(Request $request){
        $ids=$request->get('ids');
        $posts =DB::delete('Delete from posts where id in ('.implode(",",$ids).')');
        $red =redirect('posts');
        return $red;
    }
}
