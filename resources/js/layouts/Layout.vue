<template>
    <div>
        <div class="bg-primary py-4">
            <div class="d-flex justify-content-between page-margins">
                <div class="w-1/10 text-xl">
                    {{ logo }}
                </div>
                <div class="w-1/10 text-right">
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <button class="btn btn-md btn-success">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex height-content">
            <div class="w-15p border">
                <template v-for="item in menu">
                    <div class="text-center">
                        <router-link class="menu-link" :to="{name: item.name }">{{ item.display }}</router-link>
                    </div>
                </template>
            </div>
            <div class="bg-info w-85p">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            drawer: false,
            menu: [],
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
            logo: window.APP.name,
        }
    },
    created() {
        console.log(window.APP.name)
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
            this.$router.options.routes.forEach(route => {
                route.children.forEach(child => {
                    this.menu.push({
                        display: child.display,
                        icon: child.icon,
                        name: child.name,
                    })
                })
            })
            // if (/^(panel.*)$/.test(this.$router.currentRoute.name)) {
            //     this.setMenuItems(1)
            // } else {
            //     this.setMenuItems(0);
            // }
        },
        setMenuItems(menuType) {
            if (menuType === 1) {
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
                    name: route.name,
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
<style scoped>
.menu-link {
    display: inline-block;
    width: 100%;
    height: 100%;
    padding: 10px 5px;
}
</style>
