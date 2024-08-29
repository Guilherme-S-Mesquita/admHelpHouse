<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;


use Illuminate\Http\Request;
use App\Models\Contratante;
use Validator;



class ContratanteController extends Controller
{



    public function indexApi()
    {
        $contratante = Contratante::all();
        return $contratante;
    }


    public function storeApi(Request $request)
    {

        // Validando o request
        $validatedData = $request->validate([
            'nomeContratante' => 'required|string',
            'cpfContratante' => 'required|string',
            'password' => 'required|string',
            'emailContratante' => 'required|email',
            'telefoneContratante' => 'required|string',
            'ruaContratante' => 'required|string',
            'cepContratante' => 'required|string',
            'numCasaContratante' => 'required|string',
            'complementoContratante' => 'required|string',
            'bairroContratante' => 'required|string',
        ]);

        //Verifica se o usuario existe
        $existingUser = Contratante::where('emailContratante', $validatedData['emailContratante'])->first();

        if ($existingUser) {
            return response()->json([
                'status' => 'Falha',
                'message' => 'Usuário já cadastrado com este e-mail.'
            ], 409); // 409 Conflict
        }

        // Criptografando a senha
        $validatedData['password'] = bcrypt($validatedData['password']);



        // Criando um novo Contratante com os dados validados
        $contratante = Contratante::create($validatedData);

        // Retornando resposta de sucesso com os detalhes do Contratante criado
        return response()->json([
            'status' => 'Deu certinho filho',
            'data' => $contratante
        ], 201); // 201 Created
    }
    public function auth(Request $request)
    {
        $validador = [
            'emailContratante' => 'required|email',
            'password' => 'required|string',
        ];

        $validacao = Validator::make($request->all(), $validador);

        if ($validacao->fails()) {
            return response()->json([
                'status' => 'Falha',
                'message' => $validacao->errors()->all(),

            ]);
        }

        $credenciais = [
            'emailContratante' => $request->input('emailContratante'),
            'password' => $request->input('password'),
        ];

        if (!Auth::guard('contratante')->attempt($credenciais)) {
            return response()->json([
                'status' => 'Falha',
                'message' => 'Login incorreto, tente novamente',
            ]);
        }

        $user = Auth::guard('contratante')->user();
        // $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'Sucesso',
            'message' => 'Seja bem-vindo', $user->nomeContratante,
            // 'token' => $token,
        ]);
    }


}



