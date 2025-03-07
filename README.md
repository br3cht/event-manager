# 📌 Guia de Instalação e Execução

## ✅ Pré-requisitos
Antes de executar o projeto, certifique-se de ter o **Docker** instalado em sua máquina. Você pode baixar e instalar o Docker através do link abaixo:

🔗 [Instalar Docker](https://www.docker.com/get-started)

---

## 🚀 Execução do Projeto
Siga os passos abaixo para configurar e executar o projeto corretamente:

### 1️⃣ Copiar o arquivo de configuração
Copie o arquivo `.env.example` para `.env`:
```bash
cp .env.example .env
```
Ou, se preferir, crie e edite manualmente o arquivo `.env` com as configurações necessárias.

### 2️⃣ Criar as imagens do Docker
Execute o seguinte comando para construir as imagens do Docker:
```bash
docker-compose build
```

### 3️⃣ Iniciar os contêineres
Suba os contêineres em segundo plano:
```bash
docker-compose up -d
```

### 4️⃣ Configurar a aplicação
Acesse o contêiner da aplicação:
```bash
docker-compose exec app sh
```
Dentro do contêiner, gere a chave da aplicação Laravel:
```bash
php artisan key:generate
```

### 5️⃣ Acessar a aplicação
Abra o navegador e acesse a aplicação através do link:
🔗 [http://localhost](http://localhost)

Caso a porta 80 já esteja em uso, altere-a no arquivo `.env` na variável `DOCKER_HTTP_PORT`.

---

## 🔑 Credenciais de Acesso

### 👤 Administrador:
- **E-mail:** `admin@example.com`
- **Senha:** `password`

### 👤 Usuário comum:
- **E-mail:** `user@example.com`
- **Senha:** `password`

---

Agora sua aplicação está configurada e pronta para uso! 🚀
