# **BaseSeats komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens a **mozihelyszínre** és a **vetítés időpontjára** épül. Lehetőséget nyújt a felhasználóknak, hogy kijelöljék a kívánt parkolóhelye(ke)t, ahonnan a mozifilmet kívánják megtekinteni.

- **Fő felhasználói interakciók**:
  - Parkolóhely(ek) áttekintése,
  - Parkolóhely(ek) kijelölése,
  - Parkolóhely(ek) foglalása / várásárlási szándék jelzése,
  - Helyszínek vizuális megjelenítése, interakciója,
  - Már megvásárolt / lefoglalt helyszínek vizuális megjelenítése a felhasználó(k) számára,

## **2. Külső függőségek**
- **Importok, csomagok**: `useTicketStore` (bolt), `useRouter` (útvonalkezelés), `http` (HTTP kérések), `BaseSpinner` (betöltő animáció)

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**                      |
| --------------- | ---------------------------------------------- |
| `<BaseSpinner>` | Betöltés jelzésére szolgáló animációs elem     |
| `<h2>`          | A mozi vászonának címét tartalmazza            |
| `<div>` (grid)  | A mozihelyszínek elhelyezésére szolgáló rács   |
| `<div>` (sorok) | A helyszínek megjelenítése a felhasználóknak   |
| `<button>`      | Tovább gomb, a parkolóhelyek kiválasztása után |
| `<template>`    | Helyek infóinak vizuális megjelenítése         |

## **4. Logika és interakciók**
- **Script setup tartalom**: A komponens a "parkolóhelyek" inicializálásával és betöltésével foglalkozik.
- **Eseménykezelés**: A helyek kijelölése a `toggleSeat` metódussal, a „***Tovább***” gomb eseménykezelése.
- **Reaktív adatok**: `seats`, `selectedSeats`, `reservations`, `purchases`, `loading`, valamint `foglaltParkolok` számítása.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                |
| ------------------ | -------------------------------------------- |
| **Színek**         | Szürke háttér, sárga és rózsaszín kiemelések |
| **Betűtípus**      | Nincs specifikálva                           |
| **Reszponzivitás** | Mobilra optimalizált elrendezés              |
| **Effektek**       | Átmeneti effektek a helyek kijelölésekor     |

## **A komponenst tartalmi összefoglalója**
A komponens célja, hogy vizuálisan bemutassa a mozihelyszínek foglalási folyamatát, lehetőséget biztosítva az autós helyek kiválasztására és foglalására a felhasználók számára.