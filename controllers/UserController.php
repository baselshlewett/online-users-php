<?php 

namespace Controllers;

use Controllers\Controller;

use Models\User;

class UserController extends Controller
{
    public function login(object $request): mixed
    {
        $email = "";
        $name = "";

        // TODO: Move this to a validator class
        if (empty($request->email)) {
            return json(["status" => 404, "message" => "invalid-email"]);
        } else {
            $email = $request->email;
        }

        // TODO: Move this to a validator class
        if (empty($request->name)) {
            return json(["status" => 404, "message" => "invalid-name"]);
        } else {
            $name = $request->name;
        }

        $userModel = new User();

        if ($user = $userModel->find('email', $email)) {
            $user->updated_at = date('Y-m-d H:i:s');
            $user->visits_count = $user->visits_count + 1;
        } else {
            $user = new User();
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            $user->email = $email;
            $user->visits_count = 1;
        }

        $user->name = $name;
        $user->user_agent = $_SERVER["HTTP_USER_AGENT"];
        $user->entry_time = date('Y-m-d H:i:s');
        $user->user_ip = $_SERVER['REMOTE_ADDR'];
        $user->is_online = 1;
        

        $userModel->fill($user);
        $userModel->save();

        return json($user);
    }

    public function logout(object $request): mixed
    {
        $email = "";

        // TODO: Move this to a validator class
        if (empty($request->email)) {
            return json(["status" => 404, "message" => "invalid-email"]);
        } else {
            $email = $request->email;
        }

        $userModel = new User();

        if ($user = $userModel->find('email', $email)) {
            $user->is_online = 0;
            $userModel->fill($user);
            $userModel->save();

            return json($userModel->getData());
        }

        return json(["status" => 400, "Failed to update user"]);
    }

    public function get(): mixed 
    {
        $email = "";

        // TODO: Move this to a validator class
        if (empty($_GET['email'])) {
            return json(["status" => 404, "message" => "invalid-user-id"]);
        } else {
            $email = $_GET['email'];
        }

        $userModel = new User();

        return json($userModel->find('email', $email));
    }

    public function online(): mixed
    {
        $userModel = new User();
        // dd(array_values($userModel->findAll('is_online', 1)));
        return json(array_values($userModel->findAll('is_online', 1)));
    }

    public function updateOnline(object $request): mixed 
    {
        $email = "";
        
        // TODO: Move this to a validator class
        if (empty($request->email)) {
            return json(["status" => 404, "message" => "invalid-email"]);
        } else {
            $email = $request->email;
        }

        $userModel = new User();

        if ($user = $userModel->find('email', $email)) {
            $user->updated_at = date('Y-m-d H:i:s');
            $user->is_online = 1;
            $userModel->fill($user);
            $userModel->save();
            return json($userModel->getData());
        }

        return json(["status" => 400, "Failed to update user"]);
    }
}