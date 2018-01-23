<template>
    <ul class="dropdown-menu">
        <li><router-link to="">KH</router-link></li>
        <li><router-link to="">EN</router-link></li>
    </ul>
</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import Common from '../../../../helper/common'
    import {post} from '../../../../helper/api'

    export default {
        data() {
            return {
              flash: Flash.state,
              error: Flash.state,
              error: {},
              latestProducts: [],
              isProcessing: false,
              getCurrent:'',
            }
        },
        components:{

        },
        mounted(){

        },
        ready: function(){

        },
        created() {
          axios.get(`/api/latest`)
            .then(response => {
              this.latestProducts = response.data['data']
            console.log("##########################################")
            console.log(this.latestProducts)
            })
            .catch(e => {
              this.errors.push(e)
            })

        },
        ready() {
           
        },
        methods: {
          
          
        }
    }
</script>