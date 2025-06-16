<?php

namespace Architecture\User\Controller;

use Architecture\User\Application\UserLoginUseCase;
use Architecture\User\Application\UserLogoutUseCase;
use Architecture\User\Application\UserRegisterUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController
{
    public function __construct(
        protected UserRegisterUseCase $userRegisterUseCase,
        protected UserLoginUseCase $userLoginUseCase,
        protected UserLogoutUseCase $userLogoutUseCase,
    ) {
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $validUser = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $userEntity = $this->userRegisterUseCase->execute($validUser);

            return response()->json([
                'access_token' => $userEntity->token,
            ], 201);
        } catch (ValidationException $validationException) {
            throw $validationException;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'não foi possível realizar o cadastro',
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $validUser = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            $this->userLoginUseCase->setCredentials($validUser['email'], $validUser['password']);

            return response()->json($this->userLoginUseCase->execute());
        } catch (ValidationException $validationException) {
            throw $validationException;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'não foi possível realizar o cadastro',
            ], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $validToken = $request->bearerToken();
            $this->userLogoutUseCase->execute($validToken);

            return response()->json([
                'message' => 'Deslogado com sucesso',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'não foi possível realizar o cadastro',
            ], 500);
        }
    }
}
