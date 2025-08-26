DEMO=0
for arg in "$@"; do
  case "$arg" in
    --demo|–demo|—demo) DEMO=1 ;;
  esac
done

if [ -f "backend/.env" ]; then
    echo "A .env fájl már létezik"
else
    cp backend/.env.example backend/.env
fi

if [ -f ".env" ]; then
    echo "A .env fájl már létezik"
else
    ln -s backend/.env
fi

docker run --rm  -v "$(pwd)/frontend:/app" --entrypoint npm idomi27/vue install

docker compose up -d

docker compose exec backend composer install

if [ "$DEMO" -eq 1 ]; then
  echo "DEMO üzemmód aktiválva - Seeder - Tesztek - Linkek"
  docker compose exec backend php artisan migrate:fresh --seed
  docker compose exec backend php artisan storage:link
  docker compose exec backend php artisan test
fi

if [ -z "${APP_KEY}" ]; then
    docker compose exec backend php artisan key:generate
else
    echo "Az API kulcs már létezik" 
fi