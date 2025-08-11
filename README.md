# 🎬 Cinema Road – Drive-in Mozi 

## 1️⃣ A projekt letöltése (klónozás)

1. VS Code-ban **nyiss Terminált** (lásd fent).
2. Válaszd ki a mappát, ahova mented:
   ```bash
   cd /altalad_valasztott_mappa/
   ```
3. Írd be:
   ```bash
   git clone https://github.com/Bari1192/CinemaRoad
   ```
4. Lépj be a mappába:
   ```bash
   cd CinemaRoad
   ```

---

## 2️⃣ Környezeti változók beállítása (.env)

1. Az alapértelmezett beállításokat a `.env.example` fájl tartalmazza a projekthez.
2. Amennyiben változtatni szeretnéd, **szerkeszd a backend/.env.example** fájlt (pl. jelszó, email…)
3. A változtatásaid alapján jön létre a gyökérkönyvtárban a `.env` fájl, melyre a projekt épül.
4. Első indításhoz az alapértelmezett értékekkel elegendő futtatni!

---

## 3️⃣ Indítás ▶️ / Leállítás ⏸️ / Törlés ❌

### 🚦 Indítás (bármikor):
A CinemaRoad mappájában:

```bash
sh start.sh
```

***VAGY***

```bash
sh ./start.sh
```
- Ez **elindít minden szervert, adatbázist és a függőségek telepítését is elvégzi**!

### 🛑 Leállítás:
```bash
docker compose stop
```
- Könnyű, gyors, mindent megőriz!

### ❌ Teljes törlés (adatok is törlődnek!)
```bash
docker compose down -v
```
- Ezzel *minden újraindul*, minden eddigi adat *(felhasználók, filmek stb.)* elveszik.

---

## 4️⃣ Mit tartalmaz a projekt?

- `frontend/` – felhasználói (Vue.js) alkalmazás
- `backend/` – szerver és adatbázis (PHP/Laravel)
- `nginx/` – kiszolgáló beállítások
- `start.sh` – **mindent elindít** egyszerre!

**Elérés böngészőben:**  
[http://localhost](http://localhost)

---

## 5️⃣ Hibakeresés és karbantartás 🛠️

- Logok: `backend/storage/logs`
- Ha valami nem jó: leállítás + újraindítás!
```bash
docker compose down -v
./start.sh
```
- Gyors újraindítás (*nem javasolt*):
```bash
    docker compose restart
```
- Frissítés előtt mindig **ments le mindent**!
---

## ℹ️ Források és további segítségekért

- [Cinema Road GitHub](https://github.com/Bari1192/CinemaRoad)
- [Adatbázis diagram (draw.io)](https://tinyurl.com/CinemaRoadDraw)
- Részletesebb üzemeltetési leírás: `03.Operational_Plan.md` a projektben
