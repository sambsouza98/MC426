# MC426

Projeto de Engenharia de Software MC426

Alunos:
Gabriela Vitoria Rezzo de Souza
Erick Kussumoto do Nascimento
Samuel Batista de Souza
Rafael Scherer
Caio Augusto Nolasco

Proposta:
   Fazer um sistema de gerenciamento de hospitais, onde existirão cadastros de pacientes, médicos e hospitais.
   Pacientes poderão se cadastrar, solicitar agendamento, visualizar seus diagnósticos e serem notificados de consultas agendadas próximas.
   Hospitais poderão se cadastrar, cadastrar médicos e alocar solicitaçoes de pacientes a médicos;
   Médicos poderão relacionar exames e doencas aos pacientes e preescrever medicamentos relacionados ao diagnóstico e a data da consulta.
   
Tabelas:
   Entidades:
     Paciente (CPF, Nome, email, Telefone, dataDeNascimento, Convenio, Sexo, TipoSanguineo, Alergias, idUsuario)
     Hospital (CNPJ, Nome, Telefone, email, Endereco, dataDeAbertura, dataDeFechamento, Status, conveniosAceitos, idUsuario)
     Medicos (CRM, CPF, Nome, Especializacao, Telefone, email, idUsuario)
     Usuario (idUsuario, email, senha, tipoUsuario, dataDeInclusao)
     
   Relacionamentos:
     Agendamentos (idAgendamento, Paciente[CPF], Hospital[CNPJ], medico[CRM], dataDaConsulta, dataDeSolicitacao, status).
     Consultas (idAgendamento, medicamento, exame, doenca, tipoConsulta).
     MedicosHospitais (medico[CRM], hospital[CNPJ], dataDeAdmissao, dataDeSaida, status, turno{Sprint2}).
     
Admins:
   Ao realizar o cadastro de um hospital, o mesmo fica pendente para que um admin verifique se o hospital é valido e conclua seu cadastro.
     
 Prototipo:
    Tela de cadastro (Paciente, Hospital)
    Tela de login
    Tela do Paciente
       Marcar Consulta
       Visualizar Diagnosticos
       Acessar seus exames
       Alterar dados cadastrais
       Visualizar Agendamentos
    Tela do Hospital
       Gerenciar Funcionarios
       Alterar dados cadastrais
       Solicitacoes Pendentes
       Visualizar Agendamentos
    Tela do Medico
       dados cadastrais
       pacientes/agendamentos
    Tela de Contato com os admin
       Formulario para solicitar alguma coisa aos admins (Por exemplo alterar PK digitada de maneira incorreta)
    Tela do Admin
       Solicitacoes (Onde possivelmente haverá um botao para alterar os dados do usuário e um botao para marcar como resolvido)
       Validacao de hospitais

Proximas sprints:
   Turnos de trabalho dos medicos
   Bloqueio de seguranca para agendamento de pacientes (menos de 14 dias enviar comprovante tipo foto de RG)
   Inserir novos funcionarios no hospital (Enfermeiro)
   UTI
   Localizacao de pacientes para encontrar hospitais proximos
   Alerta de Consultas proximas para pacientes
   Gerar arquivos PDF com os dados da consulta e dos exames
   Tentar abstrair de um exame físico (no papel)
