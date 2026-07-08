<footer class="mainfooter mt-auto py-5 bg-light">
  <div class="container text-center">
    <p class="uppertext d-block">© Copyright 2026 The PARC Foundation, Inc</p>
    <p class="lowertext d-block">
     DSWD-SB-RL-2025-000171 
     <br><br>
     Valid for three (3) years covering the period 11/6/2025 to 11/6/2028, unless suspended or
     revoked before its expiration. <br><br>
     Issued on the 6th day of November 2025 in Quezon City, Philippines.
    </p>
  </div>
</footer>

<!-- ── Scroll to Top Button ── -->
<button id="scroll-to-top" title="Back to top" aria-label="Back to top">
  <i class="bi bi-arrow-up"></i>
</button>

<!-- ── Floating Chat Widget ── -->
<div id="chat-widget-container">
  <!-- Chat Card (Greeting) -->
  <div id="chat-card">
    <div class="chat-card-header">
      <img src="{{ asset('assets/logo/parclogosquare.png') }}" alt="PARC Logo" class="chat-avatar">
      <div class="chat-header-info">
        <span class="chat-title">The PARC Foundation</span>
        <span class="chat-status"><span class="status-dot"></span> Typically replies in minutes</span>
      </div>
      <button id="close-chat" aria-label="Close chat">&times;</button>
    </div>
    <div class="chat-card-body">
      <p class="chat-greeting">Hi there! 👋 How can we help you today? Click the button below to start chatting with us directly on Facebook Messenger.</p>
      <a href="https://m.me/parcph" target="_blank" class="chat-cta-btn">
        <i class="bi bi-messenger"></i> Start Chat
      </a>
    </div>
  </div>

  <!-- Floating Button -->
  <button id="messenger-widget" title="Chat with us" aria-label="Chat with us">
    <i class="bi bi-messenger"></i>
  </button>
</div>

<style>
  #scroll-to-top {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #f78f1e;
    color: #fff;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(12px);
    transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease;
    z-index: 9999;
  }

  #scroll-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  #scroll-to-top:hover {
    background: #e07a0a;
    transform: translateY(-3px);
  }

  @media (max-width: 991px) {
    #scroll-to-top {
      width: 44px;
      height: 44px;
      font-size: 0.95rem;
      bottom: 16px;
      right: 54px;
    }
  }

  #chat-widget-container {
    position: fixed;
    bottom: 96px;
    right: 32px;
    z-index: 9999;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  }

  #messenger-widget {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #006aff 0%, #00b2fe 100%);
    color: #fff;
    font-size: 1.5rem;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }

  #messenger-widget:hover {
    transform: scale(1.08) translateY(-2px);
  }

  #chat-card {
    position: absolute;
    bottom: 60px;
    right: 0;
    width: 300px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(0,0,0,0.08);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.95);
    transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), visibility 0.3s ease;
  }

  #chat-card.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
  }

  .chat-card-header {
    background: linear-gradient(135deg, #006aff 0%, #00b2fe 100%);
    color: #fff;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    position: relative;
    text-align: left;
  }

  .chat-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #fff;
    padding: 2px;
    margin-right: 10px;
    object-fit: cover;
  }

  .chat-header-info {
    display: flex;
    flex-direction: column;
  }

  .chat-title {
    font-weight: 600;
    font-size: 0.9rem;
  }

  .chat-status {
    font-size: 0.7rem;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .status-dot {
    width: 6px;
    height: 6px;
    background-color: #2ecc71;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 8px #2ecc71;
  }

  #close-chat {
    position: absolute;
    top: 8px;
    right: 12px;
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.4rem;
    cursor: pointer;
    line-height: 1;
  }

  #close-chat:hover {
    color: #fff;
  }

  .chat-card-body {
    padding: 16px;
    background: #fff;
    text-align: left;
  }

  .chat-greeting {
    font-size: 0.85rem;
    color: #4a4a4a;
    line-height: 1.4;
    margin-bottom: 16px;
  }

  .chat-cta-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #006aff;
    color: #fff;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.2s ease;
    box-shadow: 0 4px 12px rgba(0, 106, 255, 0.2);
  }

  .chat-cta-btn:hover {
    background: #0056d6;
    color: #fff;
    transform: translateY(-1px);
  }

  @media (max-width: 991px) {
    #chat-widget-container {
      bottom: 76px;
      right: 54px;
    }
    #messenger-widget {
      width: 44px;
      height: 44px;
      font-size: 1.3rem;
    }
    #chat-card {
      width: 270px;
      bottom: 56px;
    }
  }
  /* Main Footer Container */
.mainfooter {
  background-color: #f8f9fa; /* Soft light gray matching 'bg-light' */
  border-top: 1px solid #e9ecef; /* Subtle top border for definition */
  font-family: 'Helvetica Neue', Arial, sans-serif; /* Clean sans-serif font */
}

/* Container spacing adjustment */
.mainfooter .container {
  max-width: 800px; /* Restricts width so text reads easily center-aligned */
  margin: 0 auto;
  padding: 0 15px;
}

/* Copyright Text (Upper) */
.mainfooter .uppertext {
  font-size: 0.95rem;
  font-weight: 600;
  color: #2b2b2b; /* Deep charcoal for main text */
  letter-spacing: 0.5px;
  margin-bottom: 1.5rem; /* Generous gap between copyright and license */
}

/* DSWD License Certificate Text (Lower) */
.mainfooter .lowertext {
  font-size: 0.8rem; /* Scaled down for legal/fine print look */
  line-height: 1.6;
  color: #6c757d; /* Muted gray for secondary legal text */
  font-weight: 400;
  max-width: 600px; /* keeps the paragraphs from getting too wide on desktop */
  margin: 0 auto;
}

/* Make it responsive for mobile viewports */
@media (max-width: 576px) {
  .mainfooter {
    padding-top: 2.5rem !important;
    padding-bottom: 2.5rem !important;
  }
  .mainfooter .uppertext {
    font-size: 0.9rem;
  }
  .mainfooter .lowertext {
    font-size: 0.75rem;
  }
}
</style>

<script>
  (function () {
    // Scroll to Top Button logic
    var btn = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', function () {
      if (window.scrollY > 300) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Messenger Widget toggle logic
    var messengerBtn = document.getElementById('messenger-widget');
    var chatCard = document.getElementById('chat-card');
    var closeChatBtn = document.getElementById('close-chat');

    if (messengerBtn && chatCard) {
      messengerBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        chatCard.classList.toggle('show');
      });
    }

    if (closeChatBtn && chatCard) {
      closeChatBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        chatCard.classList.remove('show');
      });
    }

    // Auto-close widget when clicking outside
    document.addEventListener('click', function (e) {
      var container = document.getElementById('chat-widget-container');
      if (container && !container.contains(e.target)) {
        chatCard.classList.remove('show');
      }
    });
  })();
</script>
