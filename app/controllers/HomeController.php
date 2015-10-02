<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      | Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function cosineSimilarity($tokensA, $tokensB) {
    //Recebe duas perguntas sem tratamento para calcular a similaridade

        $perguntamodificada = strtolower($tokensA);
        $perguntamodificada2 = strtolower($tokensB);


        $perguntamodificada = str_ireplace('?', "", $perguntamodificada);
        $perguntamodificada2 = str_ireplace('?', "", $perguntamodificada2);


        $array = explode(" ", $perguntamodificada);
        $array2 = explode(" ", $perguntamodificada2);

        $stopwords = array("o", "a", "os", "as", "um", "uma", "uns", "umas", "de", "em", "por", "per", "uns", "umas", "pelo", "pelos", "pela", "pelas", "no", "nos", "na", "nas", "num", "nuns", "numa", "numas", "do", "dos", "da", "das", "dum", "duns", "duma", "dumas", "à", "às", "ao", "aos", "tão", "que", "ante", "após", "até", "com", "contra", "de", "desde", "em", "entre", "para", "perante", "por", "sem", "sob", "sobre", "trás");

        $tokensA = array_diff($array, $stopwords);
        $tokensB = array_diff($array2, $stopwords);

        $a = $b = $c = 0;
        $uniqueTokensA = $uniqueTokensB = array();

        $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));

        foreach ($tokensA as $token)
            $uniqueTokensA[$token] = 0;
        foreach ($tokensB as $token)
            $uniqueTokensB[$token] = 0;

        foreach ($uniqueMergedTokens as $token) {
            $x = isset($uniqueTokensA[$token]) ? 1 : 0;
            $y = isset($uniqueTokensB[$token]) ? 1 : 0;
            $a += $x * $y;
            $b += pow($x, 2);
            $c += pow($y, 2);
        }

        $resultado = $b * $c != 0 ? $a / sqrt($b * $c) : 0;
        if ($resultado >= 0.5) {

            $resultado = true;
        } else {

            $resultado = false;
        }

    //retorna true se for similar e false se não for
        return $resultado;
    }

    public function perguntasSemelhantes($texto){
        $perguntas = DB::table('perguntas')->orderBy('data_hora', 'desc')->get();
        
        $arRetorno = array();
        
        foreach($perguntas as $pergunta){
            if(HomeController::cosineSimilarity($texto, $pergunta->pergunta)){
                array_push($arRetorno, $pergunta);
            }
        }
        
        return Response::json($arRetorno);
    }
    
    public function showWelcome() {
        $usuario_id = Session::get('user.id', 2);

        $novas_respostas = DB::select("select 
                                            p.id as id,
                                            p.pergunta as pergunta,
                                            p.data_hora as data,
                                            count(r.id) as respostas
                                        from
                                            perguntas p,
                                            respostas r
                                        where
                                            r.pergunta_id = p.id
                                        group by p.id , p.pergunta , p.data_hora
                                        order by p.data_hora desc");

        $minhas_perguntas = DB::select("select 
                                            p.id as id,
                                            p.pergunta as pergunta,
                                            p.data_hora as data,
                                            count(r.id) as respostas
                                        from
                                            perguntas p
                                        left outer join
                                            respostas r
                                        on
                                            r.pergunta_id = p.id
                                        where
                                            p.questionador_id = ?
                                        group by p.id , p.pergunta , p.data_hora
                                        order by p.data_hora desc", array($usuario_id));

        $perguntas_responder = DB::select("select 
                                            p.id as id,
                                            p.pergunta as pergunta,
                                            p.data_hora as data,
                                            count(r.id) as respostas
                                        from
                                            perguntas p
                                        left outer join
                                            respostas r
                                        on
                                            r.pergunta_id = p.id
                                        group by p.id , p.pergunta , p.data_hora
                                        having count(r.id) = 0
                                        order by p.data_hora desc");

        $todas_perguntas = DB::select("select 
                                            p.id as id,
                                            p.pergunta as pergunta,
                                            p.data_hora as data,
                                            count(r.id) as respostas
                                        from
                                            perguntas p
                                        left outer join
                                            respostas r
                                        on
                                            r.pergunta_id = p.id
                                        group by p.id , p.pergunta , p.data_hora
                                        order by p.data_hora desc");

        return View::make('main', array('novas_respostas' => $novas_respostas, 'minhas_perguntas' => $minhas_perguntas, 'perguntas_responder' => $perguntas_responder, 'todas_perguntas' => $todas_perguntas));
    }

}
