console.log("main.js carregado ✅");

window.addEventListener("load", () => {
  document.body.classList.add("opacity-100");
  console.log("Classe opacity-100 aplicada");
})

window.verificaLogin = function (botao) {
  if (!window.usuarioLogado) {
    showLoginModal();
    return;
  }
  window.toggleFavorito(botao);
}

// Modal customizada para login/cadastro
function showLoginModal() {
  if (document.getElementById('login-modal')) return;
  const modal = document.createElement('div');
  modal.id = 'login-modal';
  modal.innerHTML = `
    <div class="modal-content">
  <button class="modal-close" title="Fechar">&times;</button>
  <img src="assets/imgs/logo_mbesportes new 2.png" alt="MB Esportes" style="max-width:120px;display:block;margin:0 auto 18px;border-radius:18px;">
      <h2>Você precisa estar logado para favoritar produtos!</h2>
      <br>
      <p>Faça o LOGIN ou CRIE UMA CONTA</p>
      <p>para começar a favoritar.</p>
      <br>
      <div class="modal-actions">
        <button id="btn-login">LOGIN</button>
        <button id="btn-cadastro">CRIAR CONTA</button>
      </div>
    </div>
    <style>
      #login-modal .modal-content {
        animation: modal-grow 0.7s cubic-bezier(.5,1.5,.5,1) forwards;
        position: relative;
      }
      @keyframes modal-grow {
        0% { transform: scale(0.7); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
      }
      #login-modal .modal-actions {
        flex-direction: column;
        gap: 12px;
      }
      #login-modal button {
        border-radius: 24px;
        border: none;
        padding: 12px 0;
        font-size: 1.1rem;
        font-family: inherit;
        font-weight: 600;
        background: #001329;
        color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.20);
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        width: 100%;
        outline: none;
      }
      #login-modal button:hover {
        background: #ED3814;
        transform: scale(1.05);
        color: rgba(0,0,0);
      }
      #login-modal .modal-close {
        position: absolute;
        top: 8px;
        right: 12px;
        background: transparent !important;
        border: none !important;
        font-size: 2rem;
        color: #001329;
        cursor: pointer;
        font-family: inherit;
        z-index: 2;
        transition: color 0.2s;
        box-shadow: none !important;
        padding: 0;
        width: 32px;
        height: 32px;
        line-height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      #login-modal .modal-close:hover {
        color: #ED3814;
        background: transparent !important;
        transform: none !important;
      }
    </style>
  `;
  modal.querySelector('.modal-close').onclick = function() {
    closeModalWithAnimation(modal);
  };
  // Permite fechar clicando fora do modal
  Object.assign(modal.style, {
    position: 'fixed',
    top: 0,
    left: 0,
    width: '100vw',
    height: '100vh',
    background: 'rgba(0,0,0,0.4)',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    zIndex: 9999
  });
  const content = modal.querySelector('.modal-content');
  Object.assign(content.style, {
    background: '#fff',
    padding: '32px 24px',
    borderRadius: '16px',
    boxShadow: '0 8px 32px rgba(0,0,0,0.25)',
    textAlign: 'center',
    minWidth: '320px',
    maxWidth: '90vw',
    fontFamily: 'inherit',
    margin: 0
  });
  const actions = modal.querySelector('.modal-actions');
  Object.assign(actions.style, {
    display: 'flex',
    marginTop: '24px',
    justifyContent: 'center',
    width: '100%'
  });
  modal.querySelector('#btn-login').onclick = function() {
    window.location.href = 'pages/login.php';
  };
  modal.querySelector('#btn-cadastro').onclick = function() {
    window.location.href = 'pages/cadastro.php';
  };
  document.body.appendChild(modal);
}

// Função para animação de saída do modal
function closeModalWithAnimation(modal) {
  const content = modal.querySelector('.modal-content');
  content.style.animation = 'modal-fadeout 0.5s cubic-bezier(.5,1.5,.5,1) forwards';
  modal.style.background = 'rgba(0,0,0,0.0)';
  setTimeout(() => {
    if (modal.parentNode) modal.parentNode.removeChild(modal);
  }, 500);
}

// Adiciona keyframes para fadeout
if (!document.getElementById('modal-fadeout-style')) {
  const style = document.createElement('style');
  style.id = 'modal-fadeout-style';
  style.innerHTML = `
    @keyframes modal-fadeout {
      0% { transform: scale(1); opacity: 1; }
      100% { transform: scale(0.7); opacity: 0; }
    }
  `;
  document.head.appendChild(style);
};

// Alternar/animar favorito
window.toggleFavorito = function (botao) {
  const icone = botao.querySelector('.heart-icon');
  const fav = botao.classList.toggle('favoritado');
  icone.textContent = fav ? '❤️' : '🤍';
};

// Animação do hero
window.addEventListener('load', () => {
  const hero = document.querySelector('.hero');
  setTimeout(() => hero?.classList.add('visible'), 400);
});


// Verificação de senhas no cadastro
window.addEventListener('DOMContentLoaded', () => {
  const senha = document.getElementById("senha");
  const confirmaSenha = document.getElementById("confirmaSenha");
  const botao = document.querySelector("button[type='submit']");

  if (senha && confirmaSenha && botao) {
    const msg = document.createElement("span");
    msg.classList.add("text-[#ed3814]", "text-sm", "mt-[-15px]", "mb-[10px]");
    confirmaSenha.parentNode.appendChild(msg);

    function validarSenhas() {
      if (senha.value && confirmaSenha.value) {
        if (senha.value !== confirmaSenha.value) {
          msg.textContent = "As senhas não conferem!";
          botao.disabled = true;
          botao.classList.add("opacity-50", "cursor-not-allowed");
        } else {
          msg.textContent = "";
          botao.disabled = false;
          botao.classList.remove("opacity-50", "cursor-not-allowed");
        }
      } else {
        msg.textContent = "";
        botao.disabled = false;
        botao.classList.remove("opacity-50", "cursor-not-allowed");
      }
    }

    senha.addEventListener("input", validarSenhas);
    confirmaSenha.addEventListener("input", validarSenhas);
  }
});

// Animação de fade-in ao carregar a página
window.addEventListener('load', () => {
  document.body.classList.remove('opacity-0');
  document.body.classList.add('opacity-100');
});

// Função para mostrar modal customizada
function mostrarModal(titulo, mensagem, urlRedirecionar) {
  const modal = document.getElementById("modal");
  const modalTitle = document.getElementById("modal-title");
  const modalMessage = document.getElementById("modal-message");
  const modalClose = document.getElementById("modal-close");

  modalTitle.textContent = titulo;
  modalMessage.textContent = mensagem;

  // Mostrar modal
  modal.classList.remove("opacity-0", "pointer-events-none");

  // Redirecionar automaticamente depois de 2 segundos
  const timer = setTimeout(() => {
    window.location.href = urlRedirecionar;
  }, 5000);

  // Fechar manualmente
  modalClose.onclick = () => {
    clearTimeout(timer);
    modal.classList.add("opacity-0", "pointer-events-none");
  };
}

window.addEventListener("load", () => {
  const params = new URLSearchParams(window.location.search);

  if (params.get("sucesso") === "1") {
    mostrarModal(
      "Conta Criada!",
      "Muito bom ter você cadastrado em nosso site. Você será redirecionado para a tela de login.",
      "../pages/login.php"
    );
  }

  if (params.get("erro") === "email") {
    mostrarModal(
      "Erro no cadastro!",
      "Já existe uma conta com esse e-mail.",
      "../pages/cadastro.php"
    );
  }

  if (params.get("erro") === "insert") {
    mostrarModal(
      "Erro inesperado!",
      "Não foi possível realizar o cadastro. Tente novamente.",
      "../pages/cadastro.php"
    );
  }

  // Login
  if (params.get("login") === "ok") {
    mostrarModal(
      "Bem-vindo!",
      "Login realizado com sucesso. Você será redirecionado para a tela inicial.",
      "../index.php"
    );
  }

  if (params.get("login") === "senha") {
    mostrarModal(
      "Erro!",
      "Senha incorreta. Tente novamente.",
      "../pages/login.php"
    );
  }

  if (params.get("login") === "nao_encontrado") {
    mostrarModal(
      "Erro!",
      "Nenhuma conta encontrada com esse e-mail.",
      "../pages/login.php"
    );
  }
});

document.addEventListener('DOMContentLoaded', () => {
    // Mensagem de sucesso
    const msg = document.getElementById('successMsg');
    if (msg) {
        setTimeout(() => {
            msg.style.opacity = 0;
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    }

    // Limpar formulário e remover parâmetro da URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success')) {
        const form = document.getElementById('produtoForm');
        if (form) form.reset();
        window.history.replaceState(null, null, window.location.pathname);
    }
});