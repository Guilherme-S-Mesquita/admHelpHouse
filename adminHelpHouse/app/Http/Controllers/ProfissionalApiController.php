<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
            'regiaoContratado' => 'required|string',
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

    public function showApi($id)
    {
        $profissional = Profissional::find($id);
        if ($profissional) {
            return response()->json($profissional, 200);
        } else {
            return response()->json(['message' => 'Contratante não encontrado.'], 404);
        }
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
        $token = $userPro->createToken('contratado_token')->plainTextToken;


        return response()->json([
            'status' => 'Sucesso',
            'message' => 'Seja bem-vindo' .  $userPro->nomeContratado,
            'token' => $token,
            'user'=>$userPro,
        ]);
    }


}
 {/*
        // Método para exibir os dados do PRofissional
        public function dadosProfissionais(Request $request)
        {
            try {
                // Recupera o profissional autenticado
                $profissional['idContratado'] = Auth::user()->idContratado;
        
        
                // Verifica se o profissional está autenticado
                if (!$profissional) {
                    return response()->json(['error' => 'Profissional não autenticado'], 401);
                }
    
        
                // Busca os dados do profissinal e leva para tela de perfil
                $profissional = Profissional::select('idContratado', 'nomeContratado', 'sobrenomeContratado', 'descContratado','profissaoContratado','bairroContratado')
                ->where('idContratado', $profissional) // Use o idContratado da autenticação
                //->where('statusPedido', 'pendente') // Verifique se o status é 'pendente'
                ->get();
        
                // Retorna os profissionais em formato JSON
                return response()->json($profissional);
            } catch (\Exception $e) {
                // Retorna um erro caso algo ocorra
                return response()->json(['error' => 'Erro ao trazer dados do PRO: ' . $e->getMessage()], 500);
            }
        }
*/}