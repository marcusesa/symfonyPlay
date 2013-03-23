#Projeto symfonyPlay

Brincando com o symfony framework.

##Instalando

1. Clonando o projeto.
```
git clone git@github.com:marcusesa/symfonyPlay.git
```

2. Dando permissão as pastas cache e logs.
```
sudo chmod 777 -R app/cache/
sudo chmod 777 -R app/logs/
```

3. Rodando o composer
```
php composer.phar install
```

4.Criando o banco de dados e seu schema.
```
app/console doctrine:database:create
app/console doctrine:schema:create
```
