# E-commerce
### Laravel e Bootstrap

- A aplicação simula um carrinho de compras de uma loja virtual
- Adicionar e remover produtos, definir e ver detalhes da compra
- Tela de admin para edição de produtos pela interface gráfica
- OBS: a definição de um admin deve ser feita manualmente (pelo banco de dados) ao usuário, mudando o valor do campo admin de 0 para 1
- Paginação, filtros e upload de imagens
- Login com confirmação de email
- OBS2: Não possui integração com sistemas de pagamentos

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

**OBS: Para o funcionamento da aplicação, as configurações da sua conexão com o banco de dados, assim como as configurações do seu servidor SMTP devem ser definidas no arquivo .env, nas constantes que iniciam com DB e MAIL, respectivamente**

**Criar o banco de dados e tabelas com adição de registro de produtos**

    php artisan migrate
    php artisan db:seed

**Subir dois servidores**

    npm run dev
    php artisan serve


