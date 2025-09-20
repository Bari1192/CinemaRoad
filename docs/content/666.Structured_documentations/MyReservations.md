# **MyReservations komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a **felhasználók** saját **foglalásainak áttekintésére** szolgál.
- **Fő felhasználói interakciók**:
  - Aktív foglalások megtekintése
  - Foglalás törlése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `useUserStore`
  - `useTicketStore`
  - `useScreeningStore`
  - `BaseSpinner`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                     |
| --------------- | --------------------------------------------- |
| `<BaseLayout>`  | Az oldal vázát biztosítja                     |
| `<BaseSpinner>` | Betöltési animáció                            |
| `<h1>`          | Aktív foglalás címének megjelenítése          |
| `<div>`         | Foglalások megjelenítése rácsos elrendezésben |
| `<button>`      | Foglalás törlésére szolgáló gomb              |

## **4. Logika és interakciók**
- **Script setup tartalom**: A foglalások és vetítések betöltése, valamint a törlési logika.
- **Eseménykezelés**: A foglalások törlése a gombnyomásra.
- **Reaktív adatok**: `reservations`, `filteredReservations`, `loading`, `screeningsById`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                    |
| ------------------ | ------------------------------------------------ |
| **Színek**         | Szürke háttér, rózsaszín címszöveg               |
| **Betűtípus**      | Nincs specifikálva                               |
| **Reszponzivitás** | Mobilbarát elrendezés                            |
| **Effektek**       | Átmenetek a gombokon és az animációk a háttérben |

## **A komponenst tartalmi összefoglalója**
A komponens lehetővé teszi a felhasználók számára, hogy áttekintsék saját aktív foglalásaikat, és lehetőséget biztosít foglalásaik törlésére.