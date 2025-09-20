# **TimeSelector komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi a felhasználók számára, hogy kiválasszanak egy vetítési időpontot a megadott mozihelyszínen.

- **Fő felhasználói interakciók**:
  - Vetítési időpont kiválasztása
  - Következő lépés gomb megnyomása

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `Stepper`
  - `Calendar`
  - `useTicketStore`
  - `useScreeningStore`
  - `useMovieStore`
  - `useRouter`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**              |
| -------------- | -------------------------------------- |
| `<BaseLayout>` | Az oldal vázát biztosítja              |
| `<Stepper>`    | A kiválasztott lépéseket mutatja       |
| `<h1>`         | Helyszín és film címének megjelenítése |
| `<Calendar>`   | Vetítési időpontok kiválasztása        |
| `<button>`     | Következő lépés gomb                   |

## **4. Logika és interakciók**
- **Script setup tartalom**: Helyszínek és vetítések betöltése, valamint a kiválasztás logikája.
- **Eseménykezelés**: Kiválasztott időpont eseményének kezelése.
- **Reaktív adatok**: `screenings`, `filteredScreenings`, `kiválasztottVetítésId`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                    |
| ------------------ | -------------------------------- |
| **Színek**         | Rózsaszín (címek), szürke háttér |
| **Betűtípus**      | Nincs specifikálva               |
| **Reszponzivitás** | Mobilbarát elrendezés            |
| **Effektek**       | Átmenetek a gombokon             |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy lehetőséget biztosítson a felhasználóknak a kiválasztott mozihelyszínen elérhető vetítési időpontok megtekintésére és kiválasztására.