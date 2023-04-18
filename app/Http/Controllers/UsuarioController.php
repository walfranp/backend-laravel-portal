<?php

namespace App\Http\Controllers;

use App\Mail\EmailRecuperaSenha;
use App\TokenValidacao;
use App\User;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Illuminate\Support\Facades\Auth;
use Hash;
use Crypt;

class UsuarioController extends Controller {

    public function get(Request $request) {
        $validator = Validator::make($request->all(), [
            'busca_nome' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'status_msg' => $validator->errors()], 401);
        }

        $usuarios = User::where('name', 'like', $request->input('busca_nome') . '%')->get();

        if (count($usuarios) > 0) {
            return response()->json(['status_code' => 200, 'status_msg' => 'success', 'dados' => $usuarios], 200);
        } else {
            return response()->json(['status_code' => 200, 'status_msg' => 'não encontrado', 'dados' => $usuarios], 200);
        }

    }

    public function getById($id) {

        $usuario = User::find($id);

        if (!$usuario) {
            return response()->json(['status_code' => 200, 'status_msg' => 'não encontrado', 'dados' => $usuario], 200);
        } else {
            return response()->json(['status_code' => 200, 'status_msg' => 'success', 'dados' => $usuario], 200);
        }

    }

    public function enviarLinkRecuperarSenha(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'status_msg' => $validator->errors()], 401);
        }

        $user = User::where('user_email', $request->email)->first();

        if (!isset($user)) {
            $response['status_code'] = 404;
            $response['status_msg'] = 'Email não encontrado.';
            return response()->json($response, 404);
        }

        $emailto = $request->email;
        $tokenValidation = new TokenValidacao();
        $codigo_validacao = $tokenValidation->addTokenValidacao(1, $user->id);
        $username = $user->name;
        //$url = config('app.url') . '/#/change-password/' . $token;
        $logoplatform = config('app.logo');
        $nameplatform = config('app.name');
        $emailfrom = config('mail.from.address');
        $email_content = 'Recuperação de senha';
        $email_subject = $nameplatform;

        Mail::to($emailto)->send(new EmailRecuperaSenha(
            $email_content,
            $email_subject,
            $emailto,
            $emailfrom,
            $username,
            $codigo_validacao,
            $logoplatform,
            $nameplatform
        ));

        return response()->json(['status_code' => 200, 'codigo_validacao' => $codigo_validacao, 'email' => $emailto], 200);
    }

    public function alterarSenhaPorToken(Request $request) {
        $validator = Validator::make($request->all(), [
            'senha' => 'required',
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'status_msg' => $validator->errors()], 401);
        }

        $tokenValidation = TokenValidacao::where('codigo', '=', $request->input('token'))->get()->first();

        if(!isset($tokenValidation)){
            return response()->json(['status_code' => 404, 'status_msg' => 'token não encontrado'], 404);
        }

        $user = User::find($tokenValidation->user_id);

        $user->password = bcrypt($request->input('senha'));
        $user->save();

        TokenValidacao::where('user_id', '=', $user->id)->where('token_type', '=', 1)->delete();

        return response()->json(['status_code' => 200, 'status_msg' => 'sucesso'], 200);

    }

    public function validarToken(Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'status_msg' => $validator->errors()], 401);
        }

        $tokenValidation = TokenValidacao::where('codigo', '=', $request->input('token'))->get()->first();

        if (!isset($tokenValidation)) {
            return response()->json(['status_code' => 404, 'status_msg' => 'token não encontrado'], 404);
        }

        $resultado = $tokenValidation->validarToken($tokenValidation->token_date, 1);

        if (!$resultado) {
            return response()->json(['status_code' => 403, 'status_msg' => 'token vencido'], 403);
        }

        return response()->json(['status_code' => 200, 'status_msg' => 'sucesso'], 200);

    }

    public function alterarSenha(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status_code' => 401, 'status_msg' => $validator->errors()], 401);
        }

        $user = User::find(Auth::user()->id);

        //check here if exists password
        if (Hash::check($request->input('old_password'), $user->password)) {
            // Success
            $user->password = bcrypt($request->input('new_password'));
            $user->save();

        } else {
            return response()->json(['status_code' => 403, 'status_msg' => 'senha atual não confere'], 403);
        }

        return response()->json(['status_code' => 200, 'status_msg' => 'sucesso'], 200);

    }

}
