<?php
namespace App\Controllers;

use Core\Request;
use Core\Response;
use Core\JWTHandler;
use App\Models\UserModel;
use App\Controllers\BaseController;

class AuthController extends BaseController{
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel($this->DB());
    }

    public function login(Request $request) {
        $email = $request->getParam('email') ?? '';
        $userEntity = $this->userModel->findByEmail($email);

        if ($userEntity) {
            $user = $userEntity->toArray();
            $jwtHandler = new JWTHandler();
            $payload = [
                'id' => $user['id'], 
                'email' => $user['email'],
                'role_id' => $user['role_id']
            ];
            $token = $jwtHandler->generateToken($payload);        
            
            $responeData = [
                'token' => $token,
                'user' => $user
            ];
            
            Response::json(200, $responeData, 'Đăng nhập thành công');
        } else {
            Response::json(401, null, 'Email không đúng');
        }
    }
}
