# **ParkingSpotChooser komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi a felhasználók számára, hogy az adott vetítésre és mozihelyszínre még elérhető parkolóhelyeket böngésszenek, kiválasztott szabad parkolóhelyet / nézőtéri területet foglalhassanak.
- **Fő felhasználói interakciók**:
  - Helyszín és vetítés kiválasztása
  - Parkolóhelyek megtekintése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `useTicketStore`
  - `Stepper`
  - `BaseSeats`
  - `BaseHeader`
  - `BaseFooter`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**       |
| -------------- | ------------------------------- |
| `<BaseLayout>` | Az oldal vázát biztosítja       |
| `<Stepper>`    | A kiválasztott lépések mutatója |
| `<h1>`         | Helyszínválasztási cím          |
| `<BaseSeats>`  | Parkolóhelyek megjelenítése     |
| `<BaseFooter>` | Az oldal láblécét biztosítja    |

## **4. Logika és interakciók**
- **Script setup tartalom**: A helyszín, vetítés és parkolóhelyek betöltése.
- **Eseménykezelés**: Kattintás a kiválasztott helyszínekre.
- **Reaktív adatok**: `ticketStore`, `storage`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                        |
| ------------------ | ------------------------------------ |
| **Színek**         | Szürke és indigó háttér              |
| **Betűtípus**      | Nincs specifikálva                   |
| **Reszponzivitás** | Mobilbarát elrendezés                |
| **Effektek**       | Átmeneti effektek a parkolóhelyeknél |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy a felhasználók könnyen böngészhessenek az adott vetítésre elérhető parkolóhelyek között a kiválasztott mozihelyszínen, vizuális elemekkel szemléltetve a nézőtér felépítését ezzel támogatva a jegyfoglalás hatékonyságát és kényelmét, élményét.