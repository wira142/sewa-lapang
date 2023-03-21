<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use BadMethodCallException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses; // helper handle response
    public function __construct(User $User)
    {
        $this->userModel = $User;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $validated = $request->only(['username', 'password', 'email', 'phone', 'gender', 'address']);
            $validated["password"] = Hash::make($request->password);
            $user = $this->userModel->register($validated);

            return $this->success("user successfully registered", [
                "user" => $user->username,
                // "token" => $user->createToken("token of " . $user->username)->plainTextToken
                // belum ada kegunaan token saat sudah register.
            ]);
        } catch (ModelNotFoundException $th) {
            return $this->error("Model error: " . $this->customMessage($th, "some part is not found!"));
        } catch (BadMethodCallException $th) {
            return $this->error("Method error: " . $this->customMessage($th, "unavailable action!"));
        } catch (QueryException $th) {
            return $this->error("Query error: " . $this->customMessage($th, "something wrong with syntax!"));
        } catch (\Exception $th) {
            return $this->error("General error: " . $this->customMessage($th, "Something wrong in system!"));
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $user = $this->userModel->checkAccount($request->login, $request->password);
            if (is_null($user)) {
                return $this->error("Invalid login or password!", 401);
            } else {
                if (Gate::check("isAdmin", $user)) {
                    $token = $user->createToken('token_of_' . $user['username'], ['admin'])->plainTextToken;
                } else {
                    $token = $user->createToken('token_of_' . $user['username'], ["user"])->plainTextToken;
                }
                return $this->success("login is success", [
                    "username" => $user['username'],
                    "token" => $token
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return $this->error("Model error: " . $this->customMessage($th, "some part is not found!"));
        } catch (BadMethodCallException $th) {
            return $this->error("Method error: " . $this->customMessage($th, "unavailable action!"));
        } catch (QueryException $th) {
            return $this->error("Query error: " . $this->customMessage($th, "something wrong with syntax!"));
        } catch (\Exception $th) {
            return $this->error("General error: " . $this->customMessage($th, "Something wrong in system!"));
        }
    }
    public function logout()
    {
        try {
            if (Auth::user()->currentAccessToken()->delete()) {
                return $this->success("logout is success!", []);
            } else {
                return $this->error("logout is failed!");
            }
        } catch (ModelNotFoundException $th) {
            return $this->error("Model error: " . $this->customMessage($th, "some part is not found!"));
        } catch (BadMethodCallException $th) {
            return $this->error("Method error: " . $this->customMessage($th, "unavailable action!"));
        } catch (QueryException $th) {
            return $this->error("Query error: " . $this->customMessage($th, "something wrong with syntax!"));
        } catch (\Exception $th) {
            return $this->error("General error: " . $this->customMessage($th, "Something wrong in system!"));
        }
    }
}
