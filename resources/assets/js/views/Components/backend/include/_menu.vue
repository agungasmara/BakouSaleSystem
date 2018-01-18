<template>
	<header id="header" class="page-topbar">
      <div class="navbar-fixed">
        <nav class="navbar-color gradient-45deg-light-blue-cyan">
          <div class="nav-wrapper">
            <ul class="left">
              <li>
                <h1 class="logo-wrapper">
                  <!-- <a href="/admin" class="brand-logo darken-1"> -->
                    <router-link class="brand-logo darken-1"  to="/admin">
                      <!-- <img src="/images/logo/materialize-logo.png" alt="materialize logo"> -->
                      <span class="logo-text hide-on-med-and-down">Bakou Store</span>
                    </router-link>
                  <!-- </a> -->
                </h1>
              </li>
            </ul>
            <div class="header-search-wrapper hide-on-med-and-down">
              <i class="material-icons">search</i>
              <input type="text" name="Search" class="header-search-input z-depth-2 search-box" placeholder="Search Product" />
            </div>
            <ul class="right hide-on-med-and-down">
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                  <span class="flag-icon flag-icon-gb"></span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen">
                  <i class="material-icons">settings_overscan</i>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown">
                  <i class="material-icons">notifications_none
                    <small class="notification-badge orange accent-3">5</small>
                  </i>
                </a>
              </li>
              <li>
                <a href="javascript:void(0);" class="waves-effect waves-block waves-light profile-button" data-activates="profile-dropdown">
                  <span class="avatar-status avatar-online">
                    <img src="/images/avatar/avatar-7.png" alt="avatar">
                    <i></i>
                  </span>
                </a>
              </li>
              <li>
                <a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse">
                  <i class="material-icons">format_indent_increase</i>
                </a>
              </li>
            </ul>
            <!-- translation-button -->
            <ul id="translation-dropdown" class="dropdown-content">
              <li>
                <a href="#!" class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-gb"></i> English</a>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-fr"></i> French</a>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-cn"></i> Chinese</a>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-1">
                  <i class="flag-icon flag-icon-de"></i> German</a>
              </li>
            </ul>
            <!-- notifications-dropdown -->
            <ul id="notifications-dropdown" class="dropdown-content">
              <li>
                <h6>NOTIFICATIONS
                  <span class="new badge">5</span>
                </h6>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
              </li>
              <li>
                <a href="#!" class="grey-text text-darken-2">
                  <span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
              </li>
            </ul>
            <!-- profile-dropdown -->
            <ul id="profile-dropdown" class="dropdown-content">
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">face</i> Profile</a>
              </li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">settings</i> Settings</a>
              </li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">live_help</i> Help</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#" class="grey-text text-darken-1">
                  <i class="material-icons">lock_outline</i> Lock</a>
              </li>
              <li>
                <a href="/auth/logout" class="grey-text text-darken-1">
                  <i class="material-icons">keyboard_tab</i> Logout</a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- HORIZONTL NAV START-->
        <nav id="horizontal-nav" class="white hide-on-med-and-down">
          <div class="nav-wrapper">
            <ul id="ul-horizontal-nav" class="left hide-on-med-and-down">
            	<li v-for="m of menu_data">
                <router-link class="dropdown-menu" :to="m.p_menu_link" :data-activates="thClassValue(m.parent_menu_id)">
                  <i class="material-icons">{{m.fa_icon}}</i>
                  <span>{{m.parent_menu_name}}
                    <i class="material-icons right">keyboard_arrow_down</i>
                  </span>
                </router-link>
	            </li>
            </ul>
          </div>
        </nav>
        <!-- Dashboarddropdown -->
        <!-- <ul v-for="menu of menu_data['children_menu']" id="" class="dropdown-content dropdown-horizontal-list">
          <li><a href="dashboard-ecommerce.html">eCommerce</a></li>
          <li class="active"><a href="/admin">Analytics</a></li>
        </ul> -->
        <!-- Templatesdropdown -->
        <ul v-for="m of menu_data" :id="thClassValue(m.parent_menu_id)" class="dropdown-content dropdown-horizontal-list">
          <li v-for="sm of m['children_menu']"><router-link :to="sm.c_menu_link">{{sm.child_menu_name}}</router-link></li>
        </ul>
        <!-- Cardsdropdown -->
        <ul id="Cardsdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="cards-basic.html">Basic</a></li>
          <li><a href="cards-advance.html">Advance</a></li>
          <li><a href="cards-extended.html">Extended</a></li>
        </ul>
        <!-- CSSdropdown -->
        <ul id="CSSdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="css-typography.html">Typography</a></li>
          <li><a href="css-color.html">Color</a></li>
          <li><a href="css-grid.html">Grid</a></li>
          <li><a href="css-helpers.html">Helpers</a></li>
          <li><a href="css-media.html">Media</a></li>
          <li><a href="css-pulse.html">Pulse</a></li>
          <li><a href="css-sass.html">Sass</a></li>
          <li><a href="css-shadow.html">Shadow</a></li>
          <li><a href="css-animations.html">Animations</a></li>
          <li><a href="css-transitions.html">Transition</a></li>
        </ul>
        <!-- BasicUIdropdown-->
        <ul id="BasicUIdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="ui-basic-buttons.html">Basic</a></li>
          <li><a href="ui-extended-buttons.html">Extended</a></li>
          <li><a href="ui-icons.html">Icons</a></li>
          <li><a href="ui-alerts.html">Alerts</a></li>
          <li><a href="ui-badges.html">Badges</a></li>
          <li><a href="ui-breadcrumbs.html">Breadcrumbs</a></li>
          <li><a href="ui-chips.html">Chips</a></li>
          <li><a href="ui-collections.html">Collections</a></li>
          <li><a href="ui-navbar.html">Navbar</a></li>
          <li><a href="ui-pagination.html">Pagination</a></li>
          <li><a href="ui-preloader.html">Preloader</a></li>
        </ul>
        <!-- AdvancedUIdropdown-->
        <ul id="AdvancedUIdropdown" class="dropdown-content dropdown-horizontal-list">
          <li>
            <router-link class="dropdown-menu"  to="/admin/list">
              Carousel
            </router-link>
          </li>
          <li><a href="advance-ui-collapsibles.html">Collapsible</a></li>
          <li><a href="advance-ui-toasts.html">Toasts</a></li>
          <li><a href="advance-ui-tooltip.html">Tooltip</a></li>
          <li><a href="advance-ui-dropdown.html">Dropdown</a></li>
          <li><a href="advance-ui-feature-discovery.html">Feature Discovery</a></li>
          <li><a href="advanced-ui-media.html">Media</a></li>
          <li><a href="advanced-ui-modals.html">Modals</a></li>
          <li><a href="advance-ui-scrollfire.html">ScrollFire</a></li>
          <li><a href="advance-ui-scrollspy.html">Scrollspy</a></li>
          <li><a href="advance-ui-tabs.html">Tabs</a></li>
          <li><a href="advance-ui-transitions.html">Transitions</a></li>
          <li><a href="advance-ui-waves.html">Waves</a></li>
        </ul>
        <!-- ExtraComponentsdropdown-->
        <ul id="ExtraComponentsdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="extra-components-range-slider.html">Range Slider</a></li>
          <li><a href="extra-components-sweetalert.html">SweetAlert</a></li>
          <li><a href="extra-components-nestable.html">Shortable & Nestable</a></li>
          <li><a href="extra-components-translation.html">Language Translation</a></li>
          <li><a href="extra-components-highlight.html">Highlight</a></li>
        </ul>
        <!-- Tablesdropdown -->
        <ul id="Tablesdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="table-basic.html">Basic Tables</a></li>
          <li><a href="table-data.html">Data Tables</a></li>
          <li><a href="table-jsgrid.html">jsGrid</a></li>
          <li><a href="table-editable.html">Editable Table</a></li>
          <li><a href="table-floatThead.html">FloatThead</a></li>
        </ul>
        <!-- Formsdropdown -->
        <ul id="Formsdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="form-elements.html">Form Elements</a></li>
          <li><a href="form-layouts.html">Form Layouts</a></li>
          <li><a href="form-validation.html">Form Validations</a></li>
          <li><a href="form-masks.html">Form Masks</a></li>
          <li><a href="form-file-uploads.html">File Uploads</a></li>
        </ul>
        <!-- Pagesdropdown -->
        <ul id="Pagesdropdown" class="dropdown-content dropdown-horizontal-list">
          <li><a href="page-contact.html">Contact Page</a></li>
          <li><a href="page-todo.html">ToDos</a></li>
          <li><a href="page-blog-1.html">Blog Type 1</a></li>
          <li><a href="page-blog-2.html">Blog Type 2</a></li>
          <li><a href="page-404.html">404</a></li>
          <li><a href="page-500.html">500</a></li>
          <li><a href="page-blank.html">Blank</a></li>
        </ul>
      </div>
      <!-- <ul class="temp-menu">
        <li v-for="menu in menus">
          {{ menu.label }}
          <ul>
            <li v-for="child in menu.child">
              <router-link :to="child.url">{{ child.label }}</router-link>
            </li>
          </ul>
        </li>
      </ul> -->
    </header>
</template>

<script type="text/javascript">
	import axios from 'axios';
  import common from '../../../../helper/common' 
    export default{
        data(){
            return{
            	activityMenu:'',
                menu_data:[],
                menus:[
                  {label:'Setting',child:[
                    {label:'Create',url:'/admin/settings/add'},
                    {label:'List',url:'/admin/settings/list'}
                  ]},
                  {label:'Users',child:[
                    {label:'Create',url:'/admin/users/add'},
                    {label:'List',url:'/admin/users/list'}
                  ]}
                ]
            }
        },
        created() {
          this.getApiMenu();
          // $.getScript("http://localhost:8000/js/materialize.min.js");
          let dataTable = document.createElement('script');    
          dataTable.setAttribute('src',"../../js/materialize.min.js");
          document.head.appendChild(dataTable);
        },
        methods:{
        	thClassValue (id) {
            var value = ['Templatesdropdown'+id]
            // if (this.orderKey === id) {
            //   value.push('active')
            // }
            return value.join(' ')
          },
          getApiMenu(){
            axios.get(`/admin/api/getMenus`)
            .then(response => {
              this.menu_data = response.data['data']
            })
            .catch(e => {
              this.errors.push(e)
            })
          }
        }
    }
</script>