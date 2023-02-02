<template>
    <div
        class="d-flex flex-column position-absolute bottom-0 end-0 justify-content-end align-items-center"
    >
        <div v-if="show">
            <div class="bocadilloPista d-flex justify-content-center">
                <h2 class="pistaText p-3 text-justify">
                    {{ getWindowName(window.location.pathname[window.location.pathname.length - 1]) }}
                </h2>
            </div>
        </div>
        <div v-else class="bombilla">
            <a @click="showHide">
                <img src="../../../public/multimedia/bombilla.svg" alt="" />
            </a>
        </div>
        <img
            id="maskotaJuego"
            src="../../../public/multimedia/quimica.png"
            alt=""
        />
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            time: 0,
            intervalTime: "",
            pistaJSON: localStorage.getItem("pistak").split(",") || "Error",
            pistaFroga: {
                1: this.pistaJSON[0],
                2: this.pistaJSON[1],
                3: this.pistaJSON[2],
                4: this.pistaJSON[3],
                5: this.pistaJSON[4],
                6: this.pistaJSON[5],
            },
        };
    },
    methods: {
        showHide() {
            this.show = !this.show;
            this.timer();
        },
        timer() {
            const SELF = this;
            if (this.time < 10) {
                this.intervalTime = setInterval(function () {
                    if (SELF.time < 10) {
                        SELF.time++;
                    } else {
                        SELF.showHide();
                        SELF.time = 0;
                        clearInterval(SELF.intervalTime);
                    }
                }, 1000);
            }
        },
    },

    computed: {
        /**
         *
         * @param {String} name
         */
        getWindowName(name) {
            // console.log(pistaFroga[name]);
            return pistaFroga[name] || "Error";
        },
    },
};
</script>
