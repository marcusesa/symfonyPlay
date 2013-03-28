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

4.Criando o banco de dados e seu schema e populando.
```
app/console doctrine:database:create
app/console doctrine:schema:create
app/console doctrine:fixtures:load
```

##Atualizando o projeto
1.Código fonte.
```
git pull
```
2.Schema do banco de dados.
```
app/console doctrine:schema:update --force
```
3.Populando o banco de dados.
```
app/console doctrine:fixtures:load
```