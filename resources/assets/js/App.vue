<style>
  ul.temp-nav li ul.sub-temp-nav li{
    display:inline;
    margin-top:100px;
    padding:0 10px 0 10px;
  }
</style>

<template>
    <div>
        <!-- Start Page Loading -->
        <div id="loader-wrapper">
          <div id="loader"></div>
          <div class="loader-section section-left"></div>
          <div class="loader-section section-right"></div>
        </div>
        <!-- End Page Loading -->

        <!--<div>
          <span class="pokemon-name"></span>
        </div>
        <img class="pokemon-image"></img>-->

        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START HEADER -->

        <template>
          <MenuComponent/>
        </template>

      
        <!-- END HEADER -->
        
        <!-- START MAIN -->
        <div id="main">
          <div class="wrapper">

            <router-view></router-view>
            <!-- aside -->
            <aside id="left-sidebar-nav hide-on-large-only">
              <ul id="slide-out" class="side-nav leftside-navigation">
                <li class="no-padding">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li class="bold">
                      <a href="app-email.html" class="waves-effect waves-cyan">
                        <i class="material-icons">mail_outline</i>
                        <span>Mailbox</span>
                      </a>
                    </li>
                    <li class="bold">
                      <a href="app-calendar.html" class="waves-effect waves-cyan">
                        <i class="material-icons">today</i>
                        <span>Calender</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
              <a href="#" style="z-index:99999" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
                <i class="material-icons">menu</i>
              </a>
            </aside>
          </div>
        </div>

        <!-- START FOOTER -->
        <footer class="page-footer">
          <div class="footer-copyright">
            <div class="container">
              <span>Copyright ©<a class="grey-text text-lighten-4" href="#" target="_blank">PIXINVENT</a> All rights reserved.</span>
              <span class="right hide-on-small-only"> Design and Developed by <a class="grey-text text-lighten-4" href="#">PIXINVENT</a></span>
            </div>
          </div>
        </footer>
        <!-- <router-view class="view"></router-view> -->
    </div>
</template>


<script type="text/javascript">
    import Flash from './helper/flash'
    // template
    import MenuComponent from './views/Components/backend/include/_menu.vue'

    export default{
        data(){
            return{
                flash: Flash.state
            }
        },
        components:{
          MenuComponent,
        },
        methods: function() {
            alert('sd');
            // window.location = "#/login";
        },
        mounted: function () {
            // window.location = "#/home";
        },
        created() {
          // createIndex('http://localhost:9200', params);
          // Vue.http.put("http://localhost:9200", params)

          // async / await version (created() becomes async created())
          
          // try {
          //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
          //   this.posts = response.data
          // } catch (e) {
          //   this.errors.push(e)
          // }
        }
    }
</script>
