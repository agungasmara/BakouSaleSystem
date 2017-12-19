<template>
  <div>
    <router-view></router-view>
  </div>
</template>
<!-- frontEnd App -->
<script type="text/javascript">
  import Flash from './helper/flash'
  export default{
    data(){
      return{
        flash: Flash.state,
      }
    },
    methods: function() {
        alert('sd');
        // window.location = "#/login";
      },
      mounted: function(){
        // window.location = "#/home";
    },
  }
</script>
