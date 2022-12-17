@extends('admin.layouts.layout_main')
@section('content')

  <div>
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
                    <button class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline" value="edit" name="action">Edit</button>
                    <input type="hidden" value="{{$user->id}}" name="id">
                    <button value="delete" name="action" class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>


