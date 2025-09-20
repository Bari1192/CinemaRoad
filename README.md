# 🎬 Cinema Road – Drive-in Mozi 

## 1️⃣ A projekt inicializálása *(klónozása lokálisan)*

1. Nyissa meg a Visual Studio Code programot!
2. A program megnyitása után a Visual Studio Code -ban **nyissa meg terminált** 
   
   ![terminal](/resources/terminal.png)

**3. Lépjen át abba a mappába, ahova menteni kívánja a projektet:**
   ```bash
   cd /projektek/kivalasztott_mappa/
   ```
   > **Git szükséges** a további lépésekhez! Amennyiben nincs telepítve a *git*, töltse le **[ide kattintva](https://git-scm.com/downloads)** a következő lépések **folytatása előtt**!

**4. Írja be a terminálba a következő parancsot:**
   ```bash
   git clone https://github.com/Bari1192/CinemaRoad
   ```
**5. Majd lépjen be a projekt fő mappájába az alábbi paranccsal:**
   ```bash
   cd CinemaRoad
   ```
---

## 2️⃣ Környezeti változók beállítása (.env)

1. Az alapértelmezett beállításokat a `.env.example` fájl tartalmazza a projekthez.

2. Amennyiben változtatni kívánja ezeket, a **.env** fájl módosításával megteheti. *(pl.: jelszó, email, stb.)*

3. Alapértelmezetten *- módosítások nélkül -* a `.env.example` alapján jön létre a gyökérkönyvtárban a `.env` fájl, melyre a projekt alapjai épülnek.
4. 
5. Első indításhoz az alapértelmezett értékekkel elegendő futtatni, ***módosítások eszközölése ebben nem szükséges!***

---

## 3️⃣ Indítás ▶️ / Leállítás ⏸️ / Törlés ❌

### 🚦 Indítás (bármikor):

1. Ahhoz, hogy az előre beállított URL címeken elérhető legyen a projekt, szükséges a windows `host` fájl megfelelő beállítása az alábbi dokumentáció szerint:
   
   > [Hosts projekt beállítások](/Host_Setup.md)

2. A projektsturktúrát és annak funkcióit a **demo indítási környezettel** érhetjük el, melyhez az alábbi parancs kiadása szükséges:

```bash
sh start.sh --demo
```
*Elindít minden szervert, adatbázist és a függőségek telepítését is elvégzi a tesztesetekkel, a backend storage elérését publikálja*!

3. Amennyiben **fejlesztői** *(dev)* **környezetben** szeretnénk futtatni a projektet, az alábbi parancs kiadása szükséges:
  
```bash
sh start.sh --dev
```

*Elindít minden szervert, adatbázist és a függőségek telepítését is elvégzi a **tesztesetek futtatása nélkül**, a backend storage elérését publikálásával.*


### 🛑 Leállítás:
```bash
docker compose stop
```
- Könnyű, gyors és hatékony leállást eredményez a generált adatok megőrzésével.

### ❌ Teljes törlés 
```bash
docker compose down -v
```
- Hatékony teljes leállást eredményez, ugyanakkor minden generált adat törlésével jár.

---

## 4️⃣ Mit tartalmaz a projekt?

- `Frontend` – felhasználói (Vue.js) webalkalmazás
- `Backend` – **szerver** és adatbázis (PHP/Laravel)
- `Adatbázis` – adatbázis (PhpMyAdmin vizuális felületét az **adatbázis állomány** eléréséhez)
- `Dokumentációs oldal` – NextJs által beépített **dokumentációs oldal** - (docs). teszi elérhetővé.
- `nginx/` – kiszolgáló beállítások - szerverek közötti kommunikációra.
- `sh start.sh [--típus]` – **Típusbeállítástól függő éles és fejlesztési projekt elindítását teszi lehetővé!

**Elérés böngészőben:**  
- [Frontend](http://frontend.cinemaroad)
- [Backend](http://backend.cinemaroad)
- [Database](http://pma.cinemaroad)
- [Documentations](http://docs.cinemaroad)
---

## 5️⃣ Hibakeresés és karbantartás 🛠️

- Logok: `backend/storage/logs`
- Probléma / Hiba / rendellenes működés esetén : teljes leállítást kell eszközölni és a projektet `--demo` utótaggal indítsa újra!
   ```bash
   docker compose down -v
   ./start.sh --demo
   ```
- Gyors újraindítás (*nem javasolt*):
   ```bash
       docker compose restart
   ```

## ℹ️ Források és további segítségekért

- [Cinema Road GitHub](https://github.com/Bari1192/CinemaRoad)
- [Adatbázis diagram (draw.io)](https://tinyurl.com/CinemaRoadDraw)
- Részletesebb üzemeltetési leírás: `03.Operational_Plan.md` a projektben
