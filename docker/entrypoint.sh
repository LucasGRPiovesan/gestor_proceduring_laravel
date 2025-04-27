#!/bin/bash

set -e

# Função para instalar Laravel se não existir
install_laravel() {
    echo "Laravel não encontrado, instalando..."

    # Remove tmp-laravel se já existir
    if [ -d tmp-laravel ]; then
        echo "Removendo tmp-laravel antigo..."
        rm -rf tmp-laravel
    fi

    composer create-project --prefer-dist laravel/laravel tmp-laravel "8.*"

    cp -a tmp-laravel/. .
    rm -rf tmp-laravel

    echo "Laravel instalado com sucesso!"
}

# Instala Laravel se necessário
if [ ! -f artisan ]; then
    install_laravel
fi

# Permissão nas pastas de cache
chmod -R 775 storage bootstrap/cache || true

# Aguarda o banco de dados subir
echo "Aguardando o banco de dados iniciar..."
until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
  sleep 2
done

echo "Banco de dados iniciado!"

# Roda migrations automaticamente
if php artisan migrate --force; then
    echo "Migrations rodadas com sucesso!"
else
    echo "Erro ao rodar migrations!"
fi

# Inicia o servidor Artisan
php artisan serve --host=0.0.0.0 --port=8000
