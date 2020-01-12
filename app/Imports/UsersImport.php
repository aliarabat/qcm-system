<?php

namespace App\Imports;

use App\Mail\StudentCreated;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use phpseclib\Crypt\Random;

class UsersImport implements ToModel
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $oldUser = User::where('email', $row[1])->first();
        if (in_array($row[0], ['name', 'nom', 'Name', 'Nom']) | !isset($row[0]) | isset($oldUser)) {
            return null;
        }
        $pwd = $this->random_string();
        $user = new User([
            'name'     => $row[0],
            'email'    => $row[1],
            'password' => Hash::make($pwd),
        ]);
        $role = Role::where('name', 'STUDENT')->first();
        $user->role()->associate($role);
        $user->save();
        Mail::to($user)->send(new StudentCreated($user, $pwd));
        return $user;
    }

    public function random_string($length=10){
        $characters=array_merge(range('a', 'b'), range('A', 'B'), range('0', '9'));
        $generatedStr='';
        $max=count($characters)-1;
        for ($i=0; $i < $length; $i++) { 
            $generatedStr.=$characters[mt_rand(0, $max)];
        }
        return $generatedStr;
    }
}