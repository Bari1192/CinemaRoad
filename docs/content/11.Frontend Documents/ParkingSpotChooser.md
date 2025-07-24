# **ParkingSpotChooser.vue - szerkezete:**

## **1. Komponens áttekintése**

- **Célja és funkciója**: Layout komponens a parkolóhely kiválasztási oldalhoz, amely a BaseSeats komponenst tartalmazza és kezeli a localStorage-ból való adatok visszaállítását.

- **Fő felhasználói interakciók** listája:
  - Stepper komponens vizuális megjelenítése (4. lépés)
  - BaseSeats komponensen keresztüli parkolóhely kiválasztás
  - Automatikus adatok visszaállítása localStorage-ből

## **2. Külső függőségek**

- **Importok, csomagok**:
  - `useTicketStore` - Pinia store a jegykezeléshez
  - `Stepper` - lépéskövető komponens
  - `BaseSeats` - parkolóhely kiválasztó komponens
  - `BaseHeader`, `BaseFooter` - layout komponensek

- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**

| **Elem** | **Funkció, stílusjegyek** |
|----------|---------------------------|
| `<BaseHeader />` | Oldal fejléc komponens |
| `<Stepper>` | Lépéskövető komponens - currentStep="4" |
| `<div class="w-full h-full">` | Fő konténer - teljes szélesség/magasság, `px-4` padding |
| `<BaseSeats />` | Parkolóhely kiválasztó komponens |
| `<BaseFooter />` | Oldal lábléc komponens |

## **4. Logika és interakciók**

- **Script setup tartalom**:
  - `ticketStore` inicializálása
  - LocalStorage ellenőrzés és adatok visszaállítása minden store tulajdonsághoz
  - Feltételes adatbetöltés localStorage-ból (location, locationName, movie, time, parkingSpot)

- **Eseménykezelés**: Nincs közvetlen eseménykezelés

- **Reaktív adatok**: Store-ban tárolt adatok reaktív kezelése localStorage-en keresztül

## **5. Stílus összefoglaló**

| **Kategória** | **Részletek** |
|---------------|---------------|
| **Színek** | Nincs közvetlen színhasználat |
| **Betűtípus** | Tailwind alapértelmezett |
| **Reszponzivitás** | Nincs specifikus breakpoint |
| **Effektek** | Nincs |

---
