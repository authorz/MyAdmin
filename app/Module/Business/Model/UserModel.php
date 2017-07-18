<?php
    namespace App\Module\Business\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class UserModel extends Model
    {
        protected $connection = 'madv';

        public function connection()
        {
            return DB::connection($this->connection);
        }

        public function userList()
        {
            $list = $this->connection()->table('user')->get()->toArray();

            foreach ($list as $key => $value) {
                $list[$key] = (array)$value;
            }

            return $list;
        }
    }