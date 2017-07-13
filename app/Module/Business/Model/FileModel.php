<?php
    namespace App\Module\Business\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class FileModel extends Model
    {
        protected $connection = 'madv';

        public function connection()
        {
            return DB::connection($this->connection);
        }

        public function fileList()
        {
            $list = $this->connection()->table('file')->paginate(10);

//            foreach ($list['data'] as $key => $value) {
//                $list['data'][$key] = (array)$value;
//            }

            return $list;
        }
    }