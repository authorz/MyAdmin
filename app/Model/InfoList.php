<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class InfoList extends Model
    {
        protected $table = "infolist";

        public function add(array $data = [])
        {
            $that = new self;

            foreach ($data as $key => $value) {
                $that->$key = $value;
            }

            return $that->save();
        }

        public function _list()
        {
            return self::paginate(10);
        }

        public function _find(int $id = 0)
        {
            return self::find($id)->toArray();
        }
    }
