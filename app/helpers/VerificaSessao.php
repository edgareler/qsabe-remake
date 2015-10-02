<?php

class VerificaSessao {
    public static function usuario() {
        return array('user.id' => Session::get('user.id',2),
                    'user.name' => Session::get('user.name','Edgar'),
                    'user.icon' => Session::get('user.icon','avatar.jpg'));
    }
    
    public static function setUsuario($id){
        $usuario = DB::table('usuarios')->where('id', $id)->first();
        
        Session::put('user.id', $usuario->id);
        Session::put('user.name', $usuario->nome);
        Session::put('user.icon', $usuario->icone);
    }
    
}
