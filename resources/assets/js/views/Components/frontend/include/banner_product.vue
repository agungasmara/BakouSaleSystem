<template>
	<div>
		<div class="width100 section-block ">
        <div class="row featureImg" v-for="cat in getProductCategorySlide">
            <div class="col-md-3 col-sm-3 col-xs-6" v-for="cat_banner of cat['BannerImageArray']">
            	<router-link to="/product/product_detail/1">
	            	<img v-bind:src="cat_banner.image" class="img-responsive" alt="img">
                </router-link>
            </div>
        </div>
        <!--/.row-->
    </div>
	</div>
</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import Common from '../../../../helper/common'
    import {post} from '../../../../helper/api'
    import CartAction from '../../../../helper/cart'

    export default {
        data() {
            return {
              flash: Flash.state,
              error: Flash.state,
              error: {},
              getProductCategorySlide: [],
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
          axios.get(`/api/banner`)
  		    .then(response => {
  		      this.getProductCategorySlide = response.data['getProductCategory']
            console.log("##########################################")
            console.log("Banner=>"+ this.getProductCategorySlide)
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