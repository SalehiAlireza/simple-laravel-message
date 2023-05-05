<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createPermissions();

        $this->createUserAndTickets();

        $this->attachPermissionUser();

        $this->doingSyncData();
    }

    private function createPermissions(): void
    {
        // Always id of ceo is 1
        $permissions = [
            1 => ['key' => 'ceo', 'text' => 'مدیر عامل'],
            2 => ['key' => 'user', 'text' => 'کاربر معمولی'],
            3 => ['key' => 'supervisor', 'text' => 'سرپرست']
        ];
        foreach ($permissions as $permission) {
            if (Permission::count('id') >= count($permissions))
                break;

            Permission::factory()->state([
                'name' => $permission['key'],
                'farsi_name' => $permission['text']
            ])->create();
        }
    }

    private function createUserAndTickets(): void
    {
        \App\Models\User::factory(10)
            ->has(Ticket::factory(2))
            ->create();
    }

    private function attachPermissionUser(): void
    {
        $permission = Permission::all();
        User::all()->each(function (User $user) use ($permission) {
            $permission_id = $permission->where('id',random_int(2,3))->first();
            $permission_id = $permission_id->id;

            // Always first user with id 1 is ceo with id 1
            if ($user->id == 1) {
                $permission_id = 1;
            }

            $user->permissions()->sync([
                'permission_id' => $permission_id,
            ]);
        });
    }

    private function doingSyncData()
    {
        $tickets = Ticket::with('user')->get();
        foreach ($tickets as $ticket)
        {
                $user = $ticket->user()->first();

                $ticket->supervisor_id = $user->hasThisPermission('supervisor') ?
                    $ticket->user_id : null;

                $ticket->ceo_id = $user->hasThisPermission('ceo') ?
                    $ticket->user_id : null;

                if ($ticket->ceo_id || $ticket->supervisor_id)
                    $ticket->save();
        }
    }
}
