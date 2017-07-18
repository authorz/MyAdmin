<?php

    namespace App\Http\Controllers\Action;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Model\User;

    class UserController extends Controller
    {
        protected $userModel;

        public function __construct()
        {
            $this->userModel = new User();
        }

        public function modifyEmail(Request $request)
        {
            $result = $this->userModel->modifyEmail($request->input('side-profile-email'));

            if ($result) {
                return response()->json(['message' => '修改成功', 'code' => 200, 'return' => []]);
            } else {
                return response()->json(['message' => '修改失败', 'code' => 0, 'return' => []]);
            }
        }

        public function getEmail()
        {
            $email = $this->userModel->getEmail();

            return response()->json(['message' => '成功', 'code' => 200, 'return' => ['Email' => $email]]);
        }

        public function modifyPass()
        {

        }

        public function selectTheme(Request $request)
        {
            dd($request->all());
        }
    }
