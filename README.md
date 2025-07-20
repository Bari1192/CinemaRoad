# 🎬 Cinema Road – Drive-in Mozi 
## 1️⃣ Eszközök telepítése

### 🖥️ 1.1 Visual Studio Code

1. Böngészőben menj ide: [Visual Studio Code letöltése](https://code.visualstudio.com/)  
2. Válaszd ki a rendszered (Windows/Mac/Linux), töltsd le, telepítsd.
3. Indítsd el a Visual Studio Code-ot!

**Tipp:**  
Terminál megnyitása:  
- Menüsor: **Nézet → Terminál**  
- vagy: **Ctrl + `** (magyar billentyűzeten: _Alt Gr + 7_)

---

### 🐙 1.2 Git telepítése

1. Menj ide: [Git letöltése](https://git-scm.com/downloads)
2. Válaszd ki a rendszert, telepítsd.
3. VS Code automatikusan érzékelni fogja!

---

### 🐳 1.3 Docker Desktop telepítése

1. Nyisd meg: [Docker Desktop letöltése](https://www.docker.com/products/docker-desktop)
2. Válassz rendszert (Windows/Mac), töltsd le, telepítsd, indítsd el!
3. **Fontos:** mindig legyen elindítva, mielőtt dolgozol!

---

## 2️⃣ A projekt letöltése (klónozás)

1. VS Code-ban **nyiss Terminált** (lásd fent).
2. Válaszd ki a mappát, ahova mented:
   ```bash
   cd /ahová_kell/
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

## 3️⃣ Környezeti változók beállítása (.env)

1. Másold az alapértelmezett beállításokat:
   ```bash
   cp backend/.env.example backend/.env
   ```
2. Ha szeretnél, **szerkeszd a backend/.env** fájlt (pl. jelszó, email…)
3. Első indításhoz elég az alapértelmezett érték!

---

## 4️⃣ Indítás 💡 / Leállítás 🛑 / Törlés ❌

### 🚦 Indítás (bármikor):
A CinemaRoad mappájában:

```bash
sh start.sh
```

***VAGY***

```bash
sh ./start.sh
```
- Ez **elindít minden szervert és adatbázist**!

### 🛑 Leállítás:
```bash
docker compose stop
```
- Könnyű, gyors, mindent megőriz!

### ❌ Teljes törlés (adatok is törlődnek!)
```bash
docker compose down -v
```
- Ezzel *minden újraindul*, minden eddigi adat (felhasználók, filmek stb.) elveszik.

---

## 5️⃣ Mi van a projektben?

- `frontend/` – felhasználói (Vue.js) alkalmazás
- `backend/` – szerver és adatbázis (PHP/Laravel)
- `nginx/` – kiszolgáló beállítások
- `start.sh` – **mindent elindít** egyszerre!

**Elérés böngészőben:**  
[http://localhost](http://localhost)

---

## 6️⃣ Hibakeresés, karbantartás 🛠️

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
