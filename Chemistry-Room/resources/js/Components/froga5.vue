<template>
    <article
        class="d-flex flex-row justify-content-around my-3"
        @drop="drop"
        @dragover="allowDrop"
    >
        <section
            :id="taldeUnicos[index]"
            v-for="(talde, index) in taldeUnicos"
            class="talde mx-3"
        >
            <div
                class="tituloTalde d-flex align-items-center justify-content-center"
            >
                <h2>{{ talde }}</h2>
            </div>
        </section>
    </article>

    <article class="my-5" id="hitzRandom">
        <div
            v-for="(izena, index) in izenak"
            class="d-flex flex-row justify-content-evenly py-2"
        >
            <p
                :id="taldeak[index]"
                class="hitz fs-3"
                @dragstart="drag"
                draggable="true"
            >
                {{ izena }}
            </p>
        </div>
    </article>
</template>

<script>
export default {
    mounted() {
        this.cargarDatos();
        this.numAleatoriosNoRepes(20, 197, 1);
    },
    data() {
        return {
            koloreDefault: "#EAEBED",
            koloreTxarto: "#E73C37",
            taldeak: [],
            taldeUnicos: [],
            izenak: [],
            numeros: [],
            unicos: [],
            pista: "",
            correctos: 0,
        };
    },
    methods: {
        // Llama a un php para que le devuelva los datos de la database y los guarda en sus respectivos arrays
        cargarDatos() {
            fetch("../public/php/datosFroga5.php", {
                method: "POST",
                body: "#froga",
            })
                .then((response) => response.json())
                .then((data) => {
                    for (let i = 0; this.numeros.length > i; i++) {
                        this.unicos.push(this.numeros[i]);
                        this.izenak.push(data[0][this.numeros[i]]);
                        this.taldeak.push(data[1][this.numeros[i]]);
                        !this.taldeUnicos.includes(data[1][this.numeros[i]])
                            ? this.taldeUnicos.push(data[1][this.numeros[i]])
                            : null;
                    }
                    this.pista = data[2][0];
                });
        },
        // Numero aleatorio entre el 0 y 25 y lo guarda en numeros
        numAleatoriosNoRepes(kant, max, min) {
            let i = 0;
            while (i < kant) {
                let num = Math.round(Math.random() * (max - min) + min);
                if (!this.numeros.includes(num)) {
                    this.numeros.push(num);
                    i++;
                }
            }
        },
        //DRAG
        drag(e) {
            this.p = e.target;
        },
        // DROP
        drop(e) {
            e.preventDefault();
            e.target.appendChild(this.p);
            this.div = e.target;
            this.solucion();
        },
        allowDrop(e) {
            e.preventDefault();
        },
        solucion() {
            if (this.div.id == this.p.id) {
                // Correcto
                this.p.style.color = this.koloreDefault;

                if (this.correctos != 19) {
                    this.correctos++;
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Zorionak",
                        text: "Irabazi duzu jokoa",
                        background: "#21605D",
                        color: "white",
                        confirmButtonColor: "#339476",
                    }).then((value) => {
                        this.gorde();
                        window.location.href = "./froga6";
                    });
                }
                console.log(
                    "🚀 ~ file: froga5.vue:84 ~ solucion ~ this.correctos",
                    this.correctos
                );
            } else {
                // Incorrecto
                this.p.style.color = this.koloreTxarto;
            }
        },
        gorde() {
            localStorage.clear();
            let minuto = document.getElementById("min").innerHTML;
            let segundo = document.getElementById("sec").innerHTML;
            localStorage.setItem("min", minuto);
            localStorage.setItem("sec", segundo);
        }
    },
    computed: {},
};
</script>
