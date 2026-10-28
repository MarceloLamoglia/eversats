# EverSats

Site institucional da **EverSats** — treinamento e consultoria em compra segura de Bitcoin,
auto-custódia e sucessão patrimonial.

- Site: https://eversats.com
- Hospedagem: GitHub Pages (site estático, **não executa PHP**)
- Domínio: definido no arquivo `CNAME`

## Estrutura

| Arquivo | Função |
|---|---|
| `index.html` | Página inicial |
| `treinamento.html`, `consultoria.html`, `plano-sucessao.html` | Páginas de serviço |
| `faq.html`, `blog.html`, `postagem-do-blog*.html` | Conteúdo |
| `styles.css` | Estilos |
| `404.html` | Página de erro |
| `robots.txt`, `sitemap.xml` | SEO |

## Formulário de contato

O formulário envia para o [Formspree](https://formspree.io). O endpoint fica no atributo
`action` do `<form>` em `index.html`. Não há backend próprio.

## Publicar alterações

```bash
git add .
git commit -m "Descrição da alteração"
git push
```

O GitHub Pages publica automaticamente em alguns minutos.

## Regras do repositório

- Nunca commitar senhas, chaves de API ou e-mails de serviço.
- Não versionar arquivos sem relação com o site.
- Atualizar `sitemap.xml` ao criar uma página nova.
