<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            :clipped="$vuetify.breakpoint.lgAndUp"
        >
            <v-list
                nav
                dense
            >
                <v-list-item-group
                    active-class="deep-purple--text text--accent-4"
                >
                    <template v-for="item in menu">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>{{ item.icon }}</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title @click="link(item.name)">{{ item.display }}</v-list-item-title>
                        </v-list-item>
                    </template>

                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar
            dark
            app
            :clipped-left="$vuetify.breakpoint.lgAndUp"
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <template>
                <div class="right">
                    <form action="/logout" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="submit" value="logout">
                    </form>
                </div>
            </template>
        </v-app-bar>
        <v-main>
            <v-container
                class="fill-height"
                fluid
            >
                <router-view></router-view>
            </v-container>
        </v-main>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                drawer: false,
                menu: [],
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
            }
        },
        created() {
            this.buildMenu();
        },
        methods: {
            link(name) {
                if (this.$router.currentRoute.name !== name) {
                    this.$router.push({name: name}).then(() => {
                        this.buildMenu();
                    });
                }
            },
            buildMenu() {
                this.menu = [];
                if (/^(panel.*)$/.test(this.$router.currentRoute.name)) {
                    this.setMenuItems(1)
                } else {
                    this.setMenuItems(0);
                }
            },
            setMenuItems(menuType) {
                if(menuType === 1) {
                    this.menu.push({
                        display: 'Back',
                        icon: 'mdi-arrow-left-circle',
                        name: 'home.index'
                    })
                }
                this.$router.options.routes[menuType].children.forEach(route => {
                    this.menu.push({
                        display: route.display,
                        icon: route.icon,
                        name: route.name
                    })
                });
                if (menuType !== 1) {
                    this.menu.push({
                        display: 'Panel',
                        icon: 'mdi-tablet-dashboard',
                        name: 'panel.dashboard'
                    })
                }
            }
        }
    }
</script>
