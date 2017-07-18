<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Info extends Model
    {
        public $table = 'info';

        public function editInfo($id, $content)
        {
            $that = new self;

            $exist = self::where('classId', '=', $id)->first();

            if ($exist) {
                DB::table('info')->where('classId', '=', $id)->update([
                    'content' => $content
                ]);
            } else {

                $that->classId = $id;

                $that->content = $content;

                $that->save();

            }

            return true;
        }

        public function getInfo($id)
        {
            return DB::table('info')->where('classId', '=', $id)->first();
        }
    }
