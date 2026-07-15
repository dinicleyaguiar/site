# PHPPA

Site da comunidade de desenvolvedores PHP do estado do Pará.

## Requisitos

- Docker Desktop com Docker Compose; ou
- PHP 8.3+ e Composer 2 para execução sem contêineres.

## Executar com Docker

Na raiz do projeto:

```bash
docker compose up --build
```

O site estará disponível em <http://localhost:8031>.

Para encerrar:

```bash
docker compose down
```

O Xdebug fica desligado por padrão. Para ativá-lo no PowerShell:

```powershell
$env:XDEBUG_MODE = "debug"
docker compose up --build
```

## Executar com PHP local

Instale as dependências e inicie o servidor na raiz do projeto:

```bash
composer install --working-dir=www
php -S localhost:8031 -t www www/index.php
```

## Formulário de contato

Copie o arquivo de exemplo e informe as credenciais SMTP:

```powershell
Copy-Item www/.env.example www/.env
```

O arquivo `www/.env` é ignorado pelo Git e não deve ser versionado.

## Validação

```powershell
Get-ChildItem www -Filter '*.php' | ForEach-Object { php -l $_.FullName }
composer validate --working-dir=www --strict
```

## Comunidade

- Site: <https://phppa.org/>
- Facebook: <https://www.facebook.com/elephants.para/>
- Twitter: <https://twitter.com/phppara>
- GitHub: <https://github.com/phppara/>
