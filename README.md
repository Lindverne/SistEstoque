<p align="center">
  <img src="public/assets/img/extras/SistEstoque.png" alt="SistEstoque Banner" width="100%" style="max-width: 920px; border-radius: 20px; box-shadow: 0 20px 60px rgba(1,22,30,0.35);">
</p>

<br>

<h1 align="center">📦 Projeto SistEstoque</h1>

<p align="center">
  <b>Sistema de Gerenciamento de Estoque de Produtos</b>
</p>

<br>

<p align="center">
  <img src="https://img.shields.io/badge/status-Conclu%C3%ADdo-100%25-27ae60?style=for-the-badge&logo=checkmarx&logoColor=white" alt="Status">
  <img src="https://img.shields.io/badge/version-1.0-124559?style=for-the-badge&logo=semver&logoColor=white" alt="Version">
  <img src="https://img.shields.io/badge/release-Julho%202026-01161e?style=for-the-badge&logo=calendar&logoColor=white" alt="Release">
</p>

<br>

<p align="center">
  <a href="#-sobre">📖 Sobre</a> <b>·</b>
  <a href="#-status">📌 Status</a> <b>·</b>
  <a href="#-funcionalidades">✨ Funcionalidades</a> <b>·</b>
  <a href="#-tech-stack">🛠 Tecnologias e Ferramentas</a> <b>·</b>
  <a href="#-arquitetura">🏗 Arquitetura</a> <b>·</b>
  <a href="#-executar">🚀 Executar</a> <b>·</b>
  <a href="#-banco">🗄 Banco</a> <b>·</b>
  <a href="#-api">🧭 API</a> <b>·</b>
  <a href="#-seguranca">🛡 Segurança</a> <b>·</b>
  <a href="#-desenvolvedores">👥 Devs</a> <b>·</b>
  <a href="#-agradecimentos">🙏 Agradecimentos</a>
</p>

<br>

---

<br>

<h2 id="-sobre" align="center">📖 Sobre</h2>

<p align="center">
  O <strong>SistEstoque</strong> é um projeto acadêmico desenvolvido na disciplina de <strong>Programação Web (PWE)</strong>, sob orientação do <strong>Professor Rafael Russi Zamboni</strong>. É um sistema web completo para <strong>gerenciamento de estoque de produtos</strong>, permitindo cadastrar, editar, listar e excluir itens com suporte a imagens, categorias, moedas e países de origem.
</p>

<p align="center">
  Através de uma interface moderna construída com <strong>Bootstrap 5</strong> e <strong>SweetAlert2</strong>, o sistema oferece uma experiência fluida com modais estilizados, drag-and-drop de imagens, cropper de foto de perfil via <strong>CropperJS</strong> e bandeiras de países via <strong>flag-icons</strong>. Do backend ao frontend, cada componente foi pensado para demonstrar boas práticas de desenvolvimento web com PHP vanilla.
</p>

<br>

<table align="center">
  <tr>
    <td align="center"><img src="https://img.shields.io/badge/-Trabalho%20Acad%C3%AAmico-PWE-124559?style=for-the-badge" alt="PWE"></td>
    <td align="center"><img src="https://img.shields.io/badge/-Conclu%C3%ADdo%20Julho%202026-27ae60?style=for-the-badge" alt="Concluído"></td>
    <td align="center"><img src="https://img.shields.io/badge/-PHP%20Vanilla-777BB4?style=for-the-badge" alt="PHP Vanilla"></td>
  </tr>
</table>

<br>

---

<br>

<h2 id="-status" align="center">📌 Status</h2>

<p align="center">
  <blockquote>
    <strong>Versão:</strong> 1.0 🎉<br>
    <strong>Lançamento:</strong> Julho de 2026<br>
    <strong>Status:</strong> Concluído ✅
  </blockquote>
</p>

<p align="center">
  O desenvolvimento do SistEstoque foi finalizado com todas as funcionalidades planejadas implementadas: autenticação, CRUD completo de produtos, gestão de perfil com upload e cropper de imagens, paginação, filtros e sistema de notificações com SweetAlert2.
</p>

<br>

<p align="center">
  <blockquote>
    🔔 <strong>Nota:</strong> A funcionalidade de <strong>recuperação de senha</strong> está sinalizada no frontend mas ainda não foi implementada no backend.
  </blockquote>
</p>

<br>

<p align="center">
  <img src="https://img.shields.io/badge/Auth%20%2B%20Cadastro-100%25-124559?style=for-the-badge" alt="Auth">
  <img src="https://img.shields.io/badge/CRUD%20Produtos-100%25-124559?style=for-the-badge" alt="CRUD">
  <img src="https://img.shields.io/badge/Upload%20%2B%20Cropper-100%25-124559?style=for-the-badge" alt="Upload">
  <img src="https://img.shields.io/badge/Pagina%C3%A7%C3%A3o%20%2B%20Filtros-100%25-124559?style=for-the-badge" alt="Filtros">
  <img src="https://img.shields.io/badge/Perfil%20%2B%20Dados-100%25-598392?style=for-the-badge" alt="Perfil">
</p>

<br>

---

<br>

<h2 id="-funcionalidades" align="center">✨ Funcionalidades</h2>

<br>

<table align="center">
  <tr>
    <td align="center" width="33%">
      <h3 align="center">🔐 Autenticação</h3>
      <p align="center">Login seguro com <strong>sessão PHP</strong>, cookie HTTP-only, mensagens de erro genéricas e <strong>password_hash()</strong> com bcrypt.</p>
    </td>
    <td align="center" width="33%">
      <h3 align="center">📦 CRUD Produtos</h3>
      <p align="center">Cadastro, edição, listagem e exclusão de produtos com <strong>10 categorias</strong>, 7 moedas e bandeiros de países.</p>
    </td>
    <td align="center" width="33%">
      <h3 align="center">📸 Upload de Imagens</h3>
      <p align="center">Upload local com <strong>drag-and-drop</strong> ou vinculação via URL externa. Pré-visualização em tempo real.</p>
    </td>
  </tr>
  <tr>
    <td align="center">
      <h3 align="center">👤 Perfil</h3>
      <p align="center">Foto de perfil com <strong>CropperJS</strong> (recorte quadrado 1:1), upload local ou URL. Alteração de nome e senha.</p>
    </td>
    <td align="center">
      <h3 align="center">📄 Paginação</h3>
      <p align="center">Lista paginada com <strong>5 itens por página</strong>, navegação completa e parâmetros via query string.</p>
    </td>
    <td align="center">
      <h3 align="center">🔍 Filtros</h3>
      <p align="center">Filtrar por <strong>ID, categoria e ordenação por preço</strong> (asc/desc). Combinação de filtros simultâneos.</p>
    </td>
  </tr>
  <tr>
    <td align="center">
      <h3 align="center">🎉 Notificações</h3>
      <p align="center"><strong>SweetAlert2</strong> em todas as ações — login, logout, cadastro, edição, exclusão, erros e sucesso.</p>
    </td>
    <td align="center">
      <h3 align="center">🏳 Bandeiras</h3>
      <p align="center">Helper com <strong>200+ países</strong> mapeados (PT, EN, JP) — exibe bandeira real do país de origem do produto.</p>
    </td>
    <td align="center">
      <h3 align="center">🖼 Preview de Imagem</h3>
      <p align="center">Modal de ampliação ao clicar na foto do produto na tabela, com <strong>zoom interativo</strong> e hover scale.</p>
    </td>
  </tr>
</table>

<br>

---

<br>

<h2 id="-tech-stack" align="center">🛠 Tecnologias e Ferramentas</h2>

<p align="center">
  Abaixo estão as principais tecnologias, linguagens, bibliotecas e ferramentas utilizadas no desenvolvimento do nosso sistema:
</p>

<br>

<h3 align="center">💻 Linguagens de Programação e Marcação</h3>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3">
</p>

<br>

<h3 align="center">🗄️ Banco de Dados</h3>

<p align="center">
  <img src="https://img.shields.io/badge/MariaDB-10.4-4479A1?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB">
</p>

<br>

<h3 align="center">📚 Bibliotecas e Componentes</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Bootstrap%205.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/SweetAlert2-7067CF?style=for-the-badge&logo=sweetalert2&logoColor=white" alt="SweetAlert2">
  <img src="https://img.shields.io/badge/CropperJS-6DB33F?style=for-the-badge&logoColor=white" alt="CropperJS">
  <img src="https://img.shields.io/badge/Font%20Awesome%206-528DD7?style=for-the-badge&logo=fontawesome&logoColor=white" alt="Font Awesome">
  <img src="https://img.shields.io/badge/Flag%20Icons-1a9e5c?style=for-the-badge&logoColor=white" alt="Flag Icons">
</p>

<br>

<h3 align="center">🧰 Ferramentas de Desenvolvimento</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Visual%20Studio%20Code-007ACC?style=for-the-badge&logo=visualstudiocode&logoColor=white" alt="Visual Studio Code">
  <img src="https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
  <img src="https://img.shields.io/badge/phpMyAdmin-6C78AF?style=for-the-badge&logo=phpmyadmin&logoColor=white" alt="phpMyAdmin">
  <img src="https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white" alt="XAMPP">
</p>

<br>

<h3 align="center">🔧 Back-end</h3>

<table align="center">
  <tr>
    <th align="center">Tecnologia</th>
    <th align="center">Aplicação</th>
  </tr>
  <tr>
    <td align="center"><strong>PHP 8.0</strong></td>
    <td align="center">Controllers organizados por ação — sem frameworks, roteamento manual</td>
  </tr>
  <tr>
    <td align="center"><strong>MySQLi</strong></td>
    <td align="center">Prepared Statements e conexão segura com MariaDB</td>
  </tr>
  <tr>
    <td align="center"><strong>Sessão PHP</strong></td>
    <td align="center">Autenticação com cookie HTTP-only e verificação em todas as páginas protegidas</td>
  </tr>
</table>

<br>

<h3 align="center">⚙️ Middleware</h3>

<table align="center">
  <tr>
    <th align="center">Arquivo</th>
    <th align="center">Função</th>
  </tr>
  <tr>
    <td align="center"><code>verificador.php</code></td>
    <td align="center">Função <code>VerificarLogin()</code> — redireciona para login se não houver sessão ativa</td>
  </tr>
</table>

<br>

---

<br>

<h2 id="-arquitetura" align="center">🏗 Arquitetura</h2>

<p align="center">
  O projeto segue uma arquitetura MVC simplificada, com separação clara entre camada de apresentação (PHP + HTML + Bootstrap), lógica de negócio (controllers PHP) e dados (MariaDB via MySQLi).
</p>

<br>

```
SistEstoque/
│
├── 📁 api/
│   ├── 📁 config/
│   ├── 📁 controllers/
│   ├── 📁 helpers/
│   └── 📁 middleware/
│
├── 📁 public/
│   ├── 📁 pages/
│   ├── 📁 components/
│   └── 📁 assets/
│       ├── 📁 css/
│       ├── 📁 js/
│       └── 📁 img/
│
└── 📁 database/
```

---

<br>

<h2 id="-executar" align="center">🚀 Executar</h2>

<p align="center">
  Siga os passos abaixo para rodar o SistEstoque no seu ambiente local.
</p>

<br>

<h3 align="center">📋 Pré-requisitos</h3>

<table align="center">
  <tr>
    <th align="center" width="50%">🪟 Windows / 🐧 Linux</th>
    <th align="center" width="50%">🍎 macOS</th>
  </tr>
  <tr>
    <td align="center"><b>XAMPP</b> (PHP 8.0+, MariaDB 10.4+)</td>
    <td align="center"><b>MAMP</b> ou <b>XAMPP</b> (PHP 8.0+, MariaDB 10.4+)</td>
  </tr>
  <tr>
    <td align="center">Servidor <b>Apache</b> rodando</td>
    <td align="center">Servidor <b>Apache</b> rodando</td>
  </tr>
  <tr>
    <td align="center"><b>phpMyAdmin</b> ou cliente MariaDB</td>
    <td align="center"><b>phpMyAdmin</b> ou cliente MariaDB</td>
  </tr>
</table>

<br>

<h3 align="center">👣 Passo a Passo</h3>

<br>

<details>
  <summary><strong>🪟 Windows</strong> (XAMPP em <code>C:\xampp\htdocs\</code>)</summary>

  <br>

  ```bash
  # 1️⃣ Clone o repositório
  git clone https://github.com/Lindverne/SistEstoque.git

  # 2️⃣ Mova para a pasta do XAMPP
  move SistEstoque C:\xampp\htdocs\

  # 3️⃣ Importe o banco de dados
  #    phpMyAdmin → Importar → database/projetoteste.sql

  # 4️⃣ Configure a conexão
  #    Edite api\config\conexao.php com suas credenciais MySQL/MariaDB

  # 5️⃣ Acesse no navegador
  #    http://localhost/SistEstoque/public/
  ```

</details>

<br>

<details>
  <summary><strong>🐧 Linux</strong> (XAMPP em <code>/opt/lampp/htdocs/</code>)</summary>

  <br>

  ```bash
  # 1️⃣ Clone o repositório
  git clone https://github.com/Lindverne/SistEstoque.git

  # 2️⃣ Mova para a pasta do XAMPP
  sudo mv SistEstoque /opt/lampp/htdocs/

  # 3️⃣ Importe o banco de dados
  #    phpMyAdmin (http://localhost/phpmyadmin) → Importar → database/projetoteste.sql

  # 4️⃣ Configure a conexão
  #    Edite api/config/conexao.php com suas credenciais MySQL/MariaDB

  # 5️⃣ Acesse no navegador
  #    http://localhost/SistEstoque/public/
  ```

</details>

<br>

<details>
  <summary><strong>🍎 macOS</strong> (MAMP em <code>/Applications/MAMP/htdocs/</code>)</summary>

  <br>

  ```bash
  # 1️⃣ Clone o repositório
  git clone https://github.com/Lindverne/SistEstoque.git

  # 2️⃣ Mova para a pasta do MAMP
  mv SistEstoque /Applications/MAMP/htdocs/

  # 3️⃣ Importe o banco de dados
  #    phpMyAdmin (http://localhost:8888/phpmyadmin) → Importar → database/projetoteste.sql

  # 4️⃣ Configure a conexão
  #    Edite api/config/conexao.php com suas credenciais MySQL/MariaDB

  # 5️⃣ Acesse no navegador
  #    http://localhost:8888/SistEstoque/public/
  ```

</details>

<br>

---

<br>

<h2 id="-banco" align="center">🗄 Banco de Dados</h2>

<p align="center">
  O SistEstoque utiliza <strong>2 tabelas</strong> no MariaDB, modeladas para suportar autenticação de usuários e gerenciamento completo de produtos:
</p>

<br>

<table align="center">
  <tr>
    <th align="center">Tabela</th>
    <th align="center">Descrição</th>
    <th align="center">Campos-chave</th>
  </tr>
  <tr>
    <td align="center">🔐 <code>login</code></td>
    <td align="center">Autenticação e perfil</td>
    <td align="center"><code>id</code>, <code>login</code>, <code>senha</code> (hash bcrypt), <code>foto_perfil</code></td>
  </tr>
  <tr>
    <td align="center">📦 <code>produtos</code></td>
    <td align="center">Catálogo de produtos</td>
    <td align="center"><code>id</code>, <code>nome</code>, <code>descricao</code>, <code>id_area</code>, <code>preco_uni</code>, <code>moeda</code>, <code>pais_origem</code>, <code>imagem</code></td>
  </tr>
</table>

<br>

<h3 align="center">🏷 Categorias de Produtos</h3>

<table align="center">
  <tr>
    <th align="center">ID</th>
    <th align="center">Categoria</th>
  </tr>
  <tr><td align="center">1</td><td align="center">Eletrodomésticos e Portáteis</td></tr>
  <tr><td align="center">2</td><td align="center">Áudio, Vídeo e Eletrônicos</td></tr>
  <tr><td align="center">3</td><td align="center">Moda, Calçados e Acessórios</td></tr>
  <tr><td align="center">4</td><td align="center">Informática e Celulares</td></tr>
  <tr><td align="center">5</td><td align="center">Livros, HQs e Mangás</td></tr>
  <tr><td align="center">6</td><td align="center">Beleza e Cuidados Pessoais</td></tr>
  <tr><td align="center">7</td><td align="center">Casa, Decoração e Banho</td></tr>
  <tr><td align="center">8</td><td align="center">Esporte e Lazer</td></tr>
  <tr><td align="center">9</td><td align="center">Brinquedos e Jogos</td></tr>
  <tr><td align="center">10</td><td align="center">Ferramentas e Manutenção</td></tr>
</table>

<br>

<h3 align="center">💱 Moedas Suportadas</h3>

<p align="center">
  <img src="https://img.shields.io/badge/BRL-R%24%20Real-27ae60?style=flat-square" alt="BRL">
  <img src="https://img.shields.io/badge/USD-US%24%20D%C3%B3lar-2980b9?style=flat-square" alt="USD">
  <img src="https://img.shields.io/badge/EUR-%E2%82%AC%20Euro-f39c12?style=flat-square" alt="EUR">
  <img src="https://img.shields.io/badge/JPY-%C2%A5%20Iene-e74c3c?style=flat-square" alt="JPY">
  <img src="https://img.shields.io/badge/KRW-%E2%82%A9%20Won-8e44ad?style=flat-square" alt="KRW">
  <img src="https://img.shields.io/badge/CNY-%C2%A5%20Yuan-e67e22?style=flat-square" alt="CNY">
  <img src="https://img.shields.io/badge/GBP-%C2%A3%20Libra-1abc9c?style=flat-square" alt="GBP">
</p>

<br>

---

<br>

<h2 id="-api" align="center">🧭 Controllers (Backend)</h2>

<p align="center">
  O backend do SistEstoque é organizado em <strong>controllers PHP</strong> — cada arquivo trata uma ação específica, com validação de sessão e respostas via redirect:
</p>

<br>

<details>
  <summary><strong>🔐 Autenticação</strong> (4 endpoints — público)</summary>

  <br>

  | Método | Endpoint | Descrição |
  |:-------|:---------|:----------|
  | GET | <code>/public/index.php</code> | Router — redireciona para login ou lista com base na sessão |
  | POST | <code>/api/controllers/doLogin.php</code> | Login — valida credenciais com <code>password_verify()</code> |
  | POST | <code>/api/controllers/doCadastro.php</code> | Registro — cria conta com <code>password_hash()</code> |
  | GET | <code>/api/controllers/logout.php</code> | Logout — destrói sessão e limpa cookie |

</details>

<br>

<details>
  <summary><strong>📦 Produtos</strong> (3 endpoints — requer sessão)</summary>

  <br>

  | Método | Endpoint | Descrição |
  |:-------|:---------|:----------|
  | POST | <code>/api/controllers/doCadastro_produtos.php</code> | Cadastra produto com upload de imagem |
  | POST | <code>/api/controllers/doEditar.php</code> | Atualiza produto (mantém imagem atual se não enviar nova) |
  | GET | <code>/api/controllers/excluir.php</code> | Deleta produto por ID |

</details>

<br>

<details>
  <summary><strong>👤 Perfil</strong> (2 endpoints — requer sessão)</summary>

  <br>

  | Método | Endpoint | Descrição |
  |:-------|:---------|:----------|
  | POST | <code>/api/controllers/atualizarPerfil.php</code> | Atualiza foto de perfil (upload local ou URL) |
  | POST | <code>/api/controllers/atualizarDadosUsuario.php</code> | Atualiza nome de usuário e/ou senha |

</details>

<br>

<details>
  <summary><strong>📤 Upload</strong> (1 helper)</summary>

  <br>

  | Arquivo | Descrição |
  |:--------|:----------|
  | <code>/api/controllers/upload_helper.php</code> | Funções <code>salvarImagemLocal()</code> e <code>baixarImagemDaUrl()</code> — usa <code>uniqid()</code> para nomes únicos |

</details>

<br>

> 📊 **Total: 9 endpoints** em 4 módulos — 4 públicos, 5 protegidos por sessão.

<br>

---

<br>

<h2 id="-seguranca" align="center">🛡 Segurança</h2>

<br>

<table align="center">
  <tr>
    <td width="50%">
      <h3 align="center">🔒 Prepared Statements</h3>
      <p align="center">95% das queries com MySQLi prepared statements — proteção contra SQL injection na maioria dos endpoints.</p>
    </td>
    <td width="50%">
      <h3 align="center">🔑 Senhas com bcrypt</h3>
      <p align="center"><code>password_hash()</code> + <code>password_verify()</code> — armazenamento seguro com custo adaptativo.</p>
    </td>
  </tr>
  <tr>
    <td>
      <h3 align="center">🍪 Sessão Segura</h3>
      <p align="center">Cookie HTTP-only, sessão verificada em todas as páginas protegidas via middleware.</p>
    </td>
    <td>
      <h3 align="center">🚫 Controle Server-side</h3>
      <p align="center">Acesso verificado no servidor — páginas protegidas redirecionam se não há sessão.</p>
    </td>
  </tr>
  <tr>
    <td>
      <h3 align="center">🛑 Mensagem Genérica</h3>
      <p align="center">"Usuário ou senha incorretos!" — sem vazar qual campo está errado.</p>
    </td>
    <td>
      <h3 align="center">✅ Validação de Existência</h3>
      <p align="center">Cadastro verifica se o nome de usuário já existe antes de inserir no banco.</p>
    </td>
  </tr>
</table>

<br>

<p align="center">
  <blockquote>
    ℹ️ Erros de banco são tratados internamente — mensagens amigáveis via SweetAlert2, sem expor detalhes técnicos ao usuário.
  </blockquote>
</p>

<br>

---

<br>

<h2 id="-desenvolvedores" align="center">👥 Desenvolvedores</h2>

<p align="center">
  O <strong>SistEstoque</strong> foi desenvolvido como trabalho acadêmico da disciplina de <strong>Programação Web (PWE)</strong>, sob orientação do <strong>Professor Rafael Russi Zamboni</strong>.
</p>

<br>

<table align="center">
  <thead>
    <tr>
      <th align="center" width="120">Integrante</th>
      <th align="left">Nome</th>
      <th align="center" width="320">Responsabilidade</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="center" valign="middle">
        <img src="public/assets/img/extras/julio.png" width="96" height="96" alt="Julio Cesar">
      </td>
      <td valign="middle"><strong>Julio Cesar Borges Leandro</strong></td>
      <td align="center" valign="middle">
        <img src="https://img.shields.io/badge/📱%20Desenvolvimento%20e%20Testes-598392?style=for-the-badge" alt="Desenvolvimento e Testes">
      </td>
    </tr>
    <tr>
      <td align="center" valign="middle">
        <img src="public/assets/img/extras/guedes.png" width="96" height="96" alt="Matheus Guedes">
      </td>
      <td valign="middle"><strong>Matheus Guedes</strong></td>
      <td align="center" valign="middle">
        <img src="https://img.shields.io/badge/💻%20Desenvolvimento%20Full%20Stack-124559?style=for-the-badge" alt="Desenvolvimento Full Stack">
      </td>
    </tr>
  </tbody>
</table>

<br>

---

<br>


<p align="center">
  <img src="public/assets/img/extras/sticker.webp" width="120" alt="SistEstoque" style="border-radius: 16px;">
</p>

<h3 align="center">
  📦 Gerenciamento inteligente de estoque com PHP, Bootstrap e boas práticas. Um Projeto de Programação Web (PWE).
</h3>

<br>

<p align="center">
  <img src="https://img.shields.io/badge/GitHub-01161e?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
</p>
