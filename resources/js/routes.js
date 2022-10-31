window.Vue = require('vue');
import Router from 'vue-router';
import AllPosts from './components/AllPosts.vue';
import AddPost from './components/AddPost.vue';
import Registation from './components/Registation';
import EditPost from './components/EditPost.vue';
import About from './components/About.vue';
import Help from './components/Help.vue';
import Home1 from './components/Home.vue';
import Detail from './components/Detailpage.vue';
import Login from './components/Login.vue';
import pagenotfound from './components/pagenotfound'
import Profile from './components/Profile.vue';
import Profile1 from './components/Profile1.vue';
import Editeprofile from './components/Editeprofile.vue';
import Test from './components/Test.vue';
// import Alluser from './components/Alluser.vue';
import Addposts from './components/Addposts.vue';
import Mypost from './components/Mypost.vue';
import Allnewpost from './components/Allnewpost.vue';
import Editepost from './components/Editepost.vue';
import Demoprofile from './components/Demoprofile.vue';
Vue.use(Router)

 const routes = [
    {name: 'loginaccount',path: '/loginaccount',component: Login, meta: {
        hideForAuth: true
    }},
    { path: '/demoprofile', name: 'Demoprofile', component: Demoprofile ,meta: {auth: true}},
    { path: '/new', name: 'Registation', component: Registation },
    {name: 'Test',path: '/test',component: Test,meta: {auth: true}},
    {name: 'Profile',path: '/profile',component: Profile,meta: {auth: true}},
    {name: 'Profile1',path: '/profile1',component: Profile1,meta: {auth: true}},
    {name: 'Editeprofile',path: '/editeprofile',component: Editeprofile,meta: {auth: true}},
    {name: 'Addposts',path: '/Addposts',component: Addposts,meta: {auth: true}},
    {name: 'allnewpost',path: '/allnewpost',component: Allnewpost},
    {name: 'editepost',path: '/editepost/:id',component: Editepost,meta: {auth: true}},
    {name: 'Mypost',path: '/Mypost',component: Mypost,meta: {auth: true}},
    {name: 'allnewpost',path: '/allnewpost',component: Allnewpost},
    
    
    {
        name: 'home',
        path: '/data',
        component: AllPosts,meta: {auth: true}
    },
    
    {
        name: 'alldata',
        path: '/alldata/:id',
        component: Detail,meta: {auth: true}
    },
    {
        name: 'Home1',
        path: '/all',
        component: Home1,meta: {auth: true}
    },
    {
        name: 'add',
        path: '/add',
        component: AddPost,meta: {auth: true}
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost,meta: {auth: true}
    },
    {
        name: 'about',
        path: '/about',
        component: About,meta: {auth: true}
    },
    {
        name: 'Help',
        path: '/help',
        component: Help,meta: {auth: true}
    },
    {
        name: 'Help22',
        path: '/help',
        component: Help,meta: {auth: true}
    },
    { path: '*', name: 'pagenotfound', component: pagenotfound },
];
const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes

});
router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
  
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
      next('/loginaccount')
      return
    }
    else{
        next()
    }
    
    if (to.matched.some(record => record.meta.hideForAuth) && loggedIn) {
        
            next({ path: '/profile1' });
            return
    }
     else {
        next();
    }
  })

  export default router;