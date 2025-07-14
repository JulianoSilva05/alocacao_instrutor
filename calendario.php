<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Calendário - SENAI</title>
    <link rel="stylesheet" href="style_turmas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos do modal (reutilizados das telas anteriores) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Estilos do calendário */
        .calendar-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .calendar-header button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #333;
            padding: 5px;
        }

        .calendar-header h2 {
            margin: 0;
            font-size: 1.8rem;
            color: #004d80;
        }

        .month-year-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .month-year-selects {
            display: flex;
            gap: 10px;
        }

        .calendar-filters {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: flex-start;
        }

        .calendar-filters select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .month-year-selects select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        /* Estilo para o novo campo de busca */
        .calendar-search {
            margin-bottom: 15px;
            width: 100%;
        }

        .calendar-search input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar-grid .day-name {
            font-weight: bold;
            color: #004d80;
            padding: 10px 0;
        }

        .calendar-grid .day {
            background-color: #f7f7f7;
            border-radius: 4px;
            padding: 15px 5px;
            min-height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
            position: relative;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .calendar-grid .day:hover {
            background-color: #e9e9e9;
        }

        .calendar-grid .day.today {
            background-color: #e0f2ff;
            border: 2px solid #007bff;
        }

        .calendar-grid .day.feriado {
            background-color: #ffe0e0;
            border: 2px solid #ff0000;
        }

        .calendar-grid .day .day-number {
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 5px;
        }

        .calendar-grid .day .event-tag {
            font-size: 0.75rem;
            font-weight: bold;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            text-align: left;
            padding: 2px 5px;
            border-radius: 3px;
        }

        .calendar-grid .day .feriado-tag {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Novas cores para os turnos */
        .calendar-grid .day .aula-manha {
            background-color: rgb(235, 255, 147);
            /* Verde claro */
            color: #155724;
        }

        .calendar-grid .day .aula-tarde {
            background-color: rgb(78, 203, 252);
            /* Verde um pouco mais escuro */
            color: #155724;
        }

        .calendar-grid .day .aula-noite {
            background-color: rgb(68, 96, 175);
            /* Verde mais escuro */
            color: rgb(255, 255, 255);
        }

        .calendar-grid .empty-day {
            background-color: #f7f7f7;
            visibility: hidden;
        }
    </style>
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
                    <li><a href="gestao_turmas.php"><i class="fas fa-users"></i> Gestão de Turmas</a></li>
                    <li><a href="gestao_instrutores.php"><i class="fas fa-chalkboard-teacher"></i> Gestão de Instrutores</a></li>
                    <li><a href="gestao_salas.php"><i class="fas fa-door-open"></i> Gestão de Salas</a></li>
                    <li><a href="gestao_empresas.php"><i class="fas fa-building"></i> Gestão de Empresas</a></li>
                    <li><a href="gestao_unidades_curriculares.php"><i class="fas fa-graduation-cap"></i> Gestão de UCs</a></li>
                    <li><a href="calendario.php" class="active"><i class="fas fa-calendar-alt"></i> Calendário</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <button class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
            </button>
            <header class="main-header">
                <h1>Calendário</h1>
            </header>

            <section class="calendar-container">
                <div class="calendar-header">
                    <div class="month-year-controls">
                        <button id="prevMonthBtn"><i class="fas fa-chevron-left"></i></button>
                        <div class="month-year-selects">
                            <select id="monthSelect"></select>
                            <select id="yearSelect"></select>
                        </div>
                        <button id="nextMonthBtn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <div class="calendar-filters">
                        <label for="areaFilter">Filtrar por Área:</label>
                        <select id="areaFilter">
                            <option value="all">Todas as Áreas</option>
                            <option value="Tecnologia da Informação">Tecnologia da Informação</option>
                            <option value="Eletroeletrônica">Eletroeletrônica</option>
                            <option value="Mecânica">Mecânica</option>
                            <option value="Gestão">Gestão</option>
                        </select>
                    </div>
                    <div class="calendar-search">
                        <input type="text" id="searchFilter" placeholder="Buscar por instrutor, curso, UC ou sala...">
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary" id="addFeriadoBtn"><i class="fas fa-plus-circle"></i> Feriado</button>
                        <button class="btn btn-secondary" id="addAulaBtn"><i class="fas fa-plus-circle"></i> Aula</button>
                    </div>
                </div>
                <div class="calendar-grid">
                    <div class="day-name">Dom</div>
                    <div class="day-name">Seg</div>
                    <div class="day-name">Ter</div>
                    <div class="day-name">Qua</div>
                    <div class="day-name">Qui</div>
                    <div class="day-name">Sex</div>
                    <div class="day-name">Sáb</div>
                </div>
            </section>
        </main>
    </div>

    <div id="feriadoModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="feriadoModalTitle">Adicionar Feriado</h2>
            <form id="feriadoForm">
                <div class="form-group">
                    <label for="feriadoDate">Data:</label>
                    <input type="date" id="feriadoDate" required>
                </div>
                <div class="form-group">
                    <label for="feriadoDescricao">Descrição:</label>
                    <textarea id="feriadoDescricao" rows="3" required></textarea>
                </div>
                <div class="btn-modal-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                    <button type="button" class="btn btn-secondary" id="cancelFeriadoBtn"><i class="fas fa-times-circle"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="aulaModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="aulaModalTitle">Adicionar Aula</h2>
            <form id="aulaForm">
                <div class="form-group">
                    <label for="aulaDate">Data:</label>
                    <input type="date" id="aulaDate" required>
                </div>
                <div class="form-group">
                    <label for="codigoTurma">Código da Turma:</label>
                    <input type="text" id="codigoTurma" required>
                </div>
                <div class="form-group">
                    <label for="nomeInstrutor">Nome do Instrutor:</label>
                    <input type="text" id="nomeInstrutor" required>
                </div>
                <div class="form-group">
                    <label for="sala">Sala:</label>
                    <input type="text" id="sala" required>
                </div>
                <div class="form-group">
                    <label for="unidadeCurricular">Unidade Curricular:</label>
                    <input type="text" id="unidadeCurricular" required>
                </div>
                <div class="form-group">
                    <label for="turno">Turno:</label>
                    <select id="turno" required>
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="area">Área:</label>
                    <select id="area" required>
                        <option value="Tecnologia da Informação">Tecnologia da Informação</option>
                        <option value="Eletroeletrônica">Eletroeletrônica</option>
                        <option value="Mecânica">Mecânica</option>
                        <option value="Gestão">Gestão</option>
                    </select>
                </div>
                <div class="btn-modal-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                    <button type="button" class="btn btn-secondary" id="cancelAulaBtn"><i class="fas fa-times-circle"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        const calendarGrid = document.querySelector('.calendar-grid');
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');
        const prevMonthBtn = document.getElementById('prevMonthBtn');
        const nextMonthBtn = document.getElementById('nextMonthBtn');

        const addFeriadoBtn = document.getElementById('addFeriadoBtn');
        const addAulaBtn = document.getElementById('addAulaBtn');

        const areaFilter = document.getElementById('areaFilter');
        // Novo elemento do filtro de busca
        const searchFilter = document.getElementById('searchFilter');

        const feriadoModal = document.getElementById('feriadoModal');
        const closeFeriadoBtn = feriadoModal.querySelector('.close-button');
        const cancelFeriadoBtn = feriadoModal.querySelector('#cancelFeriadoBtn');
        const feriadoForm = document.getElementById('feriadoForm');
        const feriadoDateInput = document.getElementById('feriadoDate');
        const feriadoDescricaoInput = document.getElementById('feriadoDescricao');

        const aulaModal = document.getElementById('aulaModal');
        const closeAulaBtn = aulaModal.querySelector('.close-button');
        const cancelAulaBtn = aulaModal.querySelector('#cancelAulaBtn');
        const aulaForm = document.getElementById('aulaForm');
        const aulaDateInput = document.getElementById('aulaDate');
        const codigoTurmaInput = document.getElementById('codigoTurma');
        const nomeInstrutorInput = document.getElementById('nomeInstrutor');
        const salaInput = document.getElementById('sala');
        const unidadeCurricularInput = document.getElementById('unidadeCurricular');
        const turnoInput = document.getElementById('turno');
        const areaInput = document.getElementById('area');

        let feriadosData = [{
                date: '2025-01-01',
                description: 'Confraternização Universal'
            },
            {
                date: '2025-04-18',
                description: 'Paixão de Cristo'
            },
            {
                date: '2025-04-21',
                description: 'Tiradentes'
            },
            {
                date: '2025-05-01',
                description: 'Dia do Trabalho'
            },
            {
                date: '2025-07-16',
                description: 'Nossa Senhora do Carmo (Betim)'
            },
            {
                date: '2025-09-07',
                description: 'Independência do Brasil'
            },
            {
                date: '2025-10-12',
                description: 'Nossa Senhora Aparecida'
            },
            {
                date: '2025-11-02',
                description: 'Finados'
            },
            {
                date: '2025-11-15',
                description: 'Proclamação da República'
            },
            {
                date: '2025-11-20',
                description: 'Dia da Consciência Negra'
            },
            {
                date: '2025-12-25',
                description: 'Natal'
            }
        ];
        let aulasData = [
            // --- Dados originais ---
            {
                date: '2025-07-01',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Algoritmos',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Circuitos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Desenho Técnico',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'GES-25D',
                instrutor: 'Mariana Lima',
                sala: 'Sala 15',
                uc: 'Marketing',
                turno: 'Manhã',
                area: 'Gestão'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Estruturas de Dados',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Eletrônica Digital',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Robótica',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'GES-25D',
                instrutor: 'Mariana Lima',
                sala: 'Sala 15',
                uc: 'Gestão Financeira',
                turno: 'Manhã',
                area: 'Gestão'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Banco de Dados',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Sistemas Embarcados',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Controle de Qualidade',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-14',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Redes de Computadores',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-14',
                codigoTurma: 'GES-25D',
                instrutor: 'Mariana Lima',
                sala: 'Sala 15',
                uc: 'Comunicação Empresarial',
                turno: 'Manhã',
                area: 'Gestão'
            },
            {
                date: '2025-07-15',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Automação Industrial',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-17',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Soldagem',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-17',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Desenvolvimento Web',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-18',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Manutenção de Equipamentos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-21',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Usinagem',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-21',
                codigoTurma: 'GES-25D',
                instrutor: 'Mariana Lima',
                sala: 'Sala 15',
                uc: 'Gestão de Projetos',
                turno: 'Manhã',
                area: 'Gestão'
            },
            {
                date: '2025-07-22',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Cybersegurança',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-23',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Comandos Elétricos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-24',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Fundamentos de Metrologia',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-25',
                codigoTurma: 'GES-25D',
                instrutor: 'Mariana Lima',
                sala: 'Sala 15',
                uc: 'Recursos Humanos',
                turno: 'Manhã',
                area: 'Gestão'
            },
            {
                date: '2025-07-28',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Inteligência Artificial',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-28',
                codigoTurma: 'GES-25D',
                instrutor: 'Mariana Lima',
                sala: 'Sala 15',
                uc: 'Liderança',
                turno: 'Manhã',
                area: 'Gestão'
            },
            {
                date: '2025-07-29',
                codigoTurma: 'ELE-25A',
                instrutor: 'João Carlos',
                sala: 'Lab. Eletr. 2',
                uc: 'Pneumática',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-30',
                codigoTurma: 'MEC-25C',
                instrutor: 'Felipe Dantas',
                sala: 'Oficina 3',
                uc: 'Hidráulica',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-31',
                codigoTurma: 'TI-25B',
                instrutor: 'Ana Paula',
                sala: 'Lab. Info 1',
                uc: 'Cloud Computing',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },

            // --- Novas aulas adicionadas para Manhã (Seg a Qui) ---
            {
                date: '2025-07-01',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Sistemas Operacionais',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Sistemas Operacionais',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Sistemas Operacionais',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Sistemas Operacionais',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Redes',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Redes',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Redes',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Redes',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-15',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Segurança da Informação',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-17',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Segurança da Informação',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-22',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Linguagem de Programação',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-23',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Linguagem de Programação',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-24',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Linguagem de Programação',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-29',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Cloud Computing',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-30',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Cloud Computing',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-31',
                codigoTurma: 'TI-M1',
                instrutor: 'João Silva',
                sala: 'Lab. Info 2',
                uc: 'Cloud Computing',
                turno: 'Manhã',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Fundamentos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Fundamentos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Fundamentos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Fundamentos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Eletrônica Analógica',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Eletrônica Analógica',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Eletrônica Analógica',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Eletrônica Analógica',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-15',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Instalações Elétricas',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-17',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Instalações Elétricas',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-22',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Automação',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-23',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Automação',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-24',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Automação',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-29',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Comandos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-30',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Comandos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-31',
                codigoTurma: 'ELE-M1',
                instrutor: 'Pedro Costa',
                sala: 'Sala 20',
                uc: 'Comandos Elétricos',
                turno: 'Manhã',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Processos de Usinagem',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Processos de Usinagem',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Processos de Usinagem',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Processos de Usinagem',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Soldagem Industrial',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Soldagem Industrial',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Soldagem Industrial',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Soldagem Industrial',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-15',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Metrologia',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-17',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Metrologia',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-22',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Pneumática',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-23',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Pneumática',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-24',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Pneumática',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-29',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Hidráulica',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-30',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Hidráulica',
                turno: 'Manhã',
                area: 'Mecânica'
            },
            {
                date: '2025-07-31',
                codigoTurma: 'MEC-M1',
                instrutor: 'Marcos Rocha',
                sala: 'Oficina 4',
                uc: 'Hidráulica',
                turno: 'Manhã',
                area: 'Mecânica'
            },

            // --- Novas aulas adicionadas para Tarde (Seg a Sex) ---
            {
                date: '2025-07-01',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'HTML e CSS',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'HTML e CSS',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'HTML e CSS',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'HTML e CSS',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'JavaScript',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'JavaScript',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'JavaScript',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'JavaScript',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-T1',
                instrutor: 'Fernanda Lima',
                sala: 'Lab. Info 3',
                uc: 'JavaScript',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Desenvolvimento Mobile',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Desenvolvimento Mobile',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Desenvolvimento Mobile',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Desenvolvimento Mobile',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Análise de Dados',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Análise de Dados',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Análise de Dados',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Análise de Dados',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-T2',
                instrutor: 'Rafael Santos',
                sala: 'Sala 12',
                uc: 'Análise de Dados',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'UX/UI Design',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'UX/UI Design',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'UX/UI Design',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'UX/UI Design',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'Gestão de TI',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'Gestão de TI',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'Gestão de TI',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'Gestão de TI',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-T3',
                instrutor: 'Camila Ferreira',
                sala: 'Lab. Info 4',
                uc: 'Gestão de TI',
                turno: 'Tarde',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Comandos Pneumáticos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Comandos Pneumáticos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Comandos Pneumáticos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Comandos Pneumáticos',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Eletrônica de Potência',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Eletrônica de Potência',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Eletrônica de Potência',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Eletrônica de Potência',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-T1',
                instrutor: 'Lucas Pereira',
                sala: 'Sala 21',
                uc: 'Eletrônica de Potência',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Controle de Sistemas',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Controle de Sistemas',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Controle de Sistemas',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Controle de Sistemas',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Microcontroladores',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Microcontroladores',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Microcontroladores',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Microcontroladores',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-T2',
                instrutor: 'Patrícia Gomes',
                sala: 'Lab. Eletr. 3',
                uc: 'Microcontroladores',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Instrumentação Eletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Instrumentação Eletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Instrumentação Eletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Instrumentação Eletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Manutenção Eletroeletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Manutenção Eletroeletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Manutenção Eletroeletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Manutenção Eletroeletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-T3',
                instrutor: 'Ricardo Alves',
                sala: 'Sala 22',
                uc: 'Manutenção Eletroeletrônica',
                turno: 'Tarde',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Mecânica dos Fluidos',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Mecânica dos Fluidos',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Mecânica dos Fluidos',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Mecânica dos Fluidos',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Termodinâmica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Termodinâmica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Termodinâmica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Termodinâmica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-T1',
                instrutor: 'Daniel Costa',
                sala: 'Oficina 5',
                uc: 'Termodinâmica',
                turno: 'Tarde',
                area: 'Mecânica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Elementos de Máquinas',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Elementos de Máquinas',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Elementos de Máquinas',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Elementos de Máquinas',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Fabricação Mecânica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Fabricação Mecânica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Fabricação Mecânica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Fabricação Mecânica',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-T2',
                instrutor: 'Bianca Oliveira',
                sala: 'Sala 30',
                uc: 'Fabricação Mecânica',
                turno: 'Tarde',
                area: 'Mecânica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Automação Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Automação Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Automação Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Automação Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Manutenção Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Manutenção Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Manutenção Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Manutenção Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-T3',
                instrutor: 'Gustavo Martins',
                sala: 'Oficina 6',
                uc: 'Manutenção Industrial',
                turno: 'Tarde',
                area: 'Mecânica'
            },

            // --- Novas aulas adicionadas para Noite (Seg a Sex) ---
            {
                date: '2025-07-01',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'Banco de Dados Avançado',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'Banco de Dados Avançado',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'Banco de Dados Avançado',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'Banco de Dados Avançado',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'DevOps',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'DevOps',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'DevOps',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'DevOps',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-N1',
                instrutor: 'Julia Ribeiro',
                sala: 'Lab. Info 5',
                uc: 'DevOps',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Segurança de Redes',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Segurança de Redes',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Segurança de Redes',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Segurança de Redes',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Inteligência Artificial',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Inteligência Artificial',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Inteligência Artificial',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Inteligência Artificial',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-N2',
                instrutor: 'Guilherme Castro',
                sala: 'Sala 13',
                uc: 'Inteligência Artificial',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Big Data',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Big Data',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Big Data',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Big Data',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Ciência de Dados',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Ciência de Dados',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Ciência de Dados',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Ciência de Dados',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'TI-N3',
                instrutor: 'Carolina Pires',
                sala: 'Lab. Info 6',
                uc: 'Ciência de Dados',
                turno: 'Noite',
                area: 'Tecnologia da Informação'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Circuitos Digitais',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Circuitos Digitais',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Circuitos Digitais',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Circuitos Digitais',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Sistemas de Potência',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Sistemas de Potência',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Sistemas de Potência',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Sistemas de Potência',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-N1',
                instrutor: 'Roberto Mendes',
                sala: 'Sala 23',
                uc: 'Sistemas de Potência',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Eletrônica Embarcada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Eletrônica Embarcada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Eletrônica Embarcada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Eletrônica Embarcada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Automação Predial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Automação Predial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Automação Predial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Automação Predial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-N2',
                instrutor: 'Tatiane Dias',
                sala: 'Lab. Eletr. 4',
                uc: 'Automação Predial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Eletrônica Industrial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Eletrônica Industrial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Eletrônica Industrial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Eletrônica Industrial',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Robótica Aplicada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Robótica Aplicada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Robótica Aplicada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Robótica Aplicada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'ELE-N3',
                instrutor: 'Bruno Teixeira',
                sala: 'Sala 24',
                uc: 'Robótica Aplicada',
                turno: 'Noite',
                area: 'Eletroeletrônica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Controle de Processos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Controle de Processos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Controle de Processos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Controle de Processos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Desenho Mecânico',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Desenho Mecânico',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Desenho Mecânico',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Desenho Mecânico',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-N1',
                instrutor: 'Andréia Souza',
                sala: 'Oficina 7',
                uc: 'Desenho Mecânico',
                turno: 'Noite',
                area: 'Mecânica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Manutenção de Máquinas',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Manutenção de Máquinas',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Manutenção de Máquinas',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Manutenção de Máquinas',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Materiais de Construção',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Materiais de Construção',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Materiais de Construção',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Materiais de Construção',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-N2',
                instrutor: 'Paulo Lima',
                sala: 'Sala 31',
                uc: 'Materiais de Construção',
                turno: 'Noite',
                area: 'Mecânica'
            },

            {
                date: '2025-07-01',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Resistência dos Materiais',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-02',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Resistência dos Materiais',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-03',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Resistência dos Materiais',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-04',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Resistência dos Materiais',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-07',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Sistemas Hidráulicos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-08',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Sistemas Hidráulicos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-09',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Sistemas Hidráulicos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-10',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Sistemas Hidráulicos',
                turno: 'Noite',
                area: 'Mecânica'
            },
            {
                date: '2025-07-11',
                codigoTurma: 'MEC-N3',
                instrutor: 'Luciana Gomes',
                sala: 'Oficina 8',
                uc: 'Sistemas Hidráulicos',
                turno: 'Noite',
                area: 'Mecânica'
            }
        ];


        function renderCalendar() {
            calendarGrid.innerHTML = `
                <div class="day-name">Dom</div>
                <div class="day-name">Seg</div>
                <div class="day-name">Ter</div>
                <div class="day-name">Qua</div>
                <div class="day-name">Qui</div>
                <div class="day-name">Sex</div>
                <div class="day-name">Sáb</div>
            `;

            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const numEmptyDays = firstDay.getDay();

            for (let i = 0; i < numEmptyDays; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.classList.add('empty-day');
                calendarGrid.appendChild(emptyDay);
            }

            for (let i = 1; i <= lastDay.getDate(); i++) {
                const day = document.createElement('div');
                day.classList.add('day');

                const dateString = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;

                let dayContent = `<span class="day-number">${i}</span>`;

                const feriado = feriadosData.find(f => f.date === dateString);
                if (feriado) {
                    day.classList.add('feriado');
                    dayContent += `<span class="event-tag feriado-tag" title="${feriado.description}">${feriado.description}</span>`;
                }

                // Lógica do filtro de busca
                const searchTerm = searchFilter.value.toLowerCase();

                const filteredAulas = aulasData.filter(a => {
                    const isSameDate = a.date === dateString;
                    const isSameArea = areaFilter.value === 'all' || a.area === areaFilter.value;

                    const matchesSearch = searchTerm === '' ||
                        a.instrutor.toLowerCase().includes(searchTerm) ||
                        a.codigoTurma.toLowerCase().includes(searchTerm) ||
                        a.uc.toLowerCase().includes(searchTerm) ||
                        a.sala.toLowerCase().includes(searchTerm);

                    return isSameDate && isSameArea && matchesSearch;
                });

                // Mapeia e organiza as aulas por turno
                const sortedAulas = filteredAulas.sort((a, b) => {
                    const order = {
                        'Manhã': 1,
                        'Tarde': 2,
                        'Noite': 3
                    };
                    return order[a.turno] - order[b.turno];
                });

                sortedAulas.forEach(aula => {
                    let turnoClass = '';
                    if (aula.turno === 'Manhã') {
                        turnoClass = 'aula-manha';
                    } else if (aula.turno === 'Tarde') {
                        turnoClass = 'aula-tarde';
                    } else if (aula.turno === 'Noite') {
                        turnoClass = 'aula-noite';
                    }
                    dayContent += `<span class="event-tag ${turnoClass}" title="Turno: ${aula.turno} | Instrutor: ${aula.instrutor} | Sala: ${aula.sala} | UC: ${aula.uc}">${aula.codigoTurma} (${aula.turno})</span>`;
                });

                const dayDate = new Date(currentYear, currentMonth, i);
                const isToday = dayDate.toDateString() === today.toDateString();
                if (isToday) {
                    day.classList.add('today');
                }

                day.innerHTML = dayContent;
                calendarGrid.appendChild(day);
            }
            updateHeader();
        }

        function updateHeader() {
            monthSelect.innerHTML = monthNames.map((name, index) =>
                `<option value="${index}" ${index === currentMonth ? 'selected' : ''}>${name}</option>`
            ).join('');

            yearSelect.innerHTML = '';
            for (let i = currentYear - 5; i <= currentYear + 5; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (i === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }
        }

        function openFeriadoModal() {
            feriadoModal.style.display = 'flex';
            document.body.classList.add('modal-open');
        }

        function closeFeriadoModal() {
            feriadoModal.style.display = 'none';
            document.body.classList.remove('modal-open');
            feriadoForm.reset();
        }

        function openAulaModal() {
            aulaModal.style.display = 'flex';
            document.body.classList.add('modal-open');
        }

        function closeAulaModal() {
            aulaModal.style.display = 'none';
            document.body.classList.remove('modal-open');
            aulaForm.reset();
        }

        addFeriadoBtn.addEventListener('click', openFeriadoModal);
        closeFeriadoBtn.addEventListener('click', closeFeriadoModal);
        cancelFeriadoBtn.addEventListener('click', closeFeriadoModal);

        feriadoForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const date = feriadoDateInput.value;
            const description = feriadoDescricaoInput.value;

            if (date && description) {
                feriadosData = feriadosData.filter(f => f.date !== date);
                feriadosData.push({
                    date,
                    description
                });
                currentYear = new Date(date).getFullYear();
                currentMonth = new Date(date).getMonth();
                renderCalendar();
                closeFeriadoModal();
            }
        });

        addAulaBtn.addEventListener('click', openAulaModal);
        closeAulaBtn.addEventListener('click', closeAulaModal);
        cancelAulaBtn.addEventListener('click', closeAulaModal);

        aulaForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const date = aulaDateInput.value;
            const codigoTurma = codigoTurmaInput.value;
            const nomeInstrutor = nomeInstrutorInput.value;
            const sala = salaInput.value;
            const unidadeCurricular = unidadeCurricularInput.value;
            const turno = turnoInput.value;
            const area = areaInput.value;

            if (date && codigoTurma && nomeInstrutor && sala && unidadeCurricular && turno && area) {
                aulasData.push({
                    date,
                    codigoTurma,
                    instrutor: nomeInstrutor,
                    sala,
                    uc: unidadeCurricular,
                    turno,
                    area
                });

                currentYear = new Date(date).getFullYear();
                currentMonth = new Date(date).getMonth();
                renderCalendar();
                closeAulaModal();
            }
        });

        window.onclick = (event) => {
            if (event.target == feriadoModal) {
                closeFeriadoModal();
            }
            if (event.target == aulaModal) {
                closeAulaModal();
            }
        };

        prevMonthBtn.addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        });

        nextMonthBtn.addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        });

        monthSelect.addEventListener('change', (e) => {
            currentMonth = parseInt(e.target.value);
            renderCalendar();
        });

        yearSelect.addEventListener('change', (e) => {
            currentYear = parseInt(e.target.value);
            renderCalendar();
        });

        areaFilter.addEventListener('change', () => {
            renderCalendar();
        });

        // Event listener para o novo campo de busca
        searchFilter.addEventListener('input', () => {
            renderCalendar();
        });

        document.addEventListener('DOMContentLoaded', renderCalendar);
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