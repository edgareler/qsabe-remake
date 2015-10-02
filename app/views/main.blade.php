@extends('layout')

@section('left')
            <div id="left">
                <div class="box">
                    <div class="title qsabeicon qsabeicon-contextos">
                        Contextos
                    </div>
                    <a href="#" class="bg-verde-escuro qsabeicon qsabeicon-informatica-l bt-context">
                        Informática
                    </a>
                    <a href="#" class="bg-vermelho-escuro qsabeicon qsabeicon-quimica-l bt-context">
                        Química
                    </a>
                    <a href="#" class="bg-azul-claro qsabeicon qsabeicon-fisica-l bt-context">
                        Física
                    </a>
                    <a href="#" class="bg-azul-escuro qsabeicon qsabeicon-astronomia-l bt-context">
                        Astronomia
                    </a>
                    <a href="#" class="bg-ouro qsabeicon qsabeicon-fotografia-l bt-context">
                        Fotografia
                    </a>
                    <a href="#" class="bg-verde-claro qsabeicon qsabeicon-jogos-l bt-context">
                        Jogos
                    </a>
                </div>
                <div class="box">
                    <div class="title qsabeicon qsabeicon-desempenho">
                        Desempenho
                    </div>
                    <div id="chart-01" class="chart"></div>
                </div>
            </div>
@stop

@section('content')
            <div id="content">
                <nav>
                    <ul id="abas" class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#novas-respostas" role="tab" data-toggle="tab" class="verde qsabeicon qsabeicon-respostas">Novas Respostas</a></li>
                        <li><a href="#minhas-perguntas" role="tab" data-toggle="tab" class="vermelho qsabeicon qsabeicon-minhas-perguntas">Minhas Perguntas</a></li>
                        <li><a href="#perguntas-responder" role="tab" data-toggle="tab" class="ouro qsabeicon qsabeicon-perguntas-responder">Perguntas a Responder</a></li>
                    </ul>
                    <div id="abas-content" class="tab-content">
                        
                        <div class="tab-pane fade in active" id="novas-respostas">
                            @foreach ($novas_respostas as $nova_resposta)
                                <div class="pergunta">
                                    <div class="count-respostas
                                         @if ($nova_resposta->respostas > 0)
                                            bg-verde-escuro
                                         @endif
                                         ">
                                        <span>{{ $nova_resposta->respostas }}</span>respostas
                                    </div>
                                    <a href="/pergunta/{{ $nova_resposta->id }}/edit" class="texto-pergunta">
                                        {{ $nova_resposta->pergunta }}
                                    </a>
                                    <a href="#" class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</a>
                                    <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                                </div>
                            @endforeach
                            
                            <!--
                            <div class="pergunta">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio Nunc lobortis semper arcu, non pellentesque diam, Nulla fermentum libero vel nunc?
                                </a>
                                <a href="#" class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</a>
                                <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Suspendisse consequat sit amet risus eu varius?
                                </a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>

                            <div class="pergunta">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Maecenas libero dolor, placerat quis mauris lobortis, ornare pulvinar magna?
                                </a>
                                <a href="#" class="context-small laranja qsabeicon qsabeicon-eletricidade-s">Elétrica</a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Fusce ipsum quam, pulvinar et risus non, vulputate egestas nibh, vivamus consequat?
                                </a>
                                <a href="#" class="context-small azul-petroleo qsabeicon qsabeicon-contabilidade-s">Contabilidade</a>
                            </div>

                            <div class="pergunta">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Phasellus id arcu vitae magna consectetur sodales at ac sapien?
                                </a>
                                <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Suspendisse consequat sit amet risus eu varius?
                                </a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>
                            -->
                        </div>

                        <div class="tab-pane fade" id="minhas-perguntas">
                            @foreach ($minhas_perguntas as $minha_pergunta)
                                <div class="pergunta">
                                    <div class="count-respostas
                                         @if ($minha_pergunta->respostas > 0)
                                            bg-verde-escuro
                                         @endif
                                         ">
                                        <span>{{ $minha_pergunta->respostas }}</span>respostas
                                    </div>
                                    <a href="/pergunta/{{ $minha_pergunta->id }}/edit" class="texto-pergunta">
                                        {{ $minha_pergunta->pergunta }}
                                    </a>
                                    <a href="#" class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</a>
                                    <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                                </div>
                            @endforeach
                            
                            <!--
                            <div class="pergunta">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio Nunc lobortis semper arcu, non pellentesque diam, Nulla fermentum libero vel nunc?
                                </a>
                                <a href="#" class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</a>
                                <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Suspendisse consequat sit amet risus eu varius?
                                </a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>

                            <div class="pergunta">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Maecenas libero dolor, placerat quis mauris lobortis, ornare pulvinar magna?
                                </a>
                                <a href="#" class="context-small laranja qsabeicon qsabeicon-eletricidade-s">Elétrica</a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Fusce ipsum quam, pulvinar et risus non, vulputate egestas nibh, vivamus consequat?
                                </a>
                                <a href="#" class="context-small azul-petroleo qsabeicon qsabeicon-contabilidade-s">Contabilidade</a>
                            </div>

                            <div class="pergunta">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Phasellus id arcu vitae magna consectetur sodales at ac sapien?
                                </a>
                                <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>12</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Suspendisse consequat sit amet risus eu varius?
                                </a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>
                            -->
                        </div>

                        <div class="tab-pane fade" id="perguntas-responder">
                            @foreach ($perguntas_responder as $pergunta_responder)
                                <div class="pergunta">
                                    <div class="count-respostas
                                         @if ($pergunta_responder->respostas > 0)
                                            bg-verde-escuro
                                         @endif
                                         ">
                                        <span>{{ $pergunta_responder->respostas }}</span>respostas
                                    </div>
                                    <a href="/pergunta/{{ $pergunta_responder->id }}/edit" class="texto-pergunta">
                                        {{ $pergunta_responder->pergunta }}
                                    </a>
                                    <a href="#" class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</a>
                                    <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                                </div>
                            @endforeach
                            
                            <!--
                            <div class="pergunta">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio Nunc lobortis semper arcu, non pellentesque diam, Nulla fermentum libero vel nunc?
                                </a>
                                <a href="#" class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</a>
                                <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Suspendisse consequat sit amet risus eu varius?
                                </a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>

                            <div class="pergunta">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Maecenas libero dolor, placerat quis mauris lobortis, ornare pulvinar magna?
                                </a>
                                <a href="#" class="context-small laranja qsabeicon qsabeicon-eletricidade-s">Elétrica</a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>1</span>resposta
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Fusce ipsum quam, pulvinar et risus non, vulputate egestas nibh, vivamus consequat?
                                </a>
                                <a href="#" class="context-small azul-petroleo qsabeicon qsabeicon-contabilidade-s">Contabilidade</a>
                            </div>

                            <div class="pergunta">
                                <div class="count-respostas">
                                    <span>0</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Phasellus id arcu vitae magna consectetur sodales at ac sapien?
                                </a>
                                <a href="#" class="context-small ouro qsabeicon qsabeicon-criptografia-s">Criptografia</a>
                            </div>

                            <div class="pergunta bg-branco-gelo">
                                <div class="count-respostas bg-verde-escuro">
                                    <span>2</span>respostas
                                </div>
                                <a href="#" class="texto-pergunta">
                                    Suspendisse consequat sit amet risus eu varius?
                                </a>
                                <a href="#" class="context-small azul-claro qsabeicon qsabeicon-fisica-s">Física</a>
                            </div>
                            -->
                        </div>

                    </div>
                </nav>

                <div id="nova-pergunta" class="box">
                    <div id="nova-pergunta-content">
                        <div class="title qsabeicon qsabeicon-nova-pergunta">Enviar Nova Pergunta</div>

                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputPergunta" class="col-sm-1 control-label label-pergunta">Título:</label>
                                <div class="col-sm-11">
                                    <input type="search" class="form-control" id="inputPergunta" placeholder="Insira sua nova pergunta">
                                </div>
                            </div>

                            <div class="form-group form-textarea">
                                <textarea class="form-control textarea" id="text-pergunta" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Enviar</button>
                            </div>
                        </form>
                    </div>

                    <div id="perguntas-semelhantes" class="box bg-branco-gelo">
                        <div class="title-no-icon">Perguntas Semelhantes</div>
                        <a href="#">Suspendisse consequat sit amet risuseu varius?</a>
                        <a href="#">Maecenas libero dolor, placerat quismauris lobortis ornare pulvinar magna?</a>
                        <a href="#">Suspendisse consequat sit amet risuseu varius?</a>
                        <a href="#">Suspendisse consequat sit amet risuseu varius?</a>
                        <a href="#">Suspendisse consequat sit amet risuseu varius?</a>
                        <a href="#">Suspendisse consequat sit amet risuseu varius?</a>
                    </div>
                </div>
            </div>
@stop

@section('right') 
            <div id="right">
                <div class="title qsabeicon qsabeicon-perguntas-qsabe mg-20">
                    Perguntas QSabe
                </div>
                
                @foreach ($todas_perguntas as $pergunta)
                    <div class="pergunta bg-cinza-claro">
                        <a href="/pergunta/{{ $pergunta->id }}/edit" class="texto-pergunta">
                            {{ $pergunta->pergunta }}
                        </a>
                        <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                        <div class="count-respostas-small
                             @if ($pergunta->respostas > 0)
                                verde-escuro
                             @else
                                vermelho-escuro
                             @endif
                             "><span class="
                                                                                 @if ($pergunta->respostas > 0)
                                                                                    bg-verde-escuro
                                                                                 @else
                                                                                    bg-vermelho-escuro
                                                                                 @endif
                                                                                 ">{{ $pergunta->respostas }}</span> Respostas</div>
                    </div>
                @endforeach
                <!--
                <div class="pergunta bg-cinza-claro">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small vermelho-escuro"><span class="bg-vermelho-escuro">0</span> Respostas</div>
                </div>
                <div class="pergunta">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small vermelho-escuro"><span class="bg-vermelho-escuro">0</span> Respostas</div>
                </div>
                <div class="pergunta bg-cinza-claro">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small vermelho-escuro"><span class="bg-vermelho-escuro">0</span> Respostas</div>
                </div>
                <div class="pergunta">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small verde-escuro"><span class="bg-verde-escuro">2</span> Respostas</div>
                </div>
                <div class="pergunta bg-cinza-claro">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small vermelho-escuro"><span class="bg-vermelho-escuro">0</span> Respostas</div>
                </div>
                <div class="pergunta">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small vermelho-escuro"><span class="bg-vermelho-escuro">0</span> Respostas</div>
                </div>
                <div class="pergunta bg-cinza-claro bd-bt">
                    <a href="#" class="texto-pergunta">
                        Praesent libero magna, dapibus sollicitudin nisi id, suscipit congue odio?
                    </a>
                    <div class="context-small verde-escuro qsabeicon qsabeicon-android-s">Android</div>
                    <div class="count-respostas-small vermelho-escuro"><span class="bg-vermelho-escuro">0</span> Respostas</div>
                </div>
                <div class="title qsabeicon qsabeicon-comunidade mg-20 mg-tp-40">
                    Comunidade
                </div>
                -->
            </div>
@stop