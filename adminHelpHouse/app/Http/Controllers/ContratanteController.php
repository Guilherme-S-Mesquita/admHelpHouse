<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Contratante;
use Pusher\Pusher;

class ContratanteController extends Controller
{

    public function indexApi()
    {
        $contratante = Contratante::all();
        return $contratante;
    }

    public function showApi($id)
    {
        $contratante = Contratante::find($id);
        if ($contratante) {
            return response()->json($contratante, 200);
        } else {
            return response()->json(['message' => 'Contratante não encontrado.'], 404);
        }
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
            'cidadeContratante'=> 'required|string',
            'imagemContratante' => 'required|string',
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
              'alert' => 'Cadastro realizado com sucesso!',
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
        $token = $user->createToken('contratante_token')->plainTextToken;

        $pusherAuthData = $this->authorizePusher($user);

        return response()->json([
            'status' => 'Sucesso',
            'message' => 'Seja bem-vindo, ' .  $user->nomeContratante,
             'token' => $token,
             'user'=> $user,
             'pusher_auth' => $pusherAuthData,
        ]);
    }
    protected function authorizePusher($user)
{
    // Aqui você pode definir os dados necessários para autenticação do Pusher
    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        ['cluster' => env('PUSHER_APP_CLUSTER'), 'useTLS' => true]
    );

    // O canal deve ser dinâmico com base no roomId ou outra lógica
    $channelName = request('channel_name');  // Recebido do frontend
    $socketId = request('socket_id'); // Precisa ser enviado pelo front-end

    return $pusher->socket_auth($channelName, $socketId);
}


}



