# **LocationChoose komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi, hogy a felhasználók kiválasszák a kívánt helyszínt a moziprogramokhoz.
- **Fő felhasználói interakciók**:
  - Helyszín kiválasztása
  - Megjelenítési képek és információk kattintásra

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `BaseCard`
  - `useDriveInCinemaStore`
  - `useTicketStore`
  - `useRouter`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**                                   |
| -------------- | ----------------------------------------------------------- |
| `<BaseLayout>` | Az oldal vázát biztosítja                                   |
| `<Stepper>`    | Egy lépésmutató, amely megjeleníti a kiválasztott lépéseket |
| `<h1>`         | Kérlek, válaszd ki a helyszínt cím                          |
| `<div>`        | Helyszínek bemutatása rácsos elrendezésben                  |
| `<BaseCard>`   | Helyszín részleteinek megjelenítése                         |

## **4. Logika és interakciók**
- **Script setup tartalom**: Helyszínek betöltése és kiválasztásuk kezelése.
- **Eseménykezelés**: Kattintás a kiválasztott helyszínekre.
- **Reaktív adatok**: Nincs.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                         |
| ------------------ | ------------------------------------- |
| **Színek**         | Rózsaszín (címek), szürke háttér      |
| **Betűtípus**      | Nincs specifikálva                    |
| **Reszponzivitás** | Mobilbarát elrendezés                 |
| **Effektek**       | Képátmenetek és animációk a háttérben |

## **A komponenst tartalmi összefoglalója**
A komponens célja, hogy a felhasználóknak lehetőséget biztosítson a mozi helyszínek kiválasztására, így segítve a foglalási folyamatot.