<?php

namespace App\Http\Controllers;

use App\User;
use App\LogAcesso;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class LoginController extends Controller
{

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Erro!' => $validator->errors()], 401);
        }

        $parametros = $request->all();

        if (auth()->attempt($parametros)) {

            $logAcesso = new LogAcesso();

            $user = auth()->user();
            $token = $user->createToken('portal')->accessToken;

            $return = $logAcesso->registraAcesso($user->id_externo, $_SERVER["REMOTE_ADDR"]);

            return response()->json(['usuario' => auth()->user(), 'token' => $token], 200);
        } else {
            return response()->json(['Erro!' => 'Credenciais inválidas'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->token()->revoke();
        $user->token()->delete();

        return response()->json(['success' => 200], 200);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required',
            'password' => 'required|min:6',
    //  'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['Erro!' => $validator->errors()], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'token' => $user->createToken('portal')->accessToken,
            'user' => $user,
        ], 200);

    }




    public function getLogAcessos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ano_ref' => 'required',
            'mes_ref' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $parametros = $request->all();

        $logs = LogAcesso::whereYear('log_acessos.created_at', '=', $parametros['ano_ref'])->whereMonth('log_acessos.created_at', '=', $parametros['mes_ref'])->leftJoin('users', 'log_acessos.user_id','=','users.id_externo')
        ->select('users.id_externo','users.name', 'cpf', 'user_email', 'log_acessos.ip','log_acessos.created_at as data_acesso')->orderBy('log_acessos.created_at', 'DESC')->get();

        return response()->json($logs, 200);

    }

}
