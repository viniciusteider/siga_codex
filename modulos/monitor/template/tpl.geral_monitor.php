<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Monitoramento de Ocorrências - Bombeiros</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Optional: Leaflet MarkerCluster (se quiser agrupar marcadores em massa) -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" /> -->
    <style>
        html,
        body {
            height: 100%;
        }

        #app {
            height: 100vh;
        }

        #map {
            height: calc(100vh - 56px);
        }

        /* 56px ~ altura da navbar */
        .leaflet-control-attribution {
            font-size: 11px;
        }

        .legend {
            position: absolute;
            bottom: 16px;
            left: 12px;
            background: rgba(255, 255, 255, 0.92);
            padding: 10px 12px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
            z-index: 1000;
            font-size: 0.9rem;
        }

        .legend .item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .legend .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .legend .dot.incident {
            background: #dc3545;
        }

        .legend .dot.hospital {
            background: #198754;
        }

        .legend .dot.vehicle {
            background: #fd7e14;
        }

        /* melhora o z-index do Offcanvas sobre o Leaflet */
        .offcanvas {
            z-index: 1100;
        }

        .leaflet-pane.leaflet-tooltip-pane .leaflet-tooltip {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div id="app" class="d-flex flex-column">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img alt="Logo" src="assets/media/logos/default-dark.svg" class="h-45px app-sidebar-logo-default">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Mapa</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLista" aria-controls="offcanvasLista">
                            Ocorrências em andamento
                        </button>
                        <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasViaturas">
                            Viaturas em operação
                        </button>
                        <button class="btn btn-outline-light" type="button" id="btnFitBounds" title="Enquadrar todos os pontos">Enquadrar</button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mapa -->
        <div id="mapa_monitor" style="width: 100%; height: 100%;"></div>

        <!-- Legend -->
        <div class="legend">
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-2x-red.png" alt="Ocorrência" height="24"> Ocorrência</div>
            <div class="item"><img src="https://cdn-icons-png.flaticon.com/128/3063/3063176.png" alt="Hospital"  height="24"> Hospital</div>
            <div class="item"><img src="https://cdn-icons-png.flaticon.com/128/11210/11210022.png" alt="Viatura" height="24"> Viatura</div>
        </div>
    </div>

    <!-- Offcanvas: Lista de Ocorrências -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLista" aria-labelledby="offcanvasListaLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasListaLabel">Ocorrências em andamento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="listaOcorrencias" class="list-group small"></div>
        </div>
    </div>

    <!-- Offcanvas: Lista de Viaturas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasViaturas" aria-labelledby="offcanvasViaturasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasViaturasLabel">Viaturas em operação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div id="listaViaturas" class="list-group small"></div>
        </div>
    </div>

    <!-- Modal: Detalhes da Ocorrência -->
    <div class="modal fade" id="modalOcorrencia" tabindex="-1" aria-labelledby="modalOcorrenciaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalOcorrenciaLabel">Detalhes da Ocorrência</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0" id="ocorrenciaDetalhes"></dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Optional: MarkerCluster -->
    <!-- <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script> -->

    <script>
        // ===== Configuração Inicial =====
        const INITIAL_CENTER = [-23.5505, -46.6333]; // São Paulo como exemplo
        const INITIAL_ZOOM = 12;

        // Ícones personalizados
        const IncidentIcon = L.icon({
            iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-2x-red.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            shadowSize: [41, 41]
        });
        const HospitalIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/128/3063/3063176.png',
            iconSize: [36, 36], // tamanho um pouco maior que o padrão
            iconAnchor: [18, 36], // ponto de ancoragem (meio da base)
            popupAnchor: [0, -32], // onde o popup/tooltip aparece
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            shadowSize: [41, 41]
        });
        const VehicleIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/128/11210/11210022.png', // 🚑 ícone de ambulância
            iconSize: [36, 36], // tamanho um pouco maior que o padrão
            iconAnchor: [18, 36], // ponto de ancoragem (meio da base)
            popupAnchor: [0, -32], // onde o popup/tooltip aparece
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            shadowSize: [41, 41]
        });

        // Dados de exemplo (substitua por suas APIs)
        let ocorrencias = [
            // {
            //     id: 'O-1001',
            //     tipo: 'Incêndio Residencial',
            //     prioridade: 'Alta',
            //     endereco: 'Rua Exemplo, 123 - Centro',
            //     status: 'Em andamento',
            //     solicitante: 'Maria Souza',
            //     telefone: '(11) 99999-9999',
            //     lat: -23.5505,
            //     lng: -46.6333,
            //     hora_acionamento: '2025-10-08 18:42'
            // },
            // {
            //     id: 'O-1002',
            //     tipo: 'Acidente Veicular',
            //     prioridade: 'Média',
            //     endereco: 'Av. Paulista, 1500 - Bela Vista',
            //     status: 'Em atendimento',
            //     solicitante: 'Carlos Lima',
            //     telefone: '(11) 98888-0000',
            //     lat: -23.5617,
            //     lng: -46.6560,
            //     hora_acionamento: '2025-10-08 19:05'
            // }
        ];

        const hospitais = [{
                id: 'H-01',
                nome: 'Hospital Central',
                tipo: 'Geral',
                lat: -23.5440,
                lng: -46.6510
            },
            {
                id: 'H-02',
                nome: 'Hospital Municipal',
                tipo: 'Trauma',
                lat: -23.5650,
                lng: -46.6400
            }
        ];

        // Viaturas serão atualizadas via WebSocket; iniciamos vazio
        const viaturasState = new Map(); // id -> { marker, data }

        // ===== Inicializa Mapa =====
        const mapaMonitor = L.map('mapa_monitor').setView(INITIAL_CENTER, INITIAL_ZOOM);

        L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=MtACgs2RJ1djThLcbzbe', {
            attribution: '&copy; <a href="https://www.maptiler.com/copyright/" target="_blank">MapTiler</a> & OpenStreetMap contributors',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mapaMonitor);



        const markersLayer = L.layerGroup().addTo(mapaMonitor);

        // ===== Renderização de Ocorrências =====
        const incidentMarkers = new Map();

        async function initOcorrencias() {
            try {
                const response = await fetch('index_xml.php?app_modulo=monitor&app_comando=listar_ocorrencias');
                const data = await response.json();
                ocorrencias = data;

                // Remove marcadores antigos antes de renderizar novamente
                incidentMarkers.forEach(marker => markersLayer.removeLayer(marker));
                incidentMarkers.clear();

                renderOcorrencias();
            } catch (error) {
                console.error("Erro ao atualizar ocorrências:", error);
            }
        }


        function renderOcorrencias() {
            const list = document.getElementById('listaOcorrencias');
            list.innerHTML = '';

            ocorrencias.forEach((oc) => {
                // define tipo e prioridade com fallback
                const tipo = oc.evento + (oc.subevento ? ' - ' + oc.subevento : '');
                const prioridade = oc.prioridade ?? 'Sem classificação';
                const status = oc.status_id == 1 ? 'Em andamento' :
                    oc.status_id == 2 ? 'Em atendimento' :
                    'Desconhecido';

                const marker = L.marker([parseFloat(oc.lat), parseFloat(oc.lng)], {
                        icon: IncidentIcon,
                    })
                    .addTo(markersLayer)
                    .bindTooltip(`${tipo} (${prioridade})`, {
                        permanent: false
                    });

                marker.on('click', () => openOcorrenciaModal({
                    ...oc,
                    tipo,
                    prioridade,
                    status,
                    hora_acionamento: oc.data_hora
                }));

                incidentMarkers.set(oc.id, marker);

                const item = document.createElement('button');
                item.className = 'list-group-item list-group-item-action';
                item.innerHTML = `
          <div class="d-flex w-100 justify-content-between">
            <strong>${tipo}</strong>
            <small class="text-muted">#${oc.id}</small>
          </div>
          <div class="small text-muted">${oc.endereco}</div>
          <div><span class="badge bg-danger-subtle text-danger border border-danger">${prioridade}</span>
               <span class="badge bg-secondary-subtle text-secondary border border-secondary">${status}</span></div>
        `;
                item.onclick = () => {
                    mapaMonitor.setView([parseFloat(oc.lat), parseFloat(oc.lng)], 15);
                    openOcorrenciaModal({
                        ...oc,
                        tipo,
                        prioridade,
                        status,
                        hora_acionamento: oc.data_hora
                    });
                };
                list.appendChild(item);
            });
        }

        function openOcorrenciaModal(oc) {
            const dl = document.getElementById('ocorrenciaDetalhes');
            dl.innerHTML = '';
            const fields = [
                ['ID', oc.id],
                ['Tipo', oc.tipo],
                ['Prioridade', oc.prioridade],
                ['Endereço', oc.endereco],
                ['Status', oc.status],
                ['Solicitante', oc.solicitante],
                ['Telefone', oc.telefone],
                ['Horário', oc.hora_acionamento]
            ];
            for (const [k, v] of fields) {
                dl.insertAdjacentHTML('beforeend', `
          <dt class="col-4">${k}</dt>
          <dd class="col-8">${v ?? '-'}</dd>
        `);
            }
            const modal = new bootstrap.Modal(document.getElementById('modalOcorrencia'));
            modal.show();
        }

        // ===== Renderização de Hospitais =====
        const hospitalMarkers = new Map();

        async function renderHospitais() {
            try {
                const response = await fetch('index_xml.php?app_modulo=monitor&app_comando=listar_hospitais');
                const data = await response.json();

                // Limpa marcadores antigos
                hospitalMarkers.forEach(marker => markersLayer.removeLayer(marker));
                hospitalMarkers.clear();

                data.forEach(h => {
                    // Cria marcador
                    const marker = L.marker([parseFloat(h.lat), parseFloat(h.lng)], {
                            icon: HospitalIcon,
                        })
                        .addTo(markersLayer)
                        .bindTooltip(`
                    🏥 <b>${h.nome}</b><br>
                    ${h.endereco}<br>
                    Complexidade: ${h.complexidade}<br>
                    Leitos: ${h.vagas_leitos} | UTI: ${h.vagas_uti}
                `);

                    hospitalMarkers.set(h.id, marker);
                });

                console.log(`✅ ${data.length} hospitais carregados`);
            } catch (err) {
                console.error("Erro ao carregar hospitais:", err);
            }
        }

        function gerarTooltipViatura(v) {
            const equipe = (v.escala || []).map(e => e.efetivo.split(' ')[0]).join(', ');
            return `
        🚑 <b>${v.prefixo}</b><br>
        ${v.marca ?? ''} ${v.modelo ?? ''}<br>
        Base: ${v.base ?? '-'}<br>
        Equipe: ${equipe || '—'}<br>
        Velocidade: ${(v.speed ?? 0).toFixed(1)} km/h
    `;
        }

        function openViaturaModal(v) {
            const modalHtml = `
      <dl class="row mb-0">
        <dt class="col-4">Prefixo</dt><dd class="col-8">${v.prefixo}</dd>
        <dt class="col-4">Placa</dt><dd class="col-8">${v.placa ?? '-'}</dd>
        <dt class="col-4">Modelo</dt><dd class="col-8">${v.marca ?? ''} ${v.modelo ?? ''}</dd>
        <dt class="col-4">Base</dt><dd class="col-8">${v.base ?? '-'}</dd>
        <dt class="col-4">Km Atual</dt><dd class="col-8">${v.km_atual ?? '-'}</dd>
        <dt class="col-4">Ano</dt><dd class="col-8">${v.ano_modelo ?? '-'}</dd>
        <dt class="col-4">Tanque</dt><dd class="col-8">${v.tanque ?? '-'} L</dd>
        <dt class="col-4">Status</dt><dd class="col-8">${v.status ?? '-'}</dd>
      </dl>
      <hr>
      <h6>Efetivo em serviço</h6>
      ${(v.escala || []).map(e => `
          <div><strong>${e.efetivo}</strong> — ${e.funcao}</div>
      `).join('')}
    `;

            const modalBody = document.getElementById('ocorrenciaDetalhes');
            modalBody.innerHTML = modalHtml;
            const modal = new bootstrap.Modal(document.getElementById('modalOcorrencia'));
            modal.show();
        }


        function renderListaViaturas() {
            const list = document.getElementById('listaViaturas');
            if (!list) return;
            list.innerHTML = '';

            for (const [id, v] of viaturasState.entries()) {
                const data = v.data;
                const item = document.createElement('button');
                item.className = 'list-group-item list-group-item-action';
                item.innerHTML = `
            <div class="d-flex w-100 justify-content-between">
                <strong>${data.prefixo}</strong>
                <small class="text-muted">${data.marca ?? ''} ${data.modelo ?? ''}</small>
            </div>
            <div class="small text-muted">${data.base ?? ''}</div>
            <div><span class="badge bg-secondary">${data.status ?? ''}</span></div>
        `;
                item.onclick = () => {
                    mapaMonitor.setView([parseFloat(data.lat), parseFloat(data.lng)], 15);
                    openViaturaModal(data);
                };
                list.appendChild(item);
            }
        }


        async function upsertViatura(v) {
            const now = Date.now();
            const existing = viaturasState.get(v.id);

            // Atualiza posição se já existir
            if (existing) {
                existing.marker.setLatLng([v.lat, v.lng]);
                existing.marker.setTooltipContent(gerarTooltipViatura(existing.data));
                existing.data = {
                    ...existing.data,
                    ...v,
                    lastUpdate: now
                };
                return;
            }

            // Buscar dados da viatura se não existir
            try {
                const res = await fetch(`index_xml.php?app_modulo=monitor&app_comando=get_viatura&id=${v.id}`);
                const info = await res.json();

                const viatura = {
                    ...info,
                    lat: v.lat,
                    lng: v.lng,
                    speed: v.speed ?? 0,
                    status: 'Em deslocamento',
                    lastUpdate: now
                };

                const marker = L.marker([v.lat, v.lng], {
                        icon: VehicleIcon,
                    })
                    .addTo(markersLayer)
                    .bindTooltip(gerarTooltipViatura(viatura));

                marker.on('click', () => openViaturaModal(viatura));

                viaturasState.set(v.id, {
                    marker,
                    data: viatura
                });
                renderListaViaturas(); // atualiza lista lateral
                console.log(`➕ Viatura adicionada: ${viatura.prefixo}`);
            } catch (err) {
                console.error(`Erro ao buscar viatura ${v.id}:`, err);
            }
        }


        function limparViaturasInativas() {
            const agora = Date.now();
            const limite = 30000; // 30 segundos

            for (const [id, v] of viaturasState.entries()) {
                if (!v.data.lastUpdate || (agora - v.data.lastUpdate) > limite) {
                    markersLayer.removeLayer(v.marker);
                    viaturasState.delete(id);
                    console.warn(`❌ Viatura removida por inatividade: ${id}`);
                }
            }
        }
        setInterval(limparViaturasInativas, 5000); // checa a cada 5 segundos


        function connectWebSocket() {
            // Substitua pela sua URL real
            const wsUrl = 'ws://www.siga192.com.br:8181?groupId=4';
            let ws;
            try {
                ws = new WebSocket(wsUrl);
            } catch (e) {
                console.warn('WS indisponível', e);
                return;
            }

            ws.onopen = () => console.log('WebSocket conectado:', wsUrl);
            ws.onclose = () => console.warn('WebSocket desconectado');
            ws.onerror = (e) => console.error('WebSocket erro:', e);

            ws.onmessage = (evt) => {
                try {
                    const payload = JSON.parse(evt.data);
                    if (payload.type === 'location') {
                        // Atualiza ou cria a viatura com base no userId
                        upsertViatura({
                            id: String(payload.userId),
                            prefixo: `VTR-${payload.userId}`,
                            lat: payload.latitude,
                            lng: payload.longitude,
                            speed: payload.speed,
                            status: 'Em deslocamento'
                        });
                    }
                } catch (err) {
                    console.error('Mensagem WS inválida:', err, evt.data);
                }
            };
        }

        // ===== Utilidades =====
        function fitAllBounds() {
            const group = L.featureGroup([
                ...incidentMarkers.values(),
                ...hospitalMarkers.values(),
                ...Array.from(viaturasState.values()).map(v => v.marker)
            ]);
            if (group.getLayers().length) {
                mapaMonitor.fitBounds(group.getBounds().pad(0.2));
            }
        }

        document.getElementById('btnFitBounds').addEventListener('click', fitAllBounds);

        (async () => {
            // ===== Boot =====
            await initOcorrencias();
            renderHospitais();

            // Conecte ao WebSocket das viaturas
            connectWebSocket();

            // Enquadrar tudo após carregar
            setTimeout(fitAllBounds, 400);

            setInterval(initOcorrencias, 10000);

        })();
    </script>
</body>

</html>