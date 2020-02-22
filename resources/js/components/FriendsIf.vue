<template>
    <div id="root">
        <div id="name-input">
            <input v-model="name">
            <br/>
            <button v-on:click="addName">ADD A NEW FRIEND</button>
        </div>
        <h1 v-if="h1">{{ categoryMessage }}</h1>
        <h2 v-else-if="h2">{{ categoryMessage }}</h2>
        <p v-else>{{ categoryMessage }}</p>
        <div 
            v-for="item in friends.slice().reverse().slice(0, 10)"
            :key="item.id"
        >
            <p>{{ text }} {{ item.name }}!</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        text: String,
        h1: Boolean,
        h2: Boolean,
    },
    data() {
        return {
            id: 0,
            name: '',
            friends: [],
            categoryMessage: '10 last friends',
        }
    },
    methods: {
        addName() {
            this.friends.push({
                id: this.id,
                name: this.name ? this.name : 'Stranger'
            })
            this.name = '';
            this.id++;
        },
    } 
}
</script>

<style scoped>
    h1, h2, p {
        color: slategray;
        padding: 0%;
        margin-left: 1%;
        margin-right: 1%;
        margin-top: 0%;
        margin-bottom: 0%;
    }
    input {
        width: 50%;
    }
    #root {
        width: 100%;
        padding-left: 15%;
        padding-right: 15%;
        padding-top: 1%;

    }
    #name-input {
        padding-bottom: 5%;
    }
    #friend {
        color: darkslateblue;  
    }
    #enemy {
        color: darkgreen;
    }
</style>