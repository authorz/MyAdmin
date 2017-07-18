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

        public function update(array $data = [], $id)
        {
            $that = self::find($id);

            foreach ($data as $key => $value) {
                $that->$key = $value;
            }

            return $that->save();
        }

        public function _list($id)
        {
            $data = self::join('infoclass', 'infolist.classId', '=', 'infoclass.Id')
                ->where('infoclass.Type', '=', $id)
                ->paginate(10);

            return $data;
        }

        public function _find($id = 0)
        {
            return self::find($id)->toArray();
        }

        public function check($id = 0, $check = 0)
        {
            $that = self::find($id);

            $that->check = $check;

            return $that->save();
        }
    }
