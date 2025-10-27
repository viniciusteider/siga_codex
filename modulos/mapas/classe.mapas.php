<?php
class Mapas
{
    static public function TratarIconePonto($linha)
    {
        $icones = [
            "assets/media/icones-mapas/ponto-azul.png"
            ,"assets/media/icones-mapas/ponto-verde.png"
            ,"assets/media/icones-mapas/ponto-vermelho.png"
            ,"assets/media/icones-mapas/ponto-amarelo.png"
            ,"assets/media/icones-mapas/ponto-roxo.png"
        ];
        if($linha['panico'] == 1)
            $icone = $icones[3];
        elseif($linha['velocidade_veiculo'] > $linha['velocidade'])
            $icone = $icones[0];
        elseif($linha['ignicao'] == 1)
            $icone = $icones[1];
        else
            $icone = $icones[2];

        return $icone;
    }
    static public function GerarBalaoMonitor($linha)
    {
        $logradouro = $linha['logradouro'] . " " . $linha['numero'] . " " . $linha['complemento'] . " " . $linha['bairro'] . " " . $linha['nome_cidade'] . " " . $linha['nome_estado'] . " " . $linha['cep'];
        $info = '
                    <a  class="text-dark fw-bold text-hover-primary d-block fs-6">Velocidade: '.$linha["velocidade"].' km/h</a>
                    <span class="text-muted fw-semibold text-muted d-block fs-7"> Motivo: '.$linha["motivo"].'</span>
                    <span class="text-muted fw-semibold text-muted d-block fs-7"> Contador: '.$linha["contador"].'</span>
					';
        $ignicao = ($linha["ignicao"] == 1) ? '<i class="bi bi-toggle-on text-success" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="Iginição Ligada"></i> &nbsp;' : '<i class="bi bi-toggle-off text-danger" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="Iginição Desligada"></i> &nbsp;';
        $bloqueio = ($linha["bloqueio"] == 1) ? '<i class="bi bi-lock-fill text-warning" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="Bloqueado"></i> &nbsp;' : '<i class="bi bi-unlock text-success" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="Bloqueio Normal"></i> &nbsp;';
        $panico = ($linha["panico"] == 1) ? '<i class="bi bi-exclamation-triangle text-danger" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="Em pânico"></i> &nbsp;' : '<i class="bi bi-exclamation-triangle-fill" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="top" title="Pânico Normal"></i> &nbsp;';
        $status = $ignicao . $bloqueio . $panico;
        $html = '<div class="card mb-5 mb-xl-10 w-400px" id="kt_profile_details_view">
										<div class="card-header cursor-pointer" style="min-height: 40px !important;">
											<div class="card-title m-0">
												<h3 class="fw-bold m-0">'.$linha['title'].' '.$linha['complemento'].'</h3>
											</div>
										</div>
										<div class="card-body p-3">
							
											<div class="row mb-3">
												<label class="col-lg-4 fw-semibold text-muted">Número</label>
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800">'.$linha['id'].'</span>
												</div>
											</div>
					
											<div class="row mb-3">
												<label class="col-lg-4 fw-semibold text-muted">Data Hora</label>
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800">'.Conexao::PrepararDataPHP($linha["data_hora"], $_SESSION["usuario"]["timezone"]).'</span>
												</div>
											</div>	
											<div class="row mb-3">
												<label class="col-lg-4 fw-semibold text-muted">Endereço</label>
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800">'.$logradouro.'</span>
												</div>
											</div>
											<div class="row mb-3">
												<label class="col-lg-4 fw-semibold text-muted">Evento</label>
												<div class="col-lg-8 fv-row">
													<span class="fw-semibold text-gray-800 fs-6">'.$linha['nome_evento'].'</span>
												</div>
												
											</div>
											<div class="row mb-3">
												<label class="col-lg-4 fw-semibold text-muted">SubEvento</label>
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800">'.$linha['nome_sub_evento'].'</span>
												</div>
											</div>
											<div class="row mb-10">
												<label class="col-lg-4 fw-semibold text-muted">Status</label>
												<div class="col-lg-8">
													<span class="fw-semibold fs-6 text-gray-800">'.$linha['nome_status'].'</span>
												</div>
											</div>
										</div>
									</div>
                ';

        return $html;
    }
    static public function GerarBalao($linha)
    {
        $html = '<div class="card mb-5 mb-xl-10 w-400px" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Posição Nº. '.$linha['posicao_numero'].'</h3>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row mb-3">
                            <label class="col-lg-4 fw-semibold text-muted">Data Hora</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">'.Conexao::PrepararDataPHP($linha["data_hora"], $_SESSION["usuario"]["timezone"]).'</span>
                            </div>
                        </div>	
                        <div class="row mb-3">
                            <label class="col-lg-4 fw-semibold text-muted">Data Hora Gravação</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">'.Conexao::PrepararDataPHP($linha["data_hora_gravacao"], $_SESSION["usuario"]["timezone"]).'</span>
                            </div>
                        </div>
                    </div>
                </div>
                ';

        return $html;
    }

}