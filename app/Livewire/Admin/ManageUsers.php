<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ManageUsers extends Component
{

    use WithPagination;

    public $name, $phone, $email, $password, $role, $position, $requested_position, $userId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->userId ? 'nullable|string|min:8' : 'required|string|min:8',
            'role' => 'required|in:admin,user,manager',
            'position' => 'nullable|string|max:255',
            'requested_position' => 'nullable|string|max:255',
        ];
    }
    public function render()
    {
        return view('livewire.admin.manage-users', [
            'Users' => User::paginate(10),
        ]);
    }


    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'role' => $this->role,
            'position' => $this->position,
            'requested_position' => $this->requested_position,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            $user = User::find($this->userId);
            $user->update($data);
            $this->dispatch('userSaved', message: 'User updated successfully.');
        } else {
            $data['password'] = Hash::make($this->password);
            User::create($data);
            $this->dispatch('userSaved', message: 'User created successfully.');
        }

        $this->resetInput();
    }

    public function edit($id)
    {
        $user = User::find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role = $user->role;
        $this->position = $user->position;
        $this->requested_position = $user->requested_position;
        $this->userId = $user->id;
        $this->password = ''; 
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->requested_position = '';
        $this->role = '';
        $this->position = '';
        $this->userId = null;
    }

    #[On('delete')]
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            session()->flash('message', 'User Deleted Successfully.');
            $this->dispatch('userSaved', message: 'User Deleted Successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {

                // Foreign key constraint violation
                session()->flash('error', 'Cannot delete user. The user is linked to other records.');
                $this->dispatch('userDeleteFailed', message: 'Cannot delete user. The user is linked to other records.');
            } else {
                session()->flash('error', 'Database error occurred.');
                $this->dispatch('userDeleteFailed', message: 'Database error occurred.');
            }

            Log::error('User delete failed (QueryException): ' . $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Unexpected error: ' . $e->getMessage());
            $this->dispatch('userDeleteFailed', message: 'Unexpected error: ' . $e->getMessage());

            Log::error('User delete failed (Exception): ' . $e->getMessage());
        }
    }
}
