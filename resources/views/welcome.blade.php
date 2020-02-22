<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel & Vue</title>

        <!-- Style Sheets -->
        <link 
            rel="stylesheet" 
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        >
        <link rel="stylesheet" href="<?php echo asset('css/prism.css')?>" type="text/css"> 

        <!-- Scripts -->
        <script src="<?php echo asset('/js/app.js')?>"></script> 
        <script src="<?php echo asset('/js/prism.js')?>"></script>
        
    </head>
    <body>
        <div id="app" style="text-align:center;margin-top:2%;margin-bottom:2%;">

<h1>Laravel & Vue.js: Quickstart</h1>
<br/>
<br/>
<div style="width:50%;text-align:left;margin-left:25%;margin-right:25%;">
<p>Vue.js is an open-source JavaScript framework that lets you extend HTML to easily create complex user interfaces and single page applications. 
Easy to integrate with Laravel, this is the perfect combination to draw a line between the front and the back ends while making them both powerful.</p>
<img src="<?php echo asset('/images/laravue.png')?>" style="width:100%;">
<br/>
<br/>
<p>In this tutorial, you'll learn to integrate Vue.js to a Laravel project. Then you'll learn the basics through a little Vue.js project.</p>
<br/>
<h2>Setting up the project</h2>
<br/>
<p>Let's create a project called <b>vue-tuto</b> by executing the following command in a bash command line:</p>
<pre><code class="language-bash">composer create-project laravel/laravel vue-tuto</code></pre>
<br/>
<p>Then we can move inside the project and install the PHP and JavaScript dependencies:</p>
<pre><code class="language-bash">cd vue-tuto
composer install
npm install</code></pre>
<br/>
Now let's install Vue.js and make the components we'll create loadable from <b>.vue</b> files using the following commands:
<pre><code class="language-bash">npm install vue --save-dev
npm install vue-template-compiler --save-dev</code></pre>
<br/>
If everything went well, you should have two new lines in  the <b>devDependencies</b> of your <b>package.json</b> file, containing
the following content:
<pre><code class="language-json">"devDependencies": {
    ...
    "vue": "^2.6.11",
    "vue-template-compiler": "^2.6.11"
}</code></pre>
<p>Note that the version here is 2.6.11 but it may of course vary.</p>
<br/>
To enable Vue.js globally, you'll need to attach it to the <b>window</b> by adding the following
line at the end of the <b>/resources/js/app.js</b> file:
<pre><code class="language-js">window.Vue = require('vue');</code></pre>
<br/>
After that you'll need, in the same file, to add the code that will instantiate Vue.js in the window after it has loaded:
<pre><code class="language-js">window.onload = function(e) {
    const app = new Vue({
        el: '#app'
    });
}</code></pre>
Like you can see, Vue.js is instanciated into an element with the id <b>app</b>. Therefore, you need to add this element 
to the <b>/resources/views/welcome.blade.php</b> view. Before that, let's clean this view and delete the fonts and styles in the <b>head</b> 
element and all the content of the body. Now you can add this in the <b>body</b> element :
<pre><code class="language-html">&lt;div id="app" style="text-align:center;margin-top:2%;margin-bottom:2%;"&gt;

&lt;/div&gt;
</code></pre>
<p>Note that a style has been added to the <b>div app</b>. It is not required but we'll use it to make things prettier in the rest 
of this tutorial.
<br/>
<br/>
<h2>Adding a component</h2>
<br/>
<div>
Let's create a <b>components</b> folder in the <b>/resources/js/</b> directory and a new file in called <b>Face.Vue</b> in this folder. 
Then let's add a basic structure in this file:
</div>
<pre>
<code class="language-html">&lt;template&gt;
&lt;/template&gt;</code>
<code class="language-html">
&lt;script&gt;</code><code class="language-js">
export default {
}</code>
<code class="language-html">&lt;/script&gt;

&lt;style scoped&gt;</code>
<code class="language-css"></code><code class="language-html">&lt;/style&gt;</code></pre>
In the above code:
<ul>
<li>the <b>template</b> tags will contain the HTML code,</li>
<li>the <b>script</b> tags will hold all the properties passed to the component, its internal data, its methods...</li>
<li>the <b>style</b> tags will contain all the CSS properties that will only apply locally to the component if the 
<b>scoped</b> attribute is present, and apply globally otherwise.</li>
</ul>
<br/>
Now we need to tell our application that we want to name a new component based on the content of the <b>Face.vue</b> file. Let's 
do that by adding the following line in the <b>/resources/js/app.js</b> file:
<pre><code class="language-js">Vue.component('face', require('./components/Face.vue').default);</code></pre>
<p>This component should be added between the Vue.js declaration and its instanciation. Therefore the end of your 
<b>/resources/js/app.js</b> file should look like this:
<pre><code class="language-js">window.Vue = require('vue');

Vue.component('face', require('./components/Face.vue').default);

window.onload = function(e) {
    const app = new Vue({
        el: '#app'
    });
}</code></pre>
<p>Every new component should be added this way.</p>
<br/>
<p>Don't forget to add the script to the <b>head</b> element of the <b>welcome.blade.php</b> view:</p>
<pre><code class="language-html">&lt;script src="&lt;?php echo asset('/js/app.js')?&gt;"&gt;&lt;/script&gt;</code></pre>
<br/>
<p>Before adding the component to the view, we'll make it actually do something. For the moment, it's totally empty so let's make 
show a little text by first adding the following code in the <b>template</b> and <b>script</b> tags:
<pre><code class="language-html">&lt;template&gt;
    &lt;div&gt;</code><code class="language-js">
        @{{ text }}</code><code class="language-html">
    &lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;</code><code class="language-js">
export default {
    props: {
        text: String
    }
}</code>
<code class="language-html">&lt;/script&gt;</code></pre>
This code makes the <b>face</b> component able to take a <b>text</b> attribute of type <b>String</b> and will 
show the text defined by this attribute in a <b>div</b> element. You can now create a new <b>face</b> component
inside the <b>div app</b> in the <b>welcome.blade.php</b> view:
<pre><code class="language-html">&lt;div id="app" style="text-align:center;margin-top:2%;margin-bottom:2%;"&gt;
    &lt;face text="Hello world!"&gt;&lt;/face&gt;
&lt;/div&gt;
</code></pre>
<p>There is now one more step: you need to compile the <b>Face.vue</b> content by running the following command:
<pre><code class="language-html">npm run dev</code></pre>
<p>It should compile successfully. Be careful, you'll need to repeat this step each time you add a component or change 
its content. Hopefully, you can simply run the following command to ensure an automated compilation:</p>
<pre><code class="language-html">npm run watch</code></pre>
<br/>
<p>Now launch your server in another terminal:</p>
<pre><code class="language-html">php artisan serve</code></pre>
<br/>
<p>Your view is not available on  <a href="http://localhost:8000" target="_blank">http://localhost:8000</a> and should
show this:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <c-basic text="Hello world!" style="margin-top:2%;margin-bottom:2%;"></c-basic>
</div>
<br/>
<p> Like you can see, the curly braces replace the text property by the name given in the view. Congratulations! You just created 
your first Vue.js component... now comes the fun part!</p>
<br/>
<br/>
<h2>Introducing our future app</h2>
<br/>
<p>Let's build an app called <i>FaceVue</i>. With this app, you'll be able to greet new friends after naming them, see the last 
10 friends you've greeted and look at all those friends. Here is what you'll obtain at the end of this turorial:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <h1 style="margin-top:2%;">FaceVue</h1>
    <example-component text="Hello" h2 style="margin-bottom:2%;min-height:30em;max-height:30em;overflow:scroll"></example-component>
</div>
<br/>
<br/>
<h2>Styling our app</h2>
<br/>
Let's first add the bootstrap stylesheet in the <b>head</b> element of the <b>welcome.blade.php</b> view:
<pre><code class="language-html">&lt;link 
    rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
&gt;</code></pre>
<br/>
Let's also put the following style in the <b>Face.vue</b> file:
<pre><code class="language-html">&lt;style scoped&gt;</code><code class="language-css">
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
    }</code><code class="language-html">
&lt;/style&gt;</code></pre>
<p>The <b>root</b>, <b>name-input</b>, <b>friend</b> and <b>enemy</b> ids will appear later in the template.</p>
<br/>
<br/>
<h2>Building our app</h2>
<br/>
<p>Now let's add more features to our <b>face</b> component:</p>
<pre><code class="language-html">&lt;template&gt;
    &lt;div id="root"&gt;
        &lt;div id="name-input"&gt;
            &lt;input v-model="name"&gt;
        &lt;/div&gt;</code><code class="language-js">
        @{{ text }} @{{ name }}!</code><code class="language-html">
    &lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;</code><code class="language-js">
export default {
    props: {
        text: String
    },
    data() {
        return {
            name: '',
        }
    },
}</code>
<code class="language-html">&lt;/script&gt;</code></pre>
<p>Here above we have:</p>
<ul>
    <li>added a <b>root</b> id to the main <b>div</b> for style purposes,</li>
    <li>in the script, added a function <b>data</b> that returns a variable <b>name</b> which is an empty <i>String</i>,</li>
    <li>in the template, added a new variable inside curly braces, followed by an exclamation point. The variable inside the <b>data</b> is read like
    the properties. However, it cannot be passed through the component in the view. That's why we gave it a default value. This <b>name</b>
    variable is thus intern for the <b>face</b> component,</li>
    <li>in the template, added a <b>div</b> with the id <b>name-input</b> that contains an <b>input</b> with a <b>v-model</b> attribute 
    that refers to the <b>name</b> variable</li>
</ul>
<br/>
<p>We'll change the value of the <b>text</b> attribute of the <b>face</b> component in the view:</p>
<pre><code class="language-html">&lt;face text="Hello"&gt;&lt;/face&gt;</code></pre>
<br/>
<p>Here is the result you should obtain:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <c-name text="Hello" style="margin-bottom:2%;min-height:10em;max-height:10em;overflow:scroll"></c-name>
</div>
<p>Every time you type something in the <b>input</b>, the <b>name</b> variable will be refreshed, which will update the view. This wil happen with all the 
variables returned by the <b>data</b> function.
<br/>
<p>We'll now add more data. An <b>id</b> variable with a default value of 0, incremented whenever we add a new friend, will serve as an <b>id</b> giver to each 
friend. A <b>friends</b> variable will store all our friends, each having a <b>name</b> and an <b>id</b>. We'll also add a method that creates a new friend 
and add it to our friends:</p>
<pre><code class="language-html">&lt;template&gt;
    &lt;div id="root"&gt;
        &lt;div id="name-input"&gt;
            &lt;input v-model="name"&gt;
            &lt;br/&gt;
            &lt;button v-on:click="addName"&gt;ADD A NEW FRIEND&lt;/button&gt;
        &lt;/div&gt;
        &lt;div 
            v-for="item in friends"
            :key="item.id"
        &gt;
            &lt;p&gt;</code><code class="language-js">@{{ text }} @{{ item.name }}</code><code class="language-html">!&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;</code><code class="language-js">
export default {
    props: {
        text: String
    },
    data() {
        return {
            id: 0,
            name: '',
            friends: [],
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
}</code>
<code class="language-html">&lt;/script&gt;</code></pre>
<p>The element with the <b>name-input</b> id has been changed:</p>
<pre><code class="language-html">&lt;div id="name-input"&gt;
    &lt;input v-model="name"&gt;
    &lt;br/&gt;
    &lt;button v-on:click="addName"&gt;ADD A NEW FRIEND&lt;/button&gt;
&lt;/div&gt;</code></pre>
 The greeting it showed has been replaced by a <b>button</b> with an attribute 
<b>v-on:click</b> that refers to the method <b>addName</b>. This method is triggered whenever the <b>button</b> is clicked. This method is a function 
defined in a new field called <b>methods</b> that will contain all the methods internal to the component.</p>
<p>A new <b>div</b> element has appeared :</p>
<pre><code class="language-html">&lt;div 
    v-for="item in friends"
    :key="item.id"
&gt;
    &lt;p&gt;</code><code class="language-js">@{{ text }} @{{ item.name }}</code><code class="language-html">!&lt;/p&gt;
&lt;/div&gt;</code></pre>
It contains a <b>v-for</b> attribute. This attribute iterates on the list of friends and will show a <b>div</b> 
element for each element in this list. Each element can be accessed with the variable <b>item</b> that could be renamed to whatever you want. The 
fields of the item (<b>name</b> and <b>id</b>) can be acccessed inside the <b>div</b>. It also needs a <b>:key</b> attribute, a short version for <b>v-bind:key</b>. 
This attribute is required whenever we use the <b>v-for</b> attribute. This is why we define an <b>id</b> variable for each item in the <b>friends</b> list.</p>
<p>The <b>addName</b> method is self-explanatory. Note that it sets the <b>name</b> variable to an empty <i>String</i> after each time a new friend is added. This 
will empty the <b>input</b>.The variables defined in the <b>data</b> can be accessed into a method by using the reference <b>this</b>:</p>
<pre><code class="language-js">methods: {
    addName() {
        this.friends.push({
            id: this.id,
            name: this.name ? this.name : 'Stranger'
        })
        this.name = '';
        this.id++;
    },
}</code></pre>
<br/>
<p>Here is the result you should obtain:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <c-friends text="Hello" style="margin-bottom:2%;min-height:20em;max-height:20em;overflow:scroll"></c-friends>
</div>
<br/>
<p>Those typical Vue.js attributes allow to put some javascript in the value assigned to them inside the double quotes. For example, if we just want to show 
the greetings for the 10 last friends that have been added, in the reverse order (the last friends are printed above the older ones) we can just replace the content 
of the <b>v-for</b> attribute by the following one:
<pre><code class="language-html">&lt;div 
    v-for="item in friends.slice().reverse().slice(0, 10)"
    :key="item.id"
&gt;</pre></code>
<br/>
<p>And we obtain:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <c-friends-plus text="Hello" style="margin-bottom:2%;min-height:25em;max-height:25em;overflow:scroll"></c-friends-plus>
</div>
<br/>
<p>Of course, Vue.js also proposes conditional attributes. As an example, we'll add <b>categoryMessage</b> <b>data</b> variable that will be showed in a 
<b>h1</b>, <b>h2</b> or <b>p</b> element depending on what we want. To achieve that, you just need to add two new <b>props</b> next to <b>text</b>:
<pre><code class="language-js">h1: Boolean,
h2: Boolean,</code></pre>
<p>Add a new <b>data</b> variable :</p>
<pre><code class="language-js">categoryMessage: '10 last friends',</code></pre>
<p>And then add the three following line in the template, between the <b>div</b> with the <b>name-input</b> id and the loop-iterating <b>div</b>:</p>
<pre><code class="language-html">&lt;h1 v-if="h1"&gt;</code><code class="language-js">@{{ categoryMessage }}</code><code class="language-html">&lt;/h1&gt;
&lt;h2 v-else-if="h2"&gt;</code><code class="language-js">@{{ categoryMessage }}</code><code class="language-html">&lt;/h2&gt;
&lt;p v-else&gt;</code><code class="language-js">@{{ categoryMessage }}</code><code class="language-html">&lt;/p&gt;</code></pre>
<p>Here we learn two new concepts: 
<ul>
    <li>the <i>Boolean</i> values <b>h1</b> and <b>h2</b> are false if they are not present as attributes in the <b>face</b> component in the view and they are 
    true otherwise,</li>
    <li>the <b>v-if</b>, <b>v-else-if</b> and <b>v-else</b> attributes impose a conditional rendering, meaning here that if the <b>h1</b> attribute is present, 
    the <b>categoryMessage</b> variable will be showed in an <b>h1</b> element, else if the <b>h2</b> attribute is present, it will be showed in an <b>h2</b> 
    element else it will be showed in a <b>p</b> element. The props here have the same name as the elements but it is not required.</li>
</ul>
<br/>
<p>Here is the result we obtain if we add the <b>h2</b> attribute to the <b>face</b> component:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <c-friends-if text="Hello" h2 style="margin-bottom:2%;min-height:25em;max-height:25em;overflow:scroll"></c-friends-if>
</div>
<p>You can try with the <b>h1</b> attribute or even no attribute and see the difference.</p>
<br/>
<p>For the moment, we only have one column. We would like to have another column called 'All my friends' where there appear 
a little ASCII friend everytime a new friend is added. For that purpose, we'll add a new <b>data</b> variable simply called 
<b>category</b> that will be the title of a second column. This title can be either a <b>h1</b>, <b>h2</b> or <b>p</b> element. 
Therefore it will implement the same logic as the <b>categoryMessage</b> variable. We'll use bootstrap to get our two columns, 
here is what the template becomes : </p>
<pre><code class="language-html">&lt;template&gt;
    &lt;div id="root"&gt;
        &lt;div id="name-input"&gt;
            &lt;input v-model="name"&gt;
            &lt;br/&gt;
            &lt;button v-on:click="addName"&gt;ADD A NEW FRIEND&lt;/button&gt;
        &lt;/div&gt;
        &lt;div class="row"&gt;
            &lt;div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"&gt;
                &lt;h1 v-if="h1"&gt;</code><code class="language-js">@{{ categoryMessage }}</code></code><code class="language-html">&lt;/h1&gt;
                &lt;h2 v-else-if="h2"&gt;</code><code class="language-js">@{{ categoryMessage }}</code></code><code class="language-html">&lt;/h2&gt;
                &lt;p v-else&gt;</code><code class="language-js">@{{ categoryMessage }}</code></code><code class="language-html">&lt;/p&gt;
                &lt;div 
                    v-for="item in friends.slice().reverse().slice(0, 10)"
                    :key="item.id"
                &gt;
                    &lt;p&gt;</code><code class="language-js">@{{ text }} @{{ item.name }}</code></code><code class="language-html">!&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"&gt;
                &lt;h1 v-if="h1"&gt;</code><code class="language-js">@{{ category }}</code></code><code class="language-html">&lt;/h1&gt;
                &lt;h2 v-else-if="h2"&gt;</code><code class="language-js">@{{ category }}</code></code><code class="language-html">&lt;/h2&gt;
                &lt;p v-else&gt;</code><code class="language-js">@{{ category }}</code></code><code class="language-html">&lt;/p&gt;
                &lt;div class="row"&gt;
                    &lt;p 
                        class="col-xs-1 col-sm-1 col-md-1 col-lg-1"
                        v-for="i in id" :key="i"
                    &gt;
                         o  &lt;br/&gt;/|\ &lt;br/&gt; ||  &lt;br/&gt;
                    &lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/template&gt;</code></pre>
<p>Some important information in this new template resides in the <b>v-for</b> attribute of the last <b>p</b> element, the one that 
shows our ASCII friends:</p>
<pre><code class="language-html">&lt;div class="row"&gt;
    &lt;p 
        class="col-xs-1 col-sm-1 col-md-1 col-lg-1"
        v-for="i in id" :key="i"
    &gt;
        o  &lt;br/&gt;/|\ &lt;br/&gt; ||  &lt;br/&gt;
    &lt;/p&gt;
&lt;/div&gt;</code></pre>
<p>This loop iterates on the <b>id</b> variable, and <b>i</b> successively iterates from 1 to the value of id meaning that one ASCII friend will appear for each friend we greeted. 
Note that <b>i</b> does not iterate from 0 to the value of <b>id</b> - 1.</p>
<p>And of course, we don't forget to add the <b>category</b> variable to the <b>data</b> in the script:</p>
<pre><code class="language-js">category: 'All my friends',</code></pre>
<br/>
<p>There is only one step left to complete our app: make one ASCII friend on two become purple and the other become green. 
To achieve this, we'll use the <b>id</b> attribute of the <p> element. Each HTML basic attribute like this one usually can only take a 
<i>String</i> value. However, we've seen that using <b>v-bind:</b> or simply <b>:</b>before an attribute can make it contain JavaScript 
conditional code that permits multiple possible <i>String</i> values. Therefore we can then add a personalized <b>id</b> attribute that will have the 
value <b>friend</b> or <b>enemy</b> depending on the value of <b>i</b>:</p>
<pre><code class="language-html">&lt;div class="row"&gt;
    &lt;p 
        class="col-xs-1 col-sm-1 col-md-1 col-lg-1"
        v-for="i in id" :key="i"
        :id="i % 2 == 0 ? 'friend' : 'enemy'"
    &gt;
        o  &lt;br/&gt;/|\ &lt;br/&gt; ||  &lt;br/&gt;
    &lt;/p&gt;
&lt;/div&gt;</code></pre>
<br/>
<p>We just need to add an <b>h1</b> title above our <b>face</b> component. Like you can see, its color 
is not influenced by the style defined in the <b>face</b> component whose scope only apply to this component.</p>
<br/>
<p>Here is the complete code for our <b>face</b> component:</p>
<pre><code class="language-html">&lt;template&gt;
    &lt;div id="root"&gt;
        &lt;div id="name-input"&gt;
            &lt;input v-model="name"&gt;
            &lt;br/&gt;
            &lt;button v-on:click="addName"&gt;ADD A NEW FRIEND&lt;/button&gt;
        &lt;/div&gt;
        &lt;div class="row"&gt;
            &lt;div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"&gt;
                &lt;h1 v-if="h1"&gt;</code><code class="language-js">@{{ categoryMessage }}</code></code><code class="language-html">&lt;/h1&gt;
                &lt;h2 v-else-if="h2"&gt;</code><code class="language-js">@{{ categoryMessage }}</code></code><code class="language-html">&lt;/h2&gt;
                &lt;p v-else&gt;</code><code class="language-js">@{{ categoryMessage }}</code></code><code class="language-html">&lt;/p&gt;
                &lt;div 
                    v-for="item in friends.slice().reverse().slice(0, 10)"
                    :key="item.id"
                &gt;
                    &lt;p&gt;</code><code class="language-js">@{{ text }} @{{ item.name }}</code></code><code class="language-html">!&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"&gt;
                &lt;h1 v-if="h1"&gt;</code><code class="language-js">@{{ category }}</code></code><code class="language-html">&lt;/h1&gt;
                &lt;h2 v-else-if="h2"&gt;</code><code class="language-js">@{{ category }}</code></code><code class="language-html">&lt;/h2&gt;
                &lt;p v-else&gt;</code><code class="language-js">@{{ category }}</code></code><code class="language-html">&lt;/p&gt;
                &lt;div class="row"&gt;
                    &lt;p 
                        class="col-xs-1 col-sm-1 col-md-1 col-lg-1"
                        v-for="i in id" :key="i"
                        :id="i % 2 == 0 ? 'friend' : 'enemy'"
                    &gt;
                         o  &lt;br/&gt;/|\ &lt;br/&gt; ||  &lt;br/&gt;
                    &lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;</code><code class="language-js">
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
}</code><code class="language-html">
&lt;/script&gt;

&lt;style scoped&gt;</code><code class="language-css">
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
    }</code><code class="language-html">
&lt;/style&gt;</code></pre>
<br/>
<p>Our app is now completely built:</p>
<div style="text-align:center;border-style:solid;border-width:thin;border-color:grey;">
    <h1 style="margin-top:2%;">FaceVue</h1>
    <example-component text="Hello" h2 style="margin-bottom:2%;min-height:30em;max-height:30em;overflow:scroll"></example-component>
</div>
<br/>
<br/>
<h2>Going further</h2>
<p>Vue.js proposes an excellent guide: <a href="https://Vue.js.org/v2/guide/" target="_blank">https://Vue.js.org/v2/guide/</a></p>
<p>Every Vue.js instance stands into a virtual DOM and has a lifecycle in it. You can learn more about it on: <a href="https://Vue.js.org/v2/guide/instance.html">https://Vue.js.org/v2/guide/instance.html</a></p>
<br/>
</div>

        </div>

    </body>
    
</html>



