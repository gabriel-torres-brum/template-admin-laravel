# Template para início de sistema com painel de administrador/usuário em laravel
##### Desenvolvido por Gabriel Torres Brum
&ensp;
## ✨  Instruções para visualização do template

##### Crie o arquivo de variável de ambiente
```sh
    cp .env.example .env
```

##### Instale as dependências
```sh
    composer install
    yarn // dependencias node
    yarn build
```

##### Execute as migrations e as seeders
```sh
    php artisan migrate:fresh --seed
```

##### Execute o comando para limpar o cache e otimizar o template
```sh
    php artisan optimize:clear
    php artisan optimize
```

##### Execute o template localmente
```sh
    php artisan serve
```

##### Acesse o template em http://localhost:8000
&nbsp;
##### Usuários para testes
###### Administrador
Email: admin@email.com
Senha: 12345678
###### Usuário
Email: user@email.com
Senha: 12345678
