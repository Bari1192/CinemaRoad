# **Adminpanel (Foglalási és Vásárlási Áttekintő) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: Az áttekintő komponens lehetővé teszi az adminok, moderátorok számára a felhasználók, vendégek **foglalás ,- és vásárlásaik** **kezelését**, megjelenítve a foglalt helyeket és lehetőséget **biztosítva** azok **módosítására vagy törlésére**.

- **Fő felhasználói interakciók**:
  - Foglalási és vásárlási áttekintés megtekintése
  - Szűrők használata a lista szűkítésére
  - Foglalások és vásárlások módosítása
  - Foglalások és vásárlások törlése
  - Film adatok módosítása
  - Moziműsor létrehozása

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
- **Reaktív adatok**: `viewMode`, `selectedLocation`, `selectedMovie`, `emailFilter`, `editableData`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                             |
| ------------------ | ----------------------------------------- |
| **Színek**         | Rózsaszín (szűrők, címek), szürkés háttér |
| **Betűtípus**      | Nincs specifikálva                        |
| **Reszponzivitás** | Mobilbarát elrendezés                     |
| **Effektek**       | Hover és animációs effektusok a gombokon  |

## **A komponenst tartalmi összefoglalója**
A komponens célja, hogy a felhasználók áttekintést kapjanak a foglalásaikról és vásárlásaikról, kezeli a szűréseket és lehetővé teszi a módosításokat vagy törléseket az elemzett információk alapján.