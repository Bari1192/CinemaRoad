# **Adminpanel (Foglalási és Vásárlási Áttekintő) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciói**: 
    - Az áttekintő komponens lehetővé teszi az adminok, moderátorok számára a felhasználók, vendégek **foglalás ,- és vásárlásaik** **kezelését**, megjelenítve a foglalt helyeket és lehetőséget **biztosítva** azok **módosítására vagy törlésére**.
    - Lehetőséget nyújt meglévő filmet **létrehozni**, vagy akár egy már meglévőt **módosítani**, továbbá felületet ad a **moziműsor szerkesztéséhez**.

- **Adminpanel elérése és admin funkciók használata**
- Admin jogosultságot a backend oldali ***UserSeeder*** adatainak megfelelően jön létre a(z):
  
  - **SuperAdmin** bejelentkezési adatai
    > - **Email cím**: superadmin@gmail.com
    > - **Jelszó**: superadminZ
  
  - **Admin** bejelentkezési adatai
    > - **Email cím**: admin@gmail.com
    > - **Jelszó**: Admin1234_

A fenti hitelesítő adatok *(profilok)* egyikével történő bejelentkezés biztosítja a `demo üzemmódban` való webapplikáció tesztelését, jogosultságok áttekintését, a funkcionalitásokhoz való hozzáférést.

- **Főbb adminsztrátori interakciók és funkciók**:
  - Foglalások és vásárlások áttekintés, megtekintése,
  - Szűrők használata az egyes lista/listák szűkítésére,
  - Foglalások és vásárlások módosítása,
  - Foglalások és vásárlások törlése.
  - A mozikínálatban lévő filmek áttekintés, megtekintése,
  - Mozifilmek adatainak szerkesztése,
  - Mozifilmek törlése,
  - Moziműsor létrehozása aktuális helyszínre, napra pontosan,
  - Moziműsor létrehozásának újrakezdése / visszavonása véglegesítés előtt,
  - Mozifilm létrehozása.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `Paginator` (PrimeVue)
  - `ToastService`
  - `useTicketStore`
  - `useMovieStore`
  - `useUserStore`
  - `useRouter`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**   | **Funkció, stílusjegyek**                                      |
| ---------- | -------------------------------------------------------------- |
| `<h1>`     | Cím a foglalási vagy vásárlási áttekintőhöz                    |
| `<select>` | Helyszínek és filmek kiválasztására szolgáló legördülő menük   |
| `<input>`  | Email cím szűrő                                                |
| `<button>` | Gombok a nézet váltására, foglalások és vásárlások között      |
| `<div>`    | Mobil nézet kártyák a foglalások és vásárlások megjelenítésére |
| `<table>`  | Nagy képernyős nézet a foglalások és vásárlások listázására    |

## **4. Logika és interakciók**
- **Script setup tartalom**: A komponens tartalmazza a különböző boltok és reaktív változók kezelését.
- **Eseménykezelés**: Módosítási és törlési események kezelése a foglalások és vásárlások esetében.
- **Reaktív adatok**: `viewMode`, `selectedLocation`, `selectedMovie`, `emailFilter`, `editableData`, `editingDataId`, `selectedPanel`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                             |
| ------------------ | ----------------------------------------- |
| **Színek**         | Rózsaszín (szűrők, címek), szürkés háttér |
| **Betűtípus**      | Nincs specifikálva                        |
| **Reszponzivitás** | Mobilbarát elrendezés                     |
| **Effektek**       | Hover és animációs effektusok a gombokon  |

## **A komponenst tartalmi összefoglalója**
A komponens célja, hogy az adminok és a moderátorok átfogó képet kapjanak a előfoglalásokról és a felhasználók vásárlásaikról. Kezeli a szűréseket és lehetővé teszi a módosításokat vagy törléseket. Továbbá lehetőséget nyújtson a mozifilmek módosítására, javítására, illetve moziműsor létrehozására a kiválasztott helyszínre és napra a filmkatalógus alapján.