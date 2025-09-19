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
2. Amennyiben változtatni szeretnéd, **szerkeszd a .env** fájlt *(pl. jelszó, email)*
3. A változtatásaid alapján jön létre a gyökérkönyvtárban a `.env` fájl, melyre a projekt épül.
4. Első indításhoz az alapértelmezett értékekkel elegendő futtatni!

---

## 3️⃣ Indítás ▶️ / Leállítás ⏸️ / Törlés ❌

### 🚦 Indítás (bármikor):

1. Ahhoz, hogy az előre beállított URL címeken elérhető legyen a projekt, szükséges a windows `host` fájl megfelelő beállítása az alábbiak szerint (Alapértelmezetten a `C:\Windows\System32\drivers\etc` mappában található a `host` fájl.
   -  Jobb klikk segítségével ***Notepad***-dal megnyitva a fájl végéhez görgetve a **Host_Setup.md** fájlban található, az "***# End of section"*** rész alatti beállítások átmásolása szükséges! 🛠️

Mindezek után a *CinemaRoad* mappájában adjuk ki a terminálban a következő parancsokat:

1. Amennyiben demo környezetben szeretnénk futtatni a projektet

```bash
sh start.sh --demo
```
- **elindít minden szervert, adatbázist és a függőségek telepítését is elvégzi a tesztesetekkel, a backend storage elérését publikálja**!

***VAGY***

1. Amennyiben fejlesztői *(dev)* környezetben szeretnénk futtatni a projektet
  
```bash
sh start.sh --dev
```
- **elindít minden szervert, adatbázist és a függőségek telepítését is elvégzi, a backend storage elérését publikálja**!


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

- `frontend` – felhasználói (Vue.js) webalkalmazás
- `backend` – **szerver** és adatbázis (PHP/Laravel)
- `pma` – adatbázis (PhpMyAdmin vizuális felületét az **adatbázis állomány** eléréséhez)
- `docs` – NextJs által beépített **dokumentációs oldalt** teszi elérhetővé.
- `nginx/` – kiszolgáló beállítások - szerverek közötti kommunikációra.
- `start.sh [típus]` – **mindent szerver elindítását teszi lehető** egyszerre - függően a típus beállításától!

**Elérés böngészőben:**  
- [Frontend](http://frontend.cinemaroad)
- [Backend](http://backend.cinemaroad)
- [Database](http://pma.cinemaroad)
- [Documentations](http://docs.cinemaroad)

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
