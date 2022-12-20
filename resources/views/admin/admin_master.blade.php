@extends('admin.layouts.layout_main')
@section('content')
<form action="" method="GET">
  <div class="flex flex-row">
    <div class="mb-4 mx-10 my-6 w-10/12">
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="search" value="{{old('search')}}" type="text" placeholder="Search Name">
    </div>
    <div class="mb-4 my-6">
      <button class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-3 py-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline" type="submit">
        Search
      </button>
    </div>
  </div>
</form>

  <div class="float-right">
    <a href="{{route('add_user')}}"><button class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
       Tambah User
   </button></a>
 </div>
  <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
    <div class="overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-white border-b p-8">
          <tr class="py-8 text-left">
            <th>Name</th>
            <th>Email</th>
            <th>Occupational Status</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
          @foreach ($users as $user)
            <tr class="border-y-2">
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>
                @if ($user->occupational_status == 0)
                  Pelajar
                @elseif ($user->occupational_status == 1)
                  Mahasiswa
                @elseif ($user->occupational_status == 2)
                  Pekerja
                @elseif ($user->occupational_status == 3)
                  Yang lainnya
                @endif
              </td>
              <td>
                @if ($user->role == 0)
                  User
                @else
                  Admin
                @endif
              </td>
              <td>
                <form action="" method="POST" class="w-full">
                  @csrf
                  @if ($user->banned)
                  <button class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">Unban</button>
                  @else
                  <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">Ban</button>
                  @endif
                  <input type="hidden" value="{{$user->id}}" name="id">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

