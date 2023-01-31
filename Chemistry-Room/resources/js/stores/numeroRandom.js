import { defineStore} from 'pinia'

export const useCounterStore = defineStore('znbk', {
    state: () => ({
        numero:0
    }),
    getters: {

    },
    actions: {
        numAleatoriosNoRepes() {
           this.numero = Math.round(Math.random() * (9999 - 1000) + 1000);
        },
    }
})
