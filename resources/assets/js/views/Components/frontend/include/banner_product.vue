<template>
	<div>
		<div class="width100 section-block ">
        <div class="row featureImg">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-1.jpg"
                class="img-responsive" alt="img">
              </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-2.jpg" class="img-responsive" alt="img">
              </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-3.jpg" class="img-responsive" alt="img">
              </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <a href="category.html">
                <img src="/assets/frontend/images/site/new-collection-4.jpg" class="img-responsive" alt="img">
              </a>
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
          AddToCart(product_id,qty=1){
            CartAction.AddToCart(product_id,qty)
            window.scrollTo(100,100)
          }
          
        }
    }
</script>