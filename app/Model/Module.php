<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Module extends Model
    {
        protected $table = 'module';

        public $primaryKey = 'Id';

        public $timestamps = false;

        public static function create($data)
        {
            DB::table('module')->insert([
                'ModuleName' => $data['name'],
                'Title' => $data['title'],
                'Author' => $data['author'],
                'Description' => $data['description'],
                'Icon' => 'fa fa-cubes',
                'Type' => 0,
                'InstallTime' => date('Y-m-d H:i:s', time())
            ]);
        }

        public function getAll()
        {
            return self::all();
        }

        public static function moduleId($moduleName)
        {
            $output = DB::table('module')
                ->select('Id')
                ->where('ModuleName', '=', $moduleName)
                ->first();

            return $output;
        }


        public static function getModuleForNode()
        {
            $all = self::all();

            foreach ($all as $key => $value) {
                $tree[] = ['name' => $value->Title, 'url' => '?Module='.$value->Id, 'value' => $value->Id];
            }

            return $tree;
        }
    }
