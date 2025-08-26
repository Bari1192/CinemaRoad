RUN_CASE=0
for arg in "$@"; do
  case "$arg" in
    --demo|–demo|—demo) RUN_CASE=1 ;;
    --dev) RUN_CASE=2 ;;
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

if [ "$RUN_CASE" -eq 1 ]; then
  echo "Demo üzemmód aktiválva - Seeder - Tesztek - Linkek"
  docker compose exec backend php artisan migrate:fresh --seed
  docker compose exec backend php artisan storage:link
  docker compose exec backend php artisan test
fi
if [ "$RUN_CASE" -eq 2 ]; then
  echo "DEV üzemmód aktiválva - Seeder - Linkek"
  docker compose exec backend php artisan migrate:fresh --seed
  docker compose exec backend php artisan storage:link
fi

if [ -z "${APP_KEY}" ]; then
    docker compose exec backend php artisan key:generate
else
    echo "Az API kulcs már létezik" 
fi