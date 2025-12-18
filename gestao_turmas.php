<?php
// Simulação de dados para o motor de sugestão (em um ambiente real, viriam de um banco de dados)
$cursos = [
    ['id' => 'SIS', 'nome' => 'Desenvolvimento de Sistemas', 'eixo' => 'Tecnologia da Informação'],
    ['id' => 'IPI', 'nome' => 'Informática para Internet', 'eixo' => 'Tecnologia da Informação'],
    ['id' => 'ADM', 'nome' => 'Administração', 'eixo' => 'Gestão e Negócios'],
    ['id' => 'MEC', 'nome' => 'Mecânica Industrial', 'eixo' => 'Mecânica'],
];

$unidades_curriculares = [
    [
        'id' => 'logica',
        'nome' => 'Lógica de Programação',
        'curso_ids' => ['SIS', 'IPI'],
        'eixo' => 'Tecnologia da Informação',
        'competencias_requeridas' => ['lógica', 'algoritmos', 'pensamento computacional']
    ],
    [
        'id' => 'bd',
        'nome' => 'Banco de Dados Relacional',
        'curso_ids' => ['SIS'],
        'eixo' => 'Tecnologia da Informação',
        'competencias_requeridas' => ['sql', 'modelagem de dados', 'administração de banco']
    ],
    [
        'id' => 'gestao_projetos',
        'nome' => 'Gestão de Projetos e Scrum',
        'curso_ids' => ['SIS', 'ADM'],
        'eixo' => 'Gestão e Negócios',
        'competencias_requeridas' => ['gestão de projetos', 'scrum', 'liderança']
    ],
    [
        'id' => 'metrologia',
        'nome' => 'Metrologia Industrial',
        'curso_ids' => ['MEC'],
        'eixo' => 'Mecânica',
        'competencias_requeridas' => ['metrologia', 'processos industriais', 'qualidade']
    ],
];

$salas = [
    ['id' => 'LAB1', 'nome' => 'Laboratório de Informática 1', 'capacidade' => 32, 'recursos' => 'PCs, internet, projetor'],
    ['id' => 'LAB2', 'nome' => 'Laboratório de Informática 2', 'capacidade' => 28, 'recursos' => 'PCs, internet, projetor'],
    ['id' => 'SALA_ADM', 'nome' => 'Sala de Gestão', 'capacidade' => 35, 'recursos' => 'TV, mesas colaborativas'],
    ['id' => 'OFICINA_MEC', 'nome' => 'Oficina Mecânica', 'capacidade' => 20, 'recursos' => 'Máquinas e bancadas'],
];

$instrutores = [
    [
        'id' => 1,
        'nome' => 'Ana Paula Silva',
        'area_atuacao' => 'Tecnologia da Informação',
        'competencias' => ['lógica', 'sql', 'java', 'scrum', 'docência'],
        'matriz_competencia' => ['logica', 'bd', 'gestao_projetos'],
        'indisponibilidades' => [
            ['inicio' => '2024-08-01', 'termino' => '2025-07-29', 'turno' => 'MANHÃ', 'motivo' => 'Turma HT-SIS-01-24-M-12700'],
            ['inicio' => '2025-01-10', 'termino' => '2025-01-20', 'turno' => 'MANHÃ', 'motivo' => 'Férias programadas']
        ],
        'pode_fora_eixo' => true
    ],
    [
        'id' => 2,
        'nome' => 'Juliano Fernando da Silva',
        'area_atuacao' => 'Tecnologia da Informação',
        'competencias' => ['lógica', 'javascript', 'php', 'scrum'],
        'matriz_competencia' => ['logica', 'gestao_projetos'],
        'indisponibilidades' => [
            ['inicio' => '2024-08-15', 'termino' => '2025-02-20', 'turno' => 'TARDE', 'motivo' => 'HT-SIS-02-24-T-12711']
        ],
        'pode_fora_eixo' => true
    ],
    [
        'id' => 3,
        'nome' => 'João Carlos Oliveira',
        'area_atuacao' => 'Tecnologia da Informação',
        'competencias' => ['html', 'css', 'javascript', 'ux'],
        'matriz_competencia' => ['logica'],
        'indisponibilidades' => [
            ['inicio' => '2025-05-10', 'termino' => '2026-12-10', 'turno' => 'NOITE', 'motivo' => 'HT-IPI-01-N-12700']
        ],
        'pode_fora_eixo' => true
    ],
    [
        'id' => 4,
        'nome' => 'Maria Eduarda Santos',
        'area_atuacao' => 'Gestão e Negócios',
        'competencias' => ['gestão de projetos', 'liderança', 'marketing'],
        'matriz_competencia' => ['gestao_projetos'],
        'indisponibilidades' => [
            ['inicio' => '2024-08-01', 'termino' => '2025-07-29', 'turno' => 'MANHÃ', 'motivo' => 'HT-ADM-01-M-12700']
        ],
        'pode_fora_eixo' => false
    ],
    [
        'id' => 5,
        'nome' => 'Carlos Henrique Souza',
        'area_atuacao' => 'Mecânica',
        'competencias' => ['metrologia', 'usinagem', 'processos industriais'],
        'matriz_competencia' => ['metrologia'],
        'indisponibilidades' => [
            ['inicio' => '2024-10-10', 'termino' => '2025-06-30', 'turno' => 'NOITE', 'motivo' => 'HT-MEC-02-N-12800']
        ],
        'pode_fora_eixo' => false
    ],
    [
        'id' => 6,
        'nome' => 'Fernanda Lopes Martins',
        'area_atuacao' => 'Mecânica',
        'competencias' => ['metrologia', 'projetos CAD', 'solidworks'],
        'matriz_competencia' => ['metrologia'],
        'indisponibilidades' => [],
        'pode_fora_eixo' => true
    ],
    [
        'id' => 7,
        'nome' => 'Ricardo Almeida Pinto',
        'area_atuacao' => 'Elétrica',
        'competencias' => ['instrumentação', 'automação', 'lógica básica'],
        'matriz_competencia' => ['logica'],
        'indisponibilidades' => [],
        'pode_fora_eixo' => true
    ],
];

// Simulação de dados de turmas (em um ambiente real, viriam de um banco de dados)
$turmas = [
    [
        'id' => 1,
        'codigo_turma' => 'HT-SIS-01-24-M-12700',
        'curso_id' => 'SIS',
        'uc_id' => 'logica',
        'instrutor_id' => 1,
        'sala_id' => 'LAB1',
        'data_inicio' => '2024-08-01',
        'data_termino' => '2025-07-29',
        'turno' => 'MANHÃ',
        'num_alunos' => 30,
        'observacoes' => 'Turma com início imediato; mantém a mesma instrutora até o fim.'
    ],
    [
        'id' => 2,
        'codigo_turma' => 'HT-IPI-01-N-12700',
        'curso_id' => 'IPI',
        'uc_id' => 'logica',
        'instrutor_id' => 3,
        'sala_id' => 'LAB2',
        'data_inicio' => '2025-05-10',
        'data_termino' => '2026-12-10',
        'turno' => 'NOITE',
        'num_alunos' => 30,
        'observacoes' => 'Turma de Internet noturna; instrutor fixo salvo ausências.'
    ],
    [
        'id' => 3,
        'codigo_turma' => 'HT-ADM-01-M-12700',
        'curso_id' => 'ADM',
        'uc_id' => 'gestao_projetos',
        'instrutor_id' => 4,
        'sala_id' => 'SALA_ADM',
        'data_inicio' => '2024-08-01',
        'data_termino' => '2025-07-29',
        'turno' => 'MANHÃ',
        'num_alunos' => 22,
        'observacoes' => 'Turma administrativa com ênfase em gestão de projetos.'
    ],
    [
        'id' => 4,
        'codigo_turma' => 'HT-MEC-02-N-12800',
        'curso_id' => 'MEC',
        'uc_id' => 'metrologia',
        'instrutor_id' => 5,
        'sala_id' => 'OFICINA_MEC',
        'data_inicio' => '2024-10-10',
        'data_termino' => '2025-06-30',
        'turno' => 'NOITE',
        'num_alunos' => 20,
        'observacoes' => 'Turma de mecânica com alta carga prática.'
    ]
];

// Função para formatar data (opcional, para exibição)
function formatarData($data)
{
    return date('d/m/Y', strtotime($data));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Turmas - SENAI</title>
    <link rel="stylesheet" href="style_turmas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="logo.png" alt="Logo SENAI" class="sidebar-logo">
                <h3>Menu Principal</h3>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.html"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                    <li><a href="gestao_cursos.html"><i class="fas fa-book"></i> Gestão de Cursos</a></li>
                    <li><a href="gestao_turmas.php" class="active"><i class="fas fa-users"></i> Gestão de Turmas</a>
                    </li>
                    <li><a href="gestao_instrutores.php"><i class="fas fa-chalkboard-teacher"></i> Gestão de
                            Instrutores</a></li>
                    <li><a href="gestao_salas.php"><i class="fas fa-door-open"></i> Gestão de Salas</a></li>
                    <li><a href="gestao_empresas.php"><i class="fas fa-building"></i> Gestão de Empresas</a></li>
                    <li><a href="gestao_unidades_curriculares.php"><i class="fas fa-graduation-cap"></i> Gestão de
                            UCs</a></li>
                    <li><a href="calendario.php"><i class="fas fa-calendar-alt"></i> Calendário</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <button class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="main-header">
                <h1>Gestão de Turmas</h1>
                <button class="btn btn-primary" id="addTurmaBtn">
                    <i class="fas fa-plus-circle"></i> Adicionar Turma
                </button>
            </div>

            <section class="table-section">
                <h2>Lista de Turmas</h2>
                <div class="filter-section">
                    <label for="searchTurma">Pesquisar Turma:</label>
                    <input type="text" id="searchTurma" placeholder="Digite o código ou curso..."
                        class="search-input">
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código da Turma</th>
                                <th>Curso</th>
                                <th>Unidade Curricular</th>
                                <th>Instrutor</th>
                                <th>Sala</th>
                                <th>Data de Início</th>
                                <th>Data de Término</th>
                                <th>Turno</th>
                                <th>Nº de Alunos</th>
                                <th class="actions">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <div id="turmaModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="modalTitle">Adicionar Nova Turma</h2>
            <form id="turmaForm">
                <input type="hidden" id="turmaId">
                <div class="form-grid">
                <div class="form-group">
                    <label for="codigoTurma">Código da Turma:</label>
                    <input type="text" id="codigoTurma" required>
                </div>

                <div class="form-group">
                    <label for="dataInicio">Data de Início:</label>
                    <input type="date" id="dataInicio" required>
                </div>

                <div class="form-group">
                    <label for="dataTermino">Data de Término:</label>
                    <input type="date" id="dataTermino" required>
                </div>

                <div class="form-group">
                    <label for="turno">Turno:</label>
                    <select id="turno" required>
                        <option value="">Selecione o Turno</option>
                        <option value="MANHÃ">MANHÃ</option>
                        <option value="TARDE">TARDE</option>
                        <option value="NOITE">NOITE</option>
                        <option value="INTEGRAL">INTEGRAL</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="numAlunos">Número de Alunos:</label>
                    <input type="number" id="numAlunos" required>
                </div>
                <div class="form-group">
                    <label for="cursoSelect">Curso:</label>
                    <select id="cursoSelect" required>
                        <option value="">Selecione o Curso</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ucSelect">Unidade Curricular:</label>
                    <select id="ucSelect" required>
                        <option value="">Selecione a UC</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="salaSelect">Sala:</label>
                    <select id="salaSelect" required>
                        <option value="">Selecione a sala</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="instrutorSelect">Instrutor Preferencial:</label>
                    <select id="instrutorSelect" required>
                        <option value="">Aguarde sugestões inteligentes...</option>
                    </select>
                </div>
                </div>

                <div class="form-group">
                    <label for="observacoes">Observações:</label>
                    <textarea id="observacoes" rows="3" placeholder="Ex: turma fixa com substituição somente em ausências."></textarea>
                </div>

                <div class="smart-suggestion-panel">
                    <div class="info-card">
                        <div class="info-card__header">
                            <h3>Sugestão de Instrutor</h3>
                            <span class="pill" id="statusSugestao">Aguardando preenchimento</span>
                        </div>
                        <p id="resumoSugestao" class="muted-text">Preencha curso, UC, datas e turno para receber a recomendação ideal.</p>
                        <ul id="listaSugestoes" class="suggestion-list"></ul>
                        <button type="button" class="btn btn-primary btn-ghost" id="aplicarSugestaoBtn">
                            <i class="fas fa-magic"></i> Aplicar melhor sugestão
                        </button>
                    </div>
                    <div class="info-card warning">
                        <div class="info-card__header">
                            <h3>Conflitos e Ausências</h3>
                            <span class="pill pill-warning" id="statusConflitos">Sem avaliação</span>
                        </div>
                        <p id="resumoConflitos" class="muted-text">O sistema informará sobre turmas simultâneas ou férias do instrutor.</p>
                        <div id="detalhesConflitos" class="conflict-list"></div>
                        <button type="button" class="btn btn-secondary btn-ghost" id="buscarSubstitutoBtn">
                            <i class="fas fa-random"></i> Sugerir substituto livre
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Turma</button>
                <button type="button" class="btn btn-secondary" id="cancelBtn"><i class="fas fa-times-circle"></i>
                    Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        // Dados vindos do PHP para simulação
        let turmasData = <?php echo json_encode($turmas); ?>;
        let nextId = Math.max(...turmasData.map(t => t.id)) + 1;
        const instrutoresBase = <?php echo json_encode($instrutores); ?>;
        const cursosData = <?php echo json_encode($cursos); ?>;
        const ucsData = <?php echo json_encode($unidades_curriculares); ?>;
        const salasData = <?php echo json_encode($salas); ?>;
        let ultimaAvaliacao = [];

        // Elementos do DOM
        const turmaModal = document.getElementById('turmaModal');
        const addTurmaBtn = document.getElementById('addTurmaBtn');
        const closeButton = document.querySelector('#turmaModal .close-button');
        const cancelBtn = document.querySelector('#turmaModal #cancelBtn');
        const modalTitle = document.getElementById('modalTitle');
        const turmaForm = document.getElementById('turmaForm');

        const turmaIdInput = document.getElementById('turmaId');
        const codigoTurmaInput = document.getElementById('codigoTurma');
        const dataInicioInput = document.getElementById('dataInicio');
        const dataTerminoInput = document.getElementById('dataTermino');
        const turnoSelect = document.getElementById('turno');
        const numAlunosInput = document.getElementById('numAlunos');
        const cursoSelect = document.getElementById('cursoSelect');
        const ucSelect = document.getElementById('ucSelect');
        const salaSelect = document.getElementById('salaSelect');
        const instrutorSelect = document.getElementById('instrutorSelect');
        const observacoesTextarea = document.getElementById('observacoes');

        const statusSugestao = document.getElementById('statusSugestao');
        const resumoSugestao = document.getElementById('resumoSugestao');
        const listaSugestoes = document.getElementById('listaSugestoes');
        const statusConflitos = document.getElementById('statusConflitos');
        const resumoConflitos = document.getElementById('resumoConflitos');
        const detalhesConflitos = document.getElementById('detalhesConflitos');
        const aplicarSugestaoBtn = document.getElementById('aplicarSugestaoBtn');
        const buscarSubstitutoBtn = document.getElementById('buscarSubstitutoBtn');

        // Tabela e pesquisa
        const dataTableBody = document.querySelector('.data-table tbody');
        const searchTurmaInput = document.getElementById('searchTurma');

        // Funções utilitárias
        function formatDateForInput(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString + 'T00:00:00');
            const year = date.getFullYear();
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function formatDisplayDate(dateString) {
            if (!dateString) return '';
            const [year, month, day] = dateString.split('-');
            return `${day}/${month}/${year}`;
        }

        const getCursoById = (id) => cursosData.find(curso => curso.id === id);
        const getUcById = (id) => ucsData.find(uc => uc.id === id);
        const getInstrutorById = (id) => instrutoresBase.find(instrutor => instrutor.id === Number(id));
        const getSalaById = (id) => salasData.find(sala => sala.id === id);

        const periodosConflitantes = (inicioA, fimA, inicioB, fimB) => {
            if (!inicioA || !fimA || !inicioB || !fimB) return false;
            const inicio1 = new Date(inicioA);
            const fim1 = new Date(fimA);
            const inicio2 = new Date(inicioB);
            const fim2 = new Date(fimB);
            return inicio1 <= fim2 && fim1 >= inicio2;
        };

        function popularCursos() {
            cursoSelect.innerHTML = '<option value=\"\">Selecione o Curso</option>';
            cursosData.forEach(curso => {
                const option = document.createElement('option');
                option.value = curso.id;
                option.textContent = `${curso.nome} (${curso.eixo})`;
                cursoSelect.appendChild(option);
            });
        }

        function popularSalas() {
            salaSelect.innerHTML = '<option value=\"\">Selecione a sala</option>';
            salasData.forEach(sala => {
                const option = document.createElement('option');
                option.value = sala.id;
                option.textContent = `${sala.nome} • Capacidade ${sala.capacidade}`;
                salaSelect.appendChild(option);
            });
        }

        function popularUcs() {
            const cursoId = cursoSelect.value;
            ucSelect.innerHTML = '<option value=\"\">Selecione a UC</option>';
            ucsData
                .filter(uc => !cursoId || uc.curso_ids.includes(cursoId))
                .forEach(uc => {
                    const option = document.createElement('option');
                    option.value = uc.id;
                    option.textContent = `${uc.nome} (${uc.eixo})`;
                    ucSelect.appendChild(option);
                });
        }

        function popularInstrutoresSelect(selectedId = '') {
            const placeholder = instrutorSelect.value;
            instrutorSelect.innerHTML = '<option value=\"\">Selecione um instrutor ou use a sugestão</option>';
            instrutoresBase.forEach(instrutor => {
                const option = document.createElement('option');
                option.value = instrutor.id;
                option.textContent = `${instrutor.nome} • ${instrutor.area_atuacao}`;
                if (selectedId && Number(selectedId) === instrutor.id) {
                    option.selected = true;
                }
                instrutorSelect.appendChild(option);
            });
            if (placeholder && !selectedId) {
                instrutorSelect.value = placeholder;
            }
        }

        function compilarTurmaDraft() {
            return {
                codigo_turma: codigoTurmaInput.value,
                curso_id: cursoSelect.value,
                uc_id: ucSelect.value,
                sala_id: salaSelect.value,
                data_inicio: dataInicioInput.value,
                data_termino: dataTerminoInput.value,
                turno: turnoSelect.value,
                num_alunos: numAlunosInput.value ? Number(numAlunosInput.value) : null
            };
        }

        function avaliarInstrutorParaTurma(instrutor, turmaDraft) {
            const conflitos = [];
            let score = 0;

            const curso = getCursoById(turmaDraft.curso_id);
            const uc = getUcById(turmaDraft.uc_id);
            const compInstrutor = (instrutor.competencias || []).map(c => c.toLowerCase());
            const compRequeridas = (uc?.competencias_requeridas || []).map(c => c.toLowerCase());
            const matriz = instrutor.matriz_competencia || [];
            const atendeMatriz = matriz.includes(turmaDraft.uc_id);
            const atendeCompetencia = compRequeridas.some(req => compInstrutor.includes(req));

            if (uc && instrutor.area_atuacao === uc.eixo) {
                score += 30;
            } else if (instrutor.pode_fora_eixo && (atendeMatriz || atendeCompetencia)) {
                score += 15;
            } else if (uc) {
                score -= 10;
            }

            if (curso && instrutor.area_atuacao === curso.eixo) {
                score += 25;
            } else if (instrutor.pode_fora_eixo && (atendeMatriz || atendeCompetencia)) {
                score += 10;
            } else if (curso) {
                score -= 10;
            }

            if (atendeMatriz) score += 25;
            if (atendeCompetencia) score += 15;
            if (turmaDraft.turno === 'INTEGRAL') score -= 5; // leve penalização para turnos mais longos

            (instrutor.indisponibilidades || []).forEach(indisp => {
                const turnoConflitante = !indisp.turno || indisp.turno === turmaDraft.turno || indisp.turno === 'INTEGRAL' || turmaDraft.turno === 'INTEGRAL';
                if (periodosConflitantes(turmaDraft.data_inicio, turmaDraft.data_termino, indisp.inicio, indisp.termino) && turnoConflitante) {
                    conflitos.push(`${formatDisplayDate(indisp.inicio)} a ${formatDisplayDate(indisp.termino)} (${indisp.turno || 'Turno livre'}) - ${indisp.motivo}`);
                    score -= 40;
                }
            });

            turmasData.forEach(turma => {
                if (turma.instrutor_id === instrutor.id) {
                    const turnoConflitante = turma.turno === turmaDraft.turno || turma.turno === 'INTEGRAL' || turmaDraft.turno === 'INTEGRAL';
                    if (periodosConflitantes(turmaDraft.data_inicio, turmaDraft.data_termino, turma.data_inicio, turma.data_termino) && turnoConflitante) {
                        conflitos.push(`Já alocado na turma ${turma.codigo_turma} (${formatDisplayDate(turma.data_inicio)} a ${formatDisplayDate(turma.data_termino)} - ${turma.turno})`);
                        score -= 35;
                    }
                }
            });

            const destaques = [];
            if (atendeMatriz) destaques.push('UC na matriz de competência');
            if (atendeCompetencia) destaques.push('Competência aderente');
            if (instrutor.pode_fora_eixo && (atendeMatriz || atendeCompetencia) && uc && instrutor.area_atuacao !== uc.eixo) {
                destaques.push('Apto a atuar fora do eixo');
            }

            return {
                instrutor,
                score,
                disponivel: conflitos.length === 0,
                conflitos,
                destaques
            };
        }

        function atualizarSugestoes() {
            const turmaDraft = compilarTurmaDraft();
            const camposObrigatorios = [turmaDraft.curso_id, turmaDraft.uc_id, turmaDraft.data_inicio, turmaDraft.data_termino, turmaDraft.turno];

            if (camposObrigatorios.some(campo => !campo)) {
                statusSugestao.textContent = 'Aguardando preenchimento';
                resumoSugestao.textContent = 'Informe curso, UC, datas e turno para receber a sugestão de instrutor.';
                listaSugestoes.innerHTML = '';
                popularInstrutoresSelect(instrutorSelect.value);
                return;
            }

            const avaliacoes = instrutoresBase.map(instrutor => avaliarInstrutorParaTurma(instrutor, turmaDraft))
                .sort((a, b) => b.score - a.score);
            ultimaAvaliacao = avaliacoes;

            listaSugestoes.innerHTML = '';
            avaliacoes.slice(0, 3).forEach(avaliacao => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <div class="suggestion-row">
                        <div>
                            <strong>${avaliacao.instrutor.nome}</strong>
                            <span class="chip">${avaliacao.instrutor.area_atuacao}</span>
                        </div>
                        <span class="badge ${avaliacao.disponivel ? 'success' : 'danger'}">${avaliacao.disponivel ? 'Disponível' : 'Conflito'}</span>
                    </div>
                    <small class="muted-text">Pontuação: ${avaliacao.score} | ${avaliacao.destaques.join(', ') || 'Competências gerais'}</small>
                    ${avaliacao.conflitos.length ? `<small class="warning-text">Conflitos: ${avaliacao.conflitos.join(' | ')}</small>` : ''}
                `;
                listaSugestoes.appendChild(li);
            });

            const melhorDisponivel = avaliacoes.find(av => av.disponivel);
            if (melhorDisponivel) {
                statusSugestao.textContent = 'Instrutor sugerido';
                resumoSugestao.textContent = `Recomendamos ${melhorDisponivel.instrutor.nome} por compatibilidade com o curso/UC e agenda livre.`;
                popularInstrutoresSelect(melhorDisponivel.instrutor.id);
                if (!instrutorSelect.value) {
                    instrutorSelect.value = melhorDisponivel.instrutor.id;
                }
            } else {
                statusSugestao.textContent = 'Todos com conflito';
                resumoSugestao.textContent = 'Nenhum instrutor está livre no período selecionado. Ajuste datas ou aceite a melhor opção com conflito.';
                popularInstrutoresSelect(avaliacoes[0]?.instrutor.id);
            }
            atualizarConflitosSelecionado();
        }

        function atualizarConflitosSelecionado() {
            const turmaDraft = compilarTurmaDraft();
            const instrutorId = instrutorSelect.value;

            if (!instrutorId) {
                statusConflitos.textContent = 'Sem avaliação';
                resumoConflitos.textContent = 'Selecione um instrutor ou aplique a sugestão automática.';
                detalhesConflitos.innerHTML = '';
                return;
            }

            const avaliacao = (ultimaAvaliacao || []).find(av => av.instrutor.id === Number(instrutorId)) || avaliarInstrutorParaTurma(getInstrutorById(instrutorId), turmaDraft);
            if (!avaliacao) return;

            statusConflitos.textContent = avaliacao.disponivel ? 'Sem conflitos' : 'Conflitos identificados';
            resumoConflitos.textContent = avaliacao.disponivel
                ? `${avaliacao.instrutor.nome} está livre para o período informado.`
                : `${avaliacao.instrutor.nome} tem conflito no período selecionado.`;

            detalhesConflitos.innerHTML = '';
            if (avaliacao.conflitos.length) {
                const ul = document.createElement('ul');
                avaliacao.conflitos.forEach(conflito => {
                    const li = document.createElement('li');
                    li.textContent = conflito;
                    ul.appendChild(li);
                });
                detalhesConflitos.appendChild(ul);
            }
        }

        function aplicarMelhorSugestao() {
            if (!ultimaAvaliacao.length) {
                atualizarSugestoes();
                return;
            }
            const melhorDisponivel = ultimaAvaliacao.find(av => av.disponivel) || ultimaAvaliacao[0];
            if (melhorDisponivel) {
                instrutorSelect.value = melhorDisponivel.instrutor.id;
                atualizarConflitosSelecionado();
            }
        }

        function sugerirSubstituto() {
            if (!ultimaAvaliacao.length) {
                atualizarSugestoes();
                return;
            }
            const instrutorAtual = instrutorSelect.value;
            const alternativa = ultimaAvaliacao.find(av => av.disponivel && av.instrutor.id !== Number(instrutorAtual))
                || ultimaAvaliacao.find(av => av.instrutor.id !== Number(instrutorAtual));
            if (alternativa) {
                instrutorSelect.value = alternativa.instrutor.id;
                resumoConflitos.textContent = `Substituto sugerido: ${alternativa.instrutor.nome}.`;
                atualizarConflitosSelecionado();
            }
        }

        // --- Event Listeners para Abrir/Fechar Modal ---
        addTurmaBtn.onclick = () => {
            modalTitle.textContent = "Adicionar Nova Turma";
            turmaIdInput.value = '';
            turmaForm.reset();
            popularCursos();
            popularUcs();
            popularSalas();
            popularInstrutoresSelect();
            turmaModal.style.display = 'flex';
            document.body.classList.add('modal-open');
            atualizarSugestoes();
        };

        closeButton.onclick = () => {
            turmaModal.style.display = 'none';
            document.body.classList.remove('modal-open');
        };

        cancelBtn.onclick = () => {
            turmaModal.style.display = 'none';
            document.body.classList.remove('modal-open');
        };

        window.onclick = (event) => {
            if (event.target == turmaModal) {
                turmaModal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        };

        function updateTableDisplay(searchTerm = '') {
            dataTableBody.innerHTML = '';
            const filteredTurmas = turmasData.filter(turma => {
                const lowerCaseSearchTerm = searchTerm.toLowerCase();
                const codigoMatch = turma.codigo_turma?.toLowerCase().includes(lowerCaseSearchTerm);
                const cursoMatch = getCursoById(turma.curso_id)?.nome.toLowerCase().includes(lowerCaseSearchTerm);
                const ucMatch = getUcById(turma.uc_id)?.nome.toLowerCase().includes(lowerCaseSearchTerm);
                const instrutorMatch = getInstrutorById(turma.instrutor_id)?.nome.toLowerCase().includes(lowerCaseSearchTerm);
                return codigoMatch || cursoMatch || ucMatch || instrutorMatch;
            });

            if (filteredTurmas.length === 0) {
                const noDataRow = dataTableBody.insertRow();
                noDataRow.innerHTML = '<td colspan="11">Nenhuma turma encontrada.</td>';
                return;
            }

            filteredTurmas.forEach(turma => {
                const curso = getCursoById(turma.curso_id);
                const uc = getUcById(turma.uc_id);
                const instrutor = getInstrutorById(turma.instrutor_id);
                const sala = getSalaById(turma.sala_id);
                const row = dataTableBody.insertRow();
                row.innerHTML = `
                    <td>${turma.id}</td>
                    <td>${turma.codigo_turma}</td>
                    <td>${curso ? curso.nome : '-'}</td>
                    <td>${uc ? uc.nome : '-'}</td>
                    <td>${instrutor ? instrutor.nome : 'Não definido'}</td>
                    <td>${sala ? sala.nome : '-'}</td>
                    <td>${formatDisplayDate(turma.data_inicio)}</td>
                    <td>${formatDisplayDate(turma.data_termino)}</td>
                    <td>${turma.turno}</td>
                    <td>${turma.num_alunos}</td>
                    <td class="actions">
                        <button class="btn btn-icon btn-edit" title="Editar" data-id="${turma.id}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-icon btn-delete" title="Excluir" data-id="${turma.id}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                `;
            });
            attachTableActionListeners();
        }

        function attachTableActionListeners() {
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.onclick = (e) => openEditModal(e.currentTarget.dataset.id);
            });
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.onclick = (e) => deleteTurma(e.currentTarget.dataset.id);
            });
        }

        turmaForm.onsubmit = (event) => {
            event.preventDefault();
            const id = turmaIdInput.value;
            const newTurma = {
                id: id ? parseInt(id) : nextId++,
                codigo_turma: codigoTurmaInput.value,
                curso_id: cursoSelect.value,
                uc_id: ucSelect.value,
                instrutor_id: instrutorSelect.value ? parseInt(instrutorSelect.value) : null,
                sala_id: salaSelect.value,
                data_inicio: dataInicioInput.value,
                data_termino: dataTerminoInput.value,
                turno: turnoSelect.value,
                num_alunos: parseInt(numAlunosInput.value),
                observacoes: observacoesTextarea.value
            };

            if (id) {
                const index = turmasData.findIndex(t => t.id == id);
                if (index !== -1) {
                    turmasData[index] = newTurma;
                }
            } else {
                turmasData.push(newTurma);
            }

            updateTableDisplay(searchTurmaInput.value);
            turmaModal.style.display = 'none';
            document.body.classList.remove('modal-open');
        };

        function openEditModal(id) {
            const turma = turmasData.find(t => t.id == id);
            if (turma) {
                modalTitle.textContent = "Editar Turma";
                turmaIdInput.value = turma.id;
                codigoTurmaInput.value = turma.codigo_turma;
                dataInicioInput.value = formatDateForInput(turma.data_inicio);
                dataTerminoInput.value = formatDateForInput(turma.data_termino);
                turnoSelect.value = turma.turno;
                numAlunosInput.value = turma.num_alunos;
                observacoesTextarea.value = turma.observacoes || '';

                popularCursos();
                cursoSelect.value = turma.curso_id;
                popularUcs();
                ucSelect.value = turma.uc_id;
                popularSalas();
                salaSelect.value = turma.sala_id;
                popularInstrutoresSelect(turma.instrutor_id);

                turmaModal.style.display = 'flex';
                document.body.classList.add('modal-open');
                atualizarSugestoes();
            }
        }

        function deleteTurma(id) {
            const turma = turmasData.find(t => t.id == id);
            if (turma && confirm(`Tem certeza que deseja excluir a turma ${turma.codigo_turma}?`)) {
                turmasData = turmasData.filter(t => t.id != id);
                updateTableDisplay(searchTurmaInput.value);
            }
        }

        searchTurmaInput.addEventListener('keyup', (event) => updateTableDisplay(event.target.value));
        cursoSelect.addEventListener('change', () => { popularUcs(); atualizarSugestoes(); });
        ucSelect.addEventListener('change', atualizarSugestoes);
        dataInicioInput.addEventListener('change', atualizarSugestoes);
        dataTerminoInput.addEventListener('change', atualizarSugestoes);
        turnoSelect.addEventListener('change', atualizarSugestoes);
        instrutorSelect.addEventListener('change', atualizarConflitosSelecionado);
        aplicarSugestaoBtn.addEventListener('click', aplicarMelhorSugestao);
        buscarSubstitutoBtn.addEventListener('click', sugerirSubstituto);

        document.addEventListener('DOMContentLoaded', () => {
            popularCursos();
            popularUcs();
            popularSalas();
            popularInstrutoresSelect();
            updateTableDisplay(searchTurmaInput.value);
            atualizarSugestoes();
        });
    </script>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const dashboardContainer = document.querySelector('.dashboard-container');

        // Função para abrir/fechar o menu
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            dashboardContainer.classList.toggle('sidebar-active');
        });

        // Função para fechar o menu ao clicar fora dele
        dashboardContainer.addEventListener('click', (event) => {
            // Verifica se o clique foi fora da sidebar e do botão de toggle
            if (dashboardContainer.classList.contains('sidebar-active') && !sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                sidebar.classList.remove('active');
                dashboardContainer.classList.remove('sidebar-active');
            }
        });
    </script>
</body>

</html>
