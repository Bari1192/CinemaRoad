
# **BaseSeats.vue - szerkezete:**

## **1. Komponens áttekintése**

- **Célja és funkciója**: Moziterem parkolóhely kiválasztó komponens, amely grid alapú elrendezésben jeleníti meg a parkolóhelyeket és lehetővé teszi többszörös kiválasztást.

- **Fő felhasználói interakciók** listája:
  - Parkolóhely kiválasztása/kijelölés megszüntetése kattintással
  - Kiválasztott helyek vizuális visszajelzése
  - "Tovább" gomb használata a következő lépéshez
  - Mozivászon és útirányok vizualizációja

## **2. Külső függőségek**

- **Importok, csomagok**:
  - `ref` - Vue Composition API
  - `useTicketStore` - Pinia store
  - `useRouter` - Vue Router

- **Betűtípusok, CDN-ek**: FontAwesome ikonok (`fa-solid` osztályok)

## **3. Strukturális elemek**

| **Elem** | **Funkció, stílusjegyek** |
|----------|---------------------------|
| `<div class="container w-full">` | Fő konténer - sötét háttér (`bg-gray-800/80`), `rounded-3xl`, `shadow-xl` |
| `<h2>` | Címsor - szürke szín (`text-slate-400`), `text-3xl`, `uppercase` |
| `<div class="grid grid-cols-8">` | Mozivászon konténer - 8 oszlopos grid |
| `<div class="col-span-7">` | Mozivászon elem - sötét háttér (`bg-gray-900`), kerekített felső rész |
| `<div class="grid grid-cols-11">` | Oszlopszámok fejléce - 11 oszlopos grid |
| `<div v-for="col">` | Oszlopszám cellák - sárga szín (`text-yellow-500`), rózsaszín keret |
| `<div v-for="row">` | Sor konténerek - dinamikus tartalom row típus szerint |
| `<div v-if="row !== 'X'">` | Sor betűjelek - sárga szín, rózsaszín keret, kerekített |
| `<div v-if="row == 'X'">` | Út sávok - szürke háttér (`bg-gray-600/30`), nyíl ikonokkal |
| `<i class="fa-solid">` | FontAwesome ikonok - irányjelzők (`fa-angles-right`, `fa-angles-up`, `fa-angles-down`) |
| `<div v-for="col in 8">` | Parkolóhely cellák - kattintható, dinamikus stílussal |
| `<span class="md:hidden">` | Mobil szöveg - sárga szín (`text-yellow-400`), rejtett nagyobb képernyőkön |
| `<div class="text-white">` | Kiválasztott helyek megjelenítő - fehér és zöld szín |
| `<button @click="handleNext">` | Tovább gomb - rózsaszín háttér (`bg-pink-700`), letiltható |

## **4. Logika és interakciók**

- **Script setup tartalom**:
  - `rows` és `cols` konstansok - grid felépítés (X = út, betűk = sorok)
  - `seats` ref - parkolóhelyek tömb objektumokkal (id, row, col, reserved, occupied)
  - `selectedSeats` ref - kiválasztott helyek ID-i
  - Seats tömb inicializálása for ciklusokkal

- **Eseménykezelés**:
  - `@click="toggleSeat(seatID)"` - parkolóhely kiválasztás/törlés
  - `@click="handleNext"` - továbblépés kezelése
  - `toggleSeat()` függvény - seat állapot váltása és selectedSeats frissítése

- **Reaktív adatok**:
  - `seats` - ref tömb a parkolóhelyek állapotával
  - `selectedSeats` - ref tömb a kiválasztott helyek ID-ivel
  - Dinamikus CSS osztályok a seat állapotok alapján

## **5. Stílus összefoglaló**

| **Kategória** | **Részletek** |
|---------------|---------------|
| **Színek** | `bg-gray-800/80`, `text-slate-400`, `bg-gray-900`, `text-yellow-500`, `border-pink-700/50`, `bg-red-600`, `bg-lime-950/45`, `border-lime-600`, `text-lime-500`, `bg-pink-700` |
| **Betűtípus** | `font-bold`, `font-semibold`, `font-extrabold`, `text-3xl`, `text-2xl`, `text-lg`, `text-xs` |
| **Reszponzivitás** | `sm:w-10`, `md:w-14`, `md:hidden`, `lg:text-lg`, `xl:text-xl`, `lg:max-w-3xl`, `xl:max-w-5xl` |
| **Effektek** | `shadow-xl`, `shadow-2xl`, `rounded-3xl`, `transition duration-300`, `blur-lg`, `hover` állapotok, `disabled:opacity-60` |

**Hibakeresés megjegyzés**: A komponens CSS-ben található `car-parking-place` és `reservationMDSIZE` osztályok nincsenek használatban a template-ben, valószínűleg régi kód maradványok.