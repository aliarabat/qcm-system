<?php

namespace App\Imports;

use App\Mail\StudentCreated;
use App\Mail\UserCreated;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class ProfessorImport implements ToModel
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $oldUser = User::where('email', $row[2])->first();
        if (in_array($row[0], ['nom', 'Nom']) | !isset($row[0]) | isset($oldUser)) {
            return null;
        }
        $pwd = StudentImport::random_string();
        $user = new User([
            'last_name'     => $row[0],
            'first_name'     => $row[1],
            'email'    => $row[2],
            'password' => Hash::make($pwd),
        ]);
        $role = Role::where('name', 'PROFESSOR')->first();
        $user->role()->associate($role);
        $user->save();
        Mail::to($user)->send(new UserCreated($user, $pwd, 'professeur'));
        return $user;
    }
}
