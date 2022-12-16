@extends('admin.layouts.layout_main')
@section('content')
<div>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Occupational Status</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
    @foreach ($users as $user)
      <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->occupational_status}}</td>
        <td>{{$user->role}}</td>
        <td>
          <button>Edit</button>
          <form action="" method="POST">
            @csrf
            <input type="hidden" value="{{$user->id}}" name="id">
            <button type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</div>
