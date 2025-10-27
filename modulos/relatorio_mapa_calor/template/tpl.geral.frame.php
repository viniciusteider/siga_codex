<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mapa de Calor & Clusters — Bombeiros</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <!-- MarkerCluster CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      overflow: hidden;
    }

    #app {
      height: 100vh;
      display: grid;
      grid-template-rows: auto 1fr;
    }

    #mapa_relatorio_mapa_calor {
      height: 100%;
    }

    .toolbar {
      background: #0d6efd10;
      border-bottom: 1px solid #e5e7eb;
    }

    .legend {
      position: absolute;
      bottom: 16px;
      left: 12px;
      background: #fff;
      padding: 10px 12px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
      z-index: 1000;
      font-size: .9rem;
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

    .dot.ocorrencia {
      background: #dc3545;
    }

    .dot.hospital {
      background: #198754;
    }

    .dot.base {
      background: #0d6efd;
    }

    .offcanvas {
      z-index: 1100;
    }

    .btn-icon {
      display: inline-flex;
      align-items: center;
      gap: .5rem;
    }

    .filters .form-select,
    .filters .form-control {
      min-width: 180px;
    }

    .filters .form-check {
      margin-top: .5rem;
    }
  </style>
</head>

<body>
  <div id="app">
    <!-- Toolbar / Filtros -->

    <div class="toolbar py-3 border-bottom bg-light">
      <div class="container-fluid">
        <form id="filtros" class="row g-3 align-items-end">
          <!-- Cidade -->
          <div class="col-6 col-md-2">
            <label for="f-cidade" class="form-label">Cidade</label>
            <select id="f-cidade" class="form-select form-select-sm">
              <option value="">Todas</option>
            </select>
          </div>

          <!-- Evento -->
          <div class="col-6 col-md-2">
            <label for="f-evento" class="form-label">Evento</label>
            <select id="f-evento" class="form-select form-select-sm">
              <option value="">Todos</option>
            </select>
          </div>

          <!-- Subevento -->
          <div class="col-6 col-md-2">
            <label for="f-subevento" class="form-label">Subevento</label>
            <select id="f-subevento" class="form-select form-select-sm">
              <option value="">— todos —</option>
            </select>
          </div>

          <!-- Data Inicial -->
          <div class="col-6 col-md-2">
            <label for="f-data-inicio" class="form-label">Data Inicial</label>
            <input id="f-data-inicio" type="date" class="form-control form-control-sm" />
          </div>

          <!-- Data Final -->
          <div class="col-6 col-md-2">
            <label for="f-data-fim" class="form-label">Data Final</label>
            <input id="f-data-fim" type="date" class="form-control form-control-sm" />
          </div>

          <!-- Botões principais -->
          <div class="col-12 col-md-2 d-flex gap-2">
            <button id="btn-aplicar" type="button" class="btn btn-primary btn-sm flex-fill">
              <i class="bi bi-funnel me-1"></i>Aplicar
            </button>
            <button id="btn-limpar" type="button" class="btn btn-outline-secondary btn-sm flex-fill">
              <i class="bi bi-x-circle me-1"></i>Limpar
            </button>
          </div>
        </form>

        <!-- Linha inferior: switches e offcanvas -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
          <div class="d-flex gap-2">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="toggle-heat" checked>
              <label class="form-check-label" for="toggle-heat">Mapa de calor</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="toggle-cluster" checked>
              <label class="form-check-label" for="toggle-cluster">Cluster de pinos</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="toggle-hospitais" checked>
              <label class="form-check-label" for="toggle-hospitais">Mostrar Hospitais</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="toggle-bases" checked>
              <label class="form-check-label" for="toggle-bases">Mostrar Bases</label>
            </div>
          </div>


          <div class="d-flex gap-2 mt-2 mt-md-0">
            <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasListas">
              Listas
            </button>
          </div>
        </div>
      </div>
    </div>


    <!-- Mapa -->
    <div id="mapa_relatorio_mapa_calor"></div>

    <!-- Legend -->
    <div class="legend">
      <div id="tiposContainer" class="vstack gap-2"></div>
    </div>
  </div>

  <!-- Offcanvas: Listas (Hospitais / Bases) -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvasListas" aria-labelledby="offCanvasListasLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offCanvasListasLabel">Camadas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <h6 class="mb-2">Hospitais</h6>
      <div id="listaHospitais" class="list-group small mb-3"></div>
      <h6 class="mb-2">Bases</h6>
      <div id="listaBases" class="list-group small"></div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <!-- Heatmap plugin -->
  <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
  <!-- MarkerCluster plugin -->
  <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

  <script>
    // =========================
    // Config
    // =========================
    const API_BASE = 'index_xml.php?app_modulo=relatorio_mapa_calor';
    const API_OCORRENCIAS = `${API_BASE}&app_comando=get_ocorrencias`;
    const API_CIDADES = `${API_BASE}&app_comando=get_cidades`;
    const API_EVENTOS = `${API_BASE}&app_comando=get_eventos`;
    const API_SUBEVENTOS = `${API_BASE}&app_comando=get_subeventos`;
    const API_HOSPITAIS = `${API_BASE}&app_comando=listar_hospitais`;
    const API_BASES = `${API_BASE}&app_comando=listar_bases`;

    // Ajuste estas URLs conforme seu backend:

    const INITIAL_CENTER = [-10.9, -61.93]; // Ji-Paraná/RO como exemplo
    const INITIAL_ZOOM = 12;

    // =========================
    // Helpers
    // =========================
    const $ = (sel) => document.querySelector(sel);
    const elCidade = $('#f-cidade');
    const elEvento = $('#f-evento');
    const elSubevento = $('#f-subevento');
    const elInicio = $('#f-data-inicio');
    const elFim = $('#f-data-fim');
    const btnAplicar = $('#btn-aplicar');
    const btnLimpar = $('#btn-limpar');
    const chkHeat = $('#toggle-heat');
    const chkCluster = $('#toggle-cluster');
    const tiposContainer = $('#tiposContainer');
    const chkHospitais = $('#toggle-hospitais');
    const chkBases = $('#toggle-bases');


    async function fetchJSON(url) {
      const res = await fetch(url);
      if (!res.ok) throw new Error('HTTP ' + res.status);
      return res.json();
    }

    function buildQuery(params) {
      const usp = new URLSearchParams();
      for (const [k, v] of Object.entries(params))
        if (v !== undefined && v !== null && v !== '') usp.set(k, v);
      return usp.toString();
    }

    // =========================
    // Mapa & Camadas
    // =========================
    const mapa_relatorio_mapa_calor = L.map('mapa_relatorio_mapa_calor').setView(INITIAL_CENTER, INITIAL_ZOOM);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      attribution: '&copy; CartoDB & OpenStreetMap contributors'
    }).addTo(mapa_relatorio_mapa_calor);

    const incidentIcon = L.icon({
      iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-2x-red.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      shadowSize: [41, 41]
    });
    const hospitalIcon = L.icon({
      iconUrl: 'https://cdn-icons-png.flaticon.com/128/3063/3063176.png',
      iconSize: [30, 30],
      iconAnchor: [15, 30],
      popupAnchor: [0, -25],
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      shadowSize: [41, 41]
    });
    const baseIcon = L.icon({
      iconUrl: 'https://cdn-icons-png.flaticon.com/128/2614/2614724.png',
      iconSize: [30, 30],
      iconAnchor: [15, 30],
      popupAnchor: [0, -25],
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      shadowSize: [41, 41]
    });

    // Grupos
    const layerHospitais = L.layerGroup().addTo(mapa_relatorio_mapa_calor);
    const layerBases = L.layerGroup().addTo(mapa_relatorio_mapa_calor);
    const clusterGroup = L.markerClusterGroup({
      showCoverageOnHover: false,
      maxClusterRadius: 60
    });
    const layerCluster = clusterGroup.addTo(mapa_relatorio_mapa_calor);

    let layerHeat = L.heatLayer([], {
      radius: 25,
      blur: 15,
      maxZoom: 17
    });
    layerHeat.addTo(mapa_relatorio_mapa_calor);

    // Dados em memória
    let ocorrenciasData = []; // [{id, evento, subevento, cidade, lat, lng, ...}]
    let tiposAtivos = new Set(); // nomes de evento ativos (para filtrar heat e cluster)

    // =========================
    // Carregadores (Hospitais/Bases)
    // =========================
    async function loadHospitais() {
      try {
        const data = await fetchJSON(API_HOSPITAIS);
        layerHospitais.clearLayers();
        $('#listaHospitais').innerHTML = '';
        data.forEach(h => {
          const m = L.marker([parseFloat(h.latitude), parseFloat(h.longitude)], {
              icon: hospitalIcon,
            })
            .bindTooltip(`🏥 <b>${h.nome}</b>`);
          m.addTo(layerHospitais);

          const item = document.createElement('button');
          item.className = 'list-group-item list-group-item-action';
          item.textContent = h.nome;
          item.onclick = () => {
            mapa_relatorio_mapa_calor.setView([parseFloat(h.latitude), parseFloat(h.longitude)], 15);
          };
          $('#listaHospitais').appendChild(item);
        });
      } catch (e) {
        console.error('Hospitais:', e);
      }
    }

    async function loadBases() {
      try {
        const data = await fetchJSON(API_BASES); // Esperado: [{id, nome, lat, lng, endereco}]
        layerBases.clearLayers();
        $('#listaBases').innerHTML = '';
        data.forEach(b => {
          if (!b.latitude || !b.longitude) return;
          const m = L.marker([parseFloat(b.latitude), parseFloat(b.longitude)], {
              icon: baseIcon,
            })
            .bindTooltip(`🏥 Base <b>${b.nome}</b>`);
          m.addTo(layerBases);

          const item = document.createElement('button');
          item.className = 'list-group-item list-group-item-action';
          item.textContent = b.nome;
          item.onclick = () => {
            mapa_relatorio_mapa_calor.setView([parseFloat(b.latitude), parseFloat(b.longitude)], 15);
          };
          $('#listaBases').appendChild(item);
        });
      } catch (e) {
        console.error('Bases:', e);
      }
    }

    // =========================
    // Filtros (Cidades/Eventos/Subeventos)
    // =========================
    async function loadCidades() {
      const data = await fetchJSON(API_CIDADES);
      elCidade.innerHTML = '<option value="">— todas —</option>' + data.map(c => `<option value="${c.id}">${c.nome}</option>`).join('');
    }
    async function loadEventos() {
      const data = await fetchJSON(API_EVENTOS);
      elEvento.innerHTML = '<option value="">— todos —</option>' + data.map(e => `<option value="${e.id}">${e.nome}</option>`).join('');
    }
    async function loadSubeventos(eventoId) {
      if (!eventoId) {
        elSubevento.innerHTML = '<option value="">— todos —</option>';
        return;
      }
      const data = await fetchJSON(`${API_SUBEVENTOS}&eventoId=${encodeURIComponent(eventoId)}`);
      elSubevento.innerHTML = '<option value="">— todos —</option>' + data.map(s => `<option value="${s.id}">${s.nome}</option>`).join('');
    }

    elEvento.addEventListener('change', () => loadSubeventos(elEvento.value));

    // =========================
    // Ocorrências: busca e render
    // =========================
    async function buscarOcorrencias() {
      const query = buildQuery({
        eventoId: elEvento.value,
        subeventoId: elSubevento.value,
        cidadeId: elCidade.value,
        dataInicio: elInicio.value,
        dataFim: elFim.value
      });
      const url = `${API_OCORRENCIAS}&${query}`;
      const data = await fetchJSON(url);

      // Normaliza e guarda
      ocorrenciasData = data.map(o => ({
        id: o.id,
        evento: o.nome_evento,
        subevento: o.nome_subevento,
        cidade: o.cidade,
        lat: parseFloat(o.latitude),
        lng: parseFloat(o.longitude)
      })).filter(o => !Number.isNaN(o.lat) && !Number.isNaN(o.lng));

      // Atualiza lista de tipos (eventos) no painel de tipos ativos
      rebuildTiposAtivos();

      // Renderiza camadas
      renderCamadas();
    }

    function rebuildTiposAtivos() {
      // Paleta de cores (mesma usada nos pinos)
      const colorMap = {
        'Clínico': '#dc3545',
        'Trauma': '#0d6efd',
        'Acidente de Trânsito': '#ffc107',
        'Outro': '#6c757d',
        'Gineco-obstétrico': '#198754'
      };
      const allColors = [
        '#6610f2', '#fd7e14', '#20c997', '#d63384', '#0dcaf0',
        '#212529', '#adb5bd', '#ff66b3', '#ff9933', '#3399ff',
        '#33cc33', '#ff3333', '#9933ff', '#cc9933', '#669999'
      ];

      function getColor(tipo) {
        if (colorMap[tipo]) return colorMap[tipo];
        const tipos = Object.keys(colorMap);
        const idx = (tipos.indexOf(tipo) + tipos.length) % allColors.length;
        return allColors[idx];
      }

      // Agrupa ocorrências por tipo
      const contagem = {};
      ocorrenciasData.forEach(o => {
        if (!o.evento) return;
        contagem[o.evento] = (contagem[o.evento] || 0) + 1;
      });

      const tipos = Object.keys(contagem).sort();
      if (tiposAtivos.size === 0) tipos.forEach(t => tiposAtivos.add(t));

      tiposContainer.innerHTML = '';
      tipos.forEach(t => {
        const id = 'tipo-' + t.replace(/\\s+/g, '-');
        const cor = getColor(t);
        const total = contagem[t];
        const wrap = document.createElement('div');
        wrap.className = 'form-check d-flex align-items-center gap-2 mb-1';

        wrap.innerHTML = `
      <input class="form-check-input mt-0" type="checkbox" id="${id}" ${tiposAtivos.has(t) ? 'checked' : ''} style="flex-shrink:0;">
      <label class="form-check-label d-flex align-items-center gap-2" for="${id}" style="flex-grow:1;">
        <span style="width:12px;height:12px;border-radius:50%;background:${cor};display:inline-block;"></span>
        <span>${t} (${total})</span>
      </label>
    `;

        wrap.querySelector('input').addEventListener('change', (ev) => {
          if (ev.target.checked) tiposAtivos.add(t);
          else tiposAtivos.delete(t);
          renderCamadas();
        });

        tiposContainer.appendChild(wrap);
      });
    }


    function renderCamadas() {
      // Filtra por tipos ativos
      const pontos = ocorrenciasData.filter(o => tiposAtivos.has(o.evento));

      // Paleta de cores (até 20 tipos distintos)
      const colorMap = {
        'Clínico': '#dc3545', // vermelho
        'Trauma': '#0d6efd', // azul
        'Acidente de Trânsito': '#ffc107', // amarelo
        'Outro': '#6c757d', // cinza
        'Gineco-obstétrico': '#198754' // verde
      };

      // Se houver novos tipos, atribui cores automaticamente
      const allColors = [
        '#6610f2', '#fd7e14', '#20c997', '#d63384', '#0dcaf0',
        '#212529', '#adb5bd', '#ff66b3', '#ff9933', '#3399ff',
        '#33cc33', '#ff3333', '#9933ff', '#cc9933', '#669999'
      ];

      function getColor(tipo) {
        if (colorMap[tipo]) return colorMap[tipo];
        // Se não estiver mapeado, cria uma cor rotativa
        const tipos = Object.keys(colorMap);
        const idx = (tipos.indexOf(tipo) + tipos.length) % allColors.length;
        return allColors[idx];
      }

      function getMarkerIcon(color) {
        const svg = encodeURIComponent(`
      <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='32' height='32'>
        <path fill='${color}' stroke='white' stroke-width='2' d='M12 2C8 2 5 5.1 5 9.1c0 5.4 7 12.9 7 12.9s7-7.5 7-12.9C19 5.1 16 2 12 2z'/>
        <circle cx='12' cy='9' r='3' fill='white'/>
      </svg>
    `);
        return L.icon({
          iconUrl: `data:image/svg+xml,${svg}`,
          iconSize: [30, 42],
          iconAnchor: [15, 42],
          popupAnchor: [0, -40]
        });
      }

      // Atualiza Cluster
      layerCluster.clearLayers();
      if (chkCluster.checked) {
        pontos.forEach(p => {
          const color = getColor(p.evento);
          const icon = getMarkerIcon(color);
          const marker = L.marker([p.lat, p.lng], {
              icon,
            })
            .bindTooltip(`<b>${p.evento}</b>${p.subevento ? ' — ' + p.subevento : ''}`);
          layerCluster.addLayer(marker);
        });
      }

      // Atualiza Heatmap
      if (layerHeat) mapa_relatorio_mapa_calor.removeLayer(layerHeat);
      const heatPoints = pontos.map(p => [p.lat, p.lng, 0.6]);
      layerHeat = L.heatLayer(heatPoints, {
        radius: 25,
        blur: 15,
        maxZoom: 17
      });
      if (chkHeat.checked) layerHeat.addTo(mapa_relatorio_mapa_calor);
    }


    // Toggles
    chkHeat.addEventListener('change', renderCamadas);
    chkCluster.addEventListener('change', renderCamadas);
    chkHospitais.addEventListener('change', () => {
      if (chkHospitais.checked) {
        mapa_relatorio_mapa_calor.addLayer(layerHospitais);
      } else {
        mapa_relatorio_mapa_calor.removeLayer(layerHospitais);
      }
    });

    chkBases.addEventListener('change', () => {
      if (chkBases.checked) {
        mapa_relatorio_mapa_calor.addLayer(layerBases);
      } else {
        mapa_relatorio_mapa_calor.removeLayer(layerBases);
      }
    });


    // Botões
    btnAplicar.addEventListener('click', async () => {
      await buscarOcorrencias();
      fitAll();
    });
    btnLimpar.addEventListener('click', async () => {
      elCidade.value = '';
      elEvento.value = '';
      elSubevento.innerHTML = '<option value="">— todos —</option>';
      elInicio.value = '';
      elFim.value = '';
      tiposAtivos.clear();
      await buscarOcorrencias();
      fitAll();
    });

    function fitAll() {
      const layers = [];
      layerHospitais.eachLayer(l => layers.push(l));
      layerBases.eachLayer(l => layers.push(l));
      layerCluster.eachLayer(l => layers.push(l));
      if (layers.length) {
        const fg = L.featureGroup(layers);
        mapa_relatorio_mapa_calor.fitBounds(fg.getBounds().pad(0.2));
      }
    }

    // =========================
    // Boot
    // =========================
    (async () => {
      await Promise.all([loadCidades(), loadEventos()]);
      await loadHospitais();
      await loadBases();
      await buscarOcorrencias();
      fitAll();

      // Atualização opcional periódica
      setInterval(buscarOcorrencias, 30000); // 30s
      setInterval(loadHospitais, 5 * 60 * 1000); // 5min
      setInterval(loadBases, 5 * 60 * 1000); // 5min
    })();
  </script>
</body>

</html>
<style>
  div#kt_app_header,
  div#kt_app_footer {
    display: none;
  }

  div#kt_app_wrapper {
    margin-top: 0;
  }
</style>