<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;

    class InfoStyle extends Model
    {
        protected $table = 'infostyle';

        public function getAll()
        {
            $tree = [];

            $data = self::all()->toArray();

            foreach ($data as $key => $value) {
                $tree[$value['id']] = $value['name'];
            }

            return $tree;
        }
    }
