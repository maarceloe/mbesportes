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
      <h2>Você precisa estar logado para favoritar produtos.</h2>
      <br>
      <p>Faça o login e comece a favoritar.</p>
      <p>ou</p>
      <p>Crie sua conta e tenha acesso ao site completo</p>
      <br>
      <div class="modal-actions">
        <button id="btn-login">Login</button>
        <button id="btn-cadastro">Cadastrar</button>
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
