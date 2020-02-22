<template>
    <div id="root">
        <div id="name-input">
            <input v-model="name">
            <br/>
            <button v-on:click="addName">ADD A NEW FRIEND</button>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h1 v-if="h1">{{ category }}</h1>
                <h2 v-else-if="h2">{{ category }}</h2>
                <p v-else>{{ category }}</p>
                <div class="row">
                    <p 
                        class="col-xs-1 col-sm-1 col-md-1 col-lg-1"
                        v-for="i in id" :key="i"
                        :id="i % 2 == 0 ? 'friend' : 'enemy'"
                    >
                         o  <br/>/|\ <br/> ||  <br/>
                    </p>
                </div>
            </div>
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
            category: 'All my friends',
            categoryMessage: '10 last friends',
        }
    },
    mounted() {},
    methods: {
        addName() {
            this.friends.push({
                id: this.id,
                name: this.name ? this.name : 'Stranger'
            })
            this.name = ''
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
        color:darkslateblue;  
    }
    #enemy {
        color: darkgreen;
    }
</style>