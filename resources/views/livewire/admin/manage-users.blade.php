<div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Success Message --}}
    <div class="text-center text-green-600 font-bold">{{ session('message') }}</div>

    {{-- User Table --}}
    <div class="flex flex-col gap-6">
        {{-- Title + Add User Button --}}
        <div class="px-10 flex items-center justify-between">
            <flux:heading class="flex items-center gap-2" size="xl">
                All Users
                <flux:badge variant="primary">
                    {{ $Users->total() }}
                </flux:badge>
            </flux:heading>

            {{-- Scroll to Form Button --}}
            <button
                onclick="document.getElementById('User-form').scrollIntoView({ behavior: 'smooth' });"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm"
            >
                + Add User
            </button>
        </div>
<button
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
    class="fixed bottom-6 right-6 z-50 bg-gray-700 hover:bg-gray-900 text-black w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition-all duration-300"
    style="right: 2rem; bottom: 2rem;"
    aria-label="Scroll to top"
    title="Scroll to top">
    <span class="text-2xl">↑</span>
</button>
        <div class="rounded-xl border shadow-sm bg-white overflow-x-auto">
            <div class="px-10 py-8">
                <table class="w-full table-auto border-collapse rounded-xl overflow-hidden text-sm">
                    <thead>
                        <tr class="bg-purple-500 text-white uppercase text-sm">
                            {{-- <th class="p-2 text-center">ID</th> --}}
                            <th class="p-2 text-center">#</th>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Phone</th>
                            <th class="p-2 text-left">Email</th>
                            <th class="p-2 text-center">Role</th>
                            <th class="p-2 text-center">Position</th>
                            <th class="p-2 text-center">Requested Position</th>
                            <th class="p-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Users as $User)
                            <tr class="{{ $loop->even ? 'bg-purple-200' : 'bg-purple-100' }} hover:bg-blue-200 transition duration-200 border-b">
                                {{-- <td class="p-2 text-center">{{ $User->id }}</td> --}}
                                {{-- <td class="p-2 text-center">{{ $loop->iteration }}</td> --}} 
                                <td class="p-2 text-center">{{ ($Users->currentPage() - 1) * $Users->perPage() + $loop->iteration }}</td>
                                <td class="p-2">{{ $User->name }}</td>
                                <td class="p-2">{{ $User->phone }}</td>
                                <td class="p-2">{{ $User->email }}</td>
                                <td class="p-2 text-center">{{ ucfirst($User->role) }}</td>
                                <td class="p-2 text-center">{{ ucfirst($User->position) }}</td>
                                <td class="p-2 text-center">{{ $User->requested_position ?? 'N/A' }}</td>
                                <td class="p-2 text-center space-x-2">
                                    <flux:button wire:click="edit({{ $User->id }})" icon="pencil-square" variant="primary" class="bg-sky-500 text-white rounded-md text-sm" />
                                    <flux:button wire:click="$dispatch('confirmDelete', {{ $User->id }})" icon="trash" variant="danger" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6 flex justify-center">
                    {{ $Users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <br>

    {{-- User Form --}}
    <div id="User-form" class="flex flex-col gap-6">
        <div class="rounded-xl border">
            <br>
            <flux:heading class="px-10" size="xl">{{ $userId ? 'Edit User' : 'Add User' }}</flux:heading>
            <div class="px-10 py-8">
                <form wire:submit.prevent="save" class="space-y-4 mb-6">
                    <div class="grid grid-col-2 gap-4">
                        <flux:input wire:model="name" label="Name" placeholder="User Name"/>
                        <flux:input wire:model="email" label="Email" placeholder="Email Address"/>
                        <flux:input wire:model="password" type="password" label="Password" placeholder="{{ $userId ? 'Leave blank to keep current password' : 'Password' }}"/>

                        {{-- Role dropdown (Fixed to Admin) --}}
                        <div class="flex flex-col">
                            <label for="role" class="font-medium text-sm text-gray-700 mb-1">Role</label>
                            <select wire:model="role" id="role" class="border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                <option value="user">User</option>
                                <option value="educator">Educator</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        {{-- Position dropdown --}}
                        <div class="flex flex-col">
                            <label for="position" class="font-medium text-sm text-gray-700 mb-1">Position</label>
                            <select wire:model="position" id="position" class="border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                                <option value="Super Admin">Super Admin</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Advisor">Academic Advisor</option>
                                <option value="Company">Company</option>
                                <option value="Student">Student</option>
                            </select>
                        </div>
  
                        <flux:input wire:model="requested_position" label="Requested New Position" placeholder="Position" readonly/>

                        <div class="flex justify-start w-full">
                            <flux:button type="submit" variant="primary" icon="paper-airplane" class="mt-6 bg-green-500 text-white rounded-md text-sm">
                                {{ $userId ? 'Edit' : 'Add' }}
                            </flux:button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JS for SweetAlert --}}
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('users$usersaved', function(res) {
                Swal.fire('Success!', res.message, 'success');
            });

            Livewire.on('confirmDelete', function(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This user member will be permanently deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete', { id: id });
                    }
                });
            });
            Livewire.on('userDeleteFailed', e => alert(e.message));
            Livewire.on('users$usersaved', e => alert(e.message));
        });
    </script>
</div>
