# Blendr
Todo:

- Axios -> calls, data ophalen: ok
- Kijken naar nuttige data: ok
- table, elke rij is parkeergarage (naam, capacity = kolommen): ok
- x aantal seconden opnieuw laden: ok
- responsive: ok
    - 500px of kleiner width -> table width = 100%
    - 500px of groter -> table width = 500px
- spinner icoontje tijdens het laden draait het, anders niet draaien. Zie favicons of glypicons
   
valet secure -> geolocation api shit



    calculateDistance(from, to) : promise
    const afstand = await calculateDistance(gent, brussel)
    afstand = 50
    addItem -> uitbreiden
    {
    date: this.date,
    destination: this.destianction
    distance: await this.calculateDistance(from, this.destination)
    }

    created(){
    console.log(
    await this.calculateDistance(‘gent’, ‘brussel’)
    )
    }
