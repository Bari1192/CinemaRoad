# **MyTickets komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a **felhasználók** saját **foglalásainak és vásárlásainak áttekintésére** szolgál.
- **Fő felhasználói interakciók**:
  - Aktív foglalások és vásárlások megtekintése
  - Foglalások és vásárlások törlése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `useUserStore`
  - `useTicketStore`
  - `useScreeningStore`
  - `BaseSpinner`
  - `ToastService`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                          |
| --------------- | -------------------------------------------------- |
| `<BaseLayout>`  | Az oldal vázát biztosítja                          |
| `<BaseSpinner>` | Betöltési animáció                                 |
| `<h1>`          | Aktív foglalás vagy vásárlás címének megjelenítése |
| `<div>`         | Aktív jegyek megjelenítése rácsos elrendezésben    |
| `<button>`      | Jegy törlésére szolgáló gomb                       |

## **4. Logika és interakciók**
- **Script setup tartalom**: A foglalások, vásárlások és vetítések betöltése, valamint a törlési logika.
- **Eseménykezelés**: Kiválasztott jegy törlése gombnyomásra.
- **Reaktív adatok**: `reservations`, `filteredReservations`, `purchases`, `filteredPurchases`, `view`, `loading`, `screeningsById`.

## **5. Stílus összefoglaló**
**Div tároló:**

| **Kategória**      | **Részletek**                                    |
| ------------------ | ------------------------------------------------ |
| **Színek**         | Szürke háttér, rózsaszín címszöveg               |
| **Betűtípus**      | Nincs specifikálva                               |
| **Reszponzivitás** | Mobilbarát elrendezés                            |
| **Effektek**       | Nincs                                            |

## **A komponenst tartalmi összefoglalója**
A komponens lehetővé teszi a felhasználók számára, hogy áttekintsék saját aktív foglalásaikat és vásárlásaikat, és lehetőséget biztosít azok törlésére.