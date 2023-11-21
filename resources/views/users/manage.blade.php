<x-layout>
  
    {{-- Cards Displaying User Counts --}}
    <div class="flex flex-wrap -m-2 mb-6">
      <div class="w-full sm:w-1/2 md:w-1/4 p-2">
        <div class="bg-white rounded shadow p-4 text-center">
          <div class="text-lg font-semibold">Total Users</div>
          <div class="text-xl font-bold">{{ $totalUsers }}</div>
        </div>
      </div>
      <div class="w-full sm:w-1/2 md:w-1/4 p-2">
        <div class="bg-white rounded shadow p-4 text-center">
          <div class="text-lg font-semibold">Admin Users</div>
          <div class="text-xl font-bold">{{ $adminUsers }}</div>
        </div>
      </div>
      <div class="w-full sm:w-1/2 md:w-1/4 p-2">
        <div class="bg-white rounded shadow p-4 text-center">
          <div class="text-lg font-semibold">HR Users</div>
          <div class="text-xl font-bold">{{ $hrUsers }}</div>
        </div>
      </div>
      <div class="w-full sm:w-1/2 md:w-1/4 p-2">
        <div class="bg-white rounded shadow p-4 text-center">
          <div class="text-lg font-semibold">Normal Users</div>
          <div class="text-xl font-bold">{{ $normalUsers }}</div>
        </div>
      </div>
    </div>


  <div class="bg-gray-50 border border-gray-200 p-5 rounded">
    <header>
      <h1 class="text-3xl text-center font-bold my-6 uppercase">
        Manage Users
      </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
      <tbody>
        @unless($users->isEmpty())

        @foreach($users as $user)

        <tr class="border-gray-300">
          <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
            {{ $user->name }}
          </td>
          <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
            {{ $user->email }}
          </td>
          <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
            <!-- Dropdown for changing user role -->
            <form method="POST" action="/users/{{$user->id}}/role">
              @csrf
              @method('PATCH')
              <div class="inline-block relative w-40">
                <select name="role" onchange="this.form.submit()" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                  <option value="normal" {{ $user->role == 'normal' ? 'selected' : '' }}>Normal User</option>
                  <option value="HR" {{ $user->role == 'HR' ? 'selected' : '' }}>HR</option>
                  <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M5.516 7.548c.436 0 .84.28.993.683l.007.02 1.55 4.667c.089.27.28.449.532.449s.443-.179.532-.449l1.55-4.667c.154-.403.558-.683.994-.683h.501L10 11.386 5.516 7.548h.501zm-.501 1.22l2.483 2.109-2.483 2.111v-4.22z"/>
                  </svg>
                </div>
              </div>
            </form>
            
          </td>
          <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
            <!-- Delete User -->
            <form method="POST" action="/users/{{$user->id}}">
              @csrf
              @method('DELETE')
              <button class="text-red-500">
                <i class="fa-solid fa-trash-can"></i>
                Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach

        @else
        <tr class="border-gray-300">
          <td class="px-4 py-4 border-t border-b border-gray-300 text-lg">
            <p class="text-center">No Users Found </p>
          </td>
        </tr>
      @endunless 
      </tbody>
    </table>
    {{-- Pagination --}}
    <div class="mt-4">
      {{ $users->links() }}
  </div>
  </div>
</x-layout>
