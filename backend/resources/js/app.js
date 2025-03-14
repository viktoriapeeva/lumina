import "./bootstrap";

import { createApp } from "vue";
import axios from "axios";

import Example from "./components/Example.vue";

const app = createApp({
    components: {
        Example,
    },
});

app.mount("#app");
