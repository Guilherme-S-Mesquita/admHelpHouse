<?php

namespace App\Http\Controllers;
use Auth;
use Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profissional;




class ProfissionalApiController extends Controller
{

    public function indexApiPro()
    {

        $profissionais = Profissional::all();
        return $profissionais;

    }

    public function storeApiPro(Request $request)
    {




        // Validação dos campos recebidos no request
        $validadeDataPro = $request->validate([
            'nomeContratado' => 'required|string',
            'sobrenomeContratado' => 'required|string',
            'cpfContratado' => 'required|string',
            'password' => 'required|string',
            'emailContratado' => 'required|email|string',
            'profissaoContratado' => 'required|string',
            'telefoneContratado' => 'required|string',
            'descContratado' => 'nullable|string',
            'nascContratado' => 'required|date',
            'ruaContratado' => 'required|string',
            'cepContratado' => 'required|string',
            'bairroContratado' => 'required|string',
            'numCasaContratado' => 'required|string',
            'complementoContratado' => 'nullable|string',


        ]);


        $existingPro = Profissional::where('emailContratado', $validadeDataPro['emailContratado'])->first();



        if ($existingPro) {
            return response()->json([
                'status' => 'Falha',
                'message' => 'Algum profissional já foi cadastrado com este e-mail.'
            ], 409); // 409 Conflict
        }


        $validadeDataPro['password'] = bcrypt($validadeDataPro['password']);


        $profissional = Profissional::create($validadeDataPro);

        return response()->json([
            'status' => 'Cadastro realizado com sucesso',
            'alert' => 'Cadastro realizado com sucesso!',
            'data' => $profissional
        ], 201); // 201 Created

    }




    public function authPro(Request $request)
    {
        $validador = [
            'emailContratado' => 'required|email',
            'password' => 'required|string',
        ];

        $validacao = Validator::make($request->all(), $validador);

        if ( $validacao->fails()){
            return response()->json( [
                'status'=> 'Falha ao validar o cadastro',
                'message' => $validacao->errors()->all(),
            ]);
        }

        $credenciais= [
            'emailContratado' => $request->input('emailContratado'),
            'password' => $request->input('password'),
        ];


        if (!Auth::guard('profissional')->attempt($credenciais)) {
            return response()->json([
                'status' => 'Falha',
                'message' => 'Login incorreto, tente novamente',
            ]);
        }

        $userPro = Auth::guard('profissional')->user();

        return response()->json([
            'status' => 'Sucesso',
            'message' => 'Seja bem-vindo', $userPro->nomeContratado,
            // 'token' => $token,
        ]);
    }
}
