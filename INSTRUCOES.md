# Etapas 1 a 3 — o que fazer

## 0. Antes de tudo (5 min)
1. Abra `submit_form.php` no GitHub e veja se há e-mail, senha SMTP ou chave. Se houver, **troque a credencial**.
2. Crie uma conta em https://formspree.io, crie um formulário e copie o ID (algo como `xyzabcde`).

## 1. Limpeza do repositório
Na pasta do projeto (clone local):

```bash
git rm "lista de reprodução.m3u" submit_form.php
# se o nome real do arquivo for playlist.m3u:  git rm playlist.m3u
```

Copie para a raiz: `robots.txt`, `sitemap.xml`, `404.html`, `README.md`, `.gitignore`.

```bash
git add .
git commit -m "Limpeza, SEO básico, 404, README e formulário estático"
git push
```

## 2. Substituições em index.html

### 2.1 `<head>` (troque title e meta antigos; remova meta-keywords)
```html
<title>EverSats | Consultoria e Treinamento em Auto-Custódia de Bitcoin</title>
<meta name="description" content="Aprenda a guardar seu Bitcoin com segurança e garanta que sua família consiga acessá-lo. Treinamento, auto-custódia e sucessão patrimonial. Agende uma conversa.">
<link rel="canonical" href="https://eversats.com/">
<meta property="og:type" content="website">
<meta property="og:locale" content="pt_BR">
<meta property="og:site_name" content="EverSats">
<meta property="og:title" content="EverSats | Auto-Custódia e Sucessão de Bitcoin">
<meta property="og:description" content="Treinamento e consultoria para guardar seu Bitcoin com segurança e transmiti-lo aos herdeiros.">
<meta property="og:url" content="https://eversats.com/">
<meta property="og:image" content="https://eversats.com/og-image.jpg"> <!-- crie uma imagem 1200x630 -->
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="/eversats-logo.png">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "EverSats",
  "url": "https://eversats.com",
  "logo": "https://eversats.com/eversats-logo.png",
  "description": "Treinamento e consultoria em auto-custódia e sucessão patrimonial de Bitcoin.",
  "areaServed": "BR",
  "inLanguage": "pt-BR"
}
</script>
```

### 2.2 Seção de contato (troque `SEU_ID_FORMSPREE`)
```html
<section id="contato">
  <h2>Fale com a EverSats</h2>
  <p>Conte rapidamente o que você precisa. Respondemos em até 1 dia útil.</p>

  <form id="form-contato" action="https://formspree.io/f/SEU_ID_FORMSPREE" method="POST">
    <label for="nome">Nome</label>
    <input id="nome" name="nome" type="text" required autocomplete="name">

    <label for="email">E-mail</label>
    <input id="email" name="email" type="email" required autocomplete="email">

    <label for="mensagem">Como podemos ajudar?</label>
    <textarea id="mensagem" name="mensagem" rows="5" required></textarea>

    <p class="aviso-seguranca">
      <strong>Atenção:</strong> nunca envie sua seed phrase, chaves privadas ou senhas.
      A EverSats jamais pede essas informações.
    </p>

    <label>
      <input type="checkbox" name="consentimento" required>
      Concordo com o uso dos meus dados para retorno deste contato (<a href="/privacidade.html">Política de Privacidade</a>).
    </label>

    <!-- antispam: campo oculto, deve ficar vazio -->
    <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off">
    <input type="hidden" name="_subject" value="Novo contato pelo site EverSats">

    <button type="submit">Enviar mensagem</button>
    <p id="form-status" role="status" aria-live="polite"></p>
  </form>

  <p>Prefere falar direto?
    <a href="https://wa.me/55SEUNUMERO?text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20EverSats" target="_blank" rel="noopener">WhatsApp</a>
    ·
    <a href="mailto:contato@eversats.com">contato@eversats.com</a>
  </p>
</section>

<script>
(function () {
  var form = document.getElementById('form-contato');
  var status = document.getElementById('form-status');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    status.textContent = 'Enviando...';
    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: { 'Accept': 'application/json' }
    }).then(function (r) {
      if (r.ok) { form.reset(); status.textContent = 'Mensagem enviada! Responderemos em breve.'; }
      else { status.textContent = 'Não foi possível enviar. Tente pelo WhatsApp ou e-mail.'; }
    }).catch(function () {
      status.textContent = 'Erro de conexão. Tente pelo WhatsApp ou e-mail.';
    });
  });
})();
</script>
```

### 2.3 Botão flutuante de WhatsApp (antes de `</body>`; troque `55SEUNUMERO`)
```html
<a class="whats-float" href="https://wa.me/55SEUNUMERO?text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20EverSats"
   target="_blank" rel="noopener" aria-label="Falar pelo WhatsApp">WhatsApp</a>
<style>
.whats-float{position:fixed;right:16px;bottom:16px;z-index:50;background:#25d366;color:#000;
  font:600 15px system-ui,sans-serif;padding:12px 18px;border-radius:999px;text-decoration:none;
  box-shadow:0 2px 8px rgba(0,0,0,.3)}
.whats-float:hover{filter:brightness(1.08)}
.aviso-seguranca{font-size:.9rem;padding:.6rem .8rem;border-left:4px solid #f7931a;background:rgba(247,147,26,.12)}
</style>
```

### 2.4 Rodapé com ano automático e aviso legal
```html
<footer>
  <p>&copy; <span id="ano"></span> EverSats. Todos os direitos reservados.</p>
  <p class="aviso-legal">Conteúdo educacional. Não constitui recomendação de investimento, aconselhamento financeiro, jurídico ou tributário.</p>
  <p><a href="/privacidade.html">Política de Privacidade</a></p>
  <script>document.getElementById('ano').textContent = new Date().getFullYear();</script>
</footer>
```

### 2.5 Card de Otimização Fiscal (troque o `href="#"`)
```html
<h3>Orientação Fiscal</h3>
<p>Organização e declaração correta dos seus Bitcoins. Em breve.</p>
<a href="https://wa.me/55SEUNUMERO?text=Quero%20ser%20avisado%20sobre%20o%20servi%C3%A7o%20fiscal" target="_blank" rel="noopener">Avise-me quando lançar</a>
```

### 2.6 Correções de texto
| Onde | Trocar | Por |
|---|---|---|
| Contato | "soberado" | "soberano" |
| Treinamento | "facil" | "fácil" |
| Vários | "Bitcoins" | "Bitcoin" |
| Hero | "Soberania Patrimonial com Bitcoin" | "Seu Bitcoin só é seu se só você tiver acesso" (sugestão) |

## 3. Teste final
1. Envie uma mensagem real pelo formulário e confirme que chegou no e-mail (o Formspree pede confirmação no primeiro envio).
2. Teste os links WhatsApp e e-mail no celular.
3. Acesse `https://eversats.com/pagina-inexistente` e veja a 404.
4. Acesse `https://eversats.com/robots.txt` e `/sitemap.xml`.
5. No Google Search Console, adicione o site e envie o sitemap.
6. Em Settings > Pages do repositório, confirme "Enforce HTTPS".
