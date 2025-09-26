# **LocationViewer *(helyszínválasztó)* komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi, hogy a felhasználók áttekinthessék a mozihelyszínek kínálatát, elhelyezkedéseiket.

- **Fő felhasználói interakciók**:
  - Helyszínek kiválasztása
  - Kattintás a kiválasztott helyszínekre

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `BaseCard`
  - `useDriveInCinemaStore`
  - `useRouter`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**                     |
| -------------- | --------------------------------------------- |
| `<BaseLayout>` | Az oldal vázát biztosítja                     |
| `<h1>`         | Helyszín kiválasztási cím                     |
| `<div>`        | Helyszínek megjelenítése rácsos elrendezésben |
| `<BaseCard>`   | Helyszín részleteinek megjelenítése           |

## **4. Logika és interakciók**
- **Script setup tartalom**: Helyszínek betöltése és kiválasztásuk kezelése.
- **Eseménykezelés**: Kattintás a kiválasztott helyszínekre.
- **Reaktív adatok**: Nincs.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                    |
| ------------------ | -------------------------------- |
| **Színek**         | Rózsaszín (címek), szürke háttér |
| **Betűtípus**      | Nincs specifikálva               |
| **Reszponzivitás** | Mobilbarát elrendezés            |
| **Effektek**       | Háttér homályosítás animációk    |

## **A komponenst tartalmi összefoglalója**
A komponens célja, hogy lehetőséget adjon a felhasználóknak a mozi **helyszínek** böngészésére és kiválasztására, ezzel **segítve a foglalási folyamatot.**