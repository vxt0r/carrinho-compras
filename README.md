# E-commerce
### Laravel e Bootstrap

- A aplicação simula um carrinho de compras de uma loja virtual
- Adicionar e remover produtos, definir e ver detalhes da compra
- Tela de admin para edição de produtos pela interface gráfica
- Paginação, filtros e upload de imagens
- OBS: Não possui integração com sistemas de pagamentos
</br>
<a href="https://youtu.be/9t7FxTqH_CI" target="_blank" rel="noopener noreferrer">Vídeo demonstrativo</a>

### Como usar
**É preciso rodar os seguintes comandos na raíz do projeto, após clonar o repositório**

    npm i
    composer install
    mv .env.example .env 
    php artisan cache:clear 
    composer dump-autoload 
    php artisan key:generate

**As configurações da conexão do banco de dados (drive, host, user, password) devem ser feitas no arquivo .env**

**Criar o banco de dados e tabelas com adição de registro de produtos**

    php artisan migrate
    php artisan db:seed

**Subir dois servidores**

    npm run dev
    php artisan serve


