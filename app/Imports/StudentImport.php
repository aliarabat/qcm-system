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

class StudentImport implements ToModel
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
        $pwd = $this->random_string();
        $user = new User([
            'last_name'     => $row[0],
            'first_name'     => $row[1],
            'email'    => $row[2],
            'password' => Hash::make($pwd),
        ]);
        $role = Role::where('name', 'STUDENT')->first();
        $user->role()->associate($role);
        $user->save();
        Mail::to($user)->send(new UserCreated($user, $pwd, 'étudiant'));
        return $user;
    }

    public static function random_string($length = 10)
    {
        $characters = array_merge(range('a', 'b'), range('A', 'B'), range('0', '9'));
        $generatedStr = '';
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $generatedStr .= $characters[mt_rand(0, $max)];
        }
        return $generatedStr;
    }
}
