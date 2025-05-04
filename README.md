# dio-docker-projeto2-cluster

## Descrição
Este repositório contém um projeto que utiliza **Vagrant** para provisionar máquinas virtuais e **Docker Swarm** para orquestrar containers. O objetivo é criar um cluster com múltiplos nós para rodar um sistema composto por um servidor PHP, um banco de dados MySQL e um balanceador de carga Nginx.

## Estrutura do Projeto

### Arquivos principais:
- **`Vagrantfile`**: Configura quatro máquinas virtuais (1 master e 3 workers) com IPs privados e públicos. O master inicializa o cluster Docker Swarm.
- **`docker.sh`**: Script para instalar o Docker e configurar o ambiente nas máquinas.
- **`master.sh`**: Script para inicializar o Docker Swarm no nó master e configurar o stack do projeto.
- **`worker.sh`**: Script gerado automaticamente para adicionar os nós workers ao cluster.
- **`app/docker-compose.yml`**: Arquivo de configuração do Docker Compose para definir os serviços (MySQL, PHP e Nginx).
- **`app/index.php`**: Aplicação PHP que interage com o banco de dados MySQL.
- **`app/nginx.conf`**: Configuração do Nginx para balanceamento de carga.

## Serviços
O projeto é composto pelos seguintes serviços:

1. **MySQL**:
   - Imagem: `mysql:5.7`
   - Configurado com autenticação nativa e charset UTF-8.
   - Porta exposta: `3306`
   - Dados persistidos em volume.

2. **Aplicação PHP**:
   - Imagem: `webdevops/php-apache:alpine-php7`
   - Porta exposta: `8080`
   - Código-fonte montado via volume.

3. **Nginx**:
   - Imagem: `nginx`
   - Configurado como balanceador de carga para distribuir requisições entre os nós workers.
   - Porta exposta: `80`

## Como Executar

1. Certifique-se de ter o **Vagrant** e o **VirtualBox** instalados.
2. Clone este repositório:
   ```bash
   git clone <URL_DO_REPOSITORIO>
   cd dio-docker-projeto2-cluster
   ```
3. Inicie as máquinas virtuais:
   ```bash
   vagrant up
   ```
4. Acesse o nó master:
   ```bash
   vagrant ssh master
   ```
5. Verifique o status do cluster Docker Swarm:
   ```bash
   docker node ls
   ```
6. Acesse a aplicação no navegador pelo IP público configurado no `Vagrantfile`:
   ```
   http://<IP_PUBLICO_DO_MASTER>
   ```

---

## Observações

- O script **`worker.sh`** será gerado automaticamente pelo nó master para adicionar os workers ao cluster.
- O banco de dados **MySQL** cria automaticamente a tabela `dados` caso ela não exista.
- O balanceador de carga **Nginx** distribui requisições entre os nós workers.

---

## Tecnologias Utilizadas

- **Vagrant**
- **VirtualBox**
- **Docker**
- **Docker Swarm**
- **PHP**
- **MySQL**
- **Nginx**