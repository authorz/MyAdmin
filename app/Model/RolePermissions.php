<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class RolePermissions extends Model
{
    protected $table = 'rolepermissions';

    public $timestamps = false;

    public function bindPermissions(array $permissionData, int $roleId) : bool
    {
        DB::beginTransaction();

        $tree = [];

        $isset = self::where('RoleId', $roleId)->get()->toArray();

        foreach ($isset as $item) {
            array_push($tree, $item['PermissionID']);
        }

        foreach ($permissionData as $value) {

            if (!in_array($value, $tree)) {

                $role = new RolePermissions();

                $role->RoleId = $roleId;
                $role->PermissionID = $value;
                $role->AssignmentDate = time();

                $role->save();
            }
        }

        $diff = array_diff($tree, $permissionData);

        if (count($diff) > 0) {
            foreach ($diff as $value) {
                if (!in_array($value, $permissionData)) {
                    self::where('RoleId', $roleId)->where('PermissionID', $value)->delete();
                }

            }

        }

        DB::commit();

        return true;
    }

    public function getPermissions(int $roleId) : array
    {
        $tree = [];

        $output = self::where('RoleId', $roleId)->get();

        if ($output) {
            $result = $output->toArray();

            foreach ($result as $value) {
                array_push($tree, $value['PermissionID']);
            }

            return $tree;

        } else {
            return [];
        }
    }
}
