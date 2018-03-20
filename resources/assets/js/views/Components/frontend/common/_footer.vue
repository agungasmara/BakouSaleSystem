<template>
	<footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
                        <h3> Support </h3>
                        <ul>
                            <li class="supportLi">
                                <p> Bakou Systems is one of the fast growing solution company, provides full service of Converged ICT and ELV systems, we have been delivering quality products, professional services yet cost effective to our customer. </p><br/>
                                <h4><a class="inline" href="callto:+855 87 575 787"> <strong> <i class="fa fa-phone"> </i>
                                    (+855)87 575 787 </strong> </a></h4>
                                <h4><a class="inline" href="mailto:info@bakousystems.com"> <i class="fa fa-envelope-o"> </i>info@bakousystems.com </a></h4>
                            </li>
                        </ul>
                    </div>
                   <!--  <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                        <h3> Shop </h3>
                        <ul>
                            <li><a href="#">
                                Men's
                            </a></li>
                            <li><a href="#">
                                Women's</a></li>
                            <li><a href="#">
                                Kids'
                            </a></li>
                            <li><a href="#">Shoes
                            </a></li>
                            <li><a href="#">
                                Gift Cards
                            </a></li>
                        </ul>
                    </div> -->

                    <div style="clear:both" class="hide visible-xs"></div>

                    <div class="col-lg-3  col-md-2 col-sm-4 col-xs-6">
                        <h3>Information</h3>
                        <ul class="list-unstyled footer-nav">
                            <li v-for="footer of footers">
                            	 <router-link v-bind:to="'/information/information_detail/'+ footer.information_id">
	                          		{{footer.title}}
	                          	</router-link>
                            	<!-- <router-link v-bind:to="'/product/product_detail/'+ bestSellerProduct.product_id">
                            	  	{{footer.title}}
		                        </router-link> -->
                        	</li>
                        </ul>
                    </div>


                    <div class="col-lg-3  col-md-2 col-sm-4 col-xs-6">
                        <h3> My Account</h3>
                        <ul>
                            <li><router-link to="/account/dashboard"> My Account </router-link></li>
                            <li><router-link to="/account/addressmy"> My Address </router-link></li>
                            <li><router-link to="/account/wishlist"> Wish List </router-link></li>
                            <li><router-link to="/account/orderlist"> Order list </router-link></li>
                            <li><router-link to="/account/wishlist"> Wishlists </router-link></li>
                        </ul>
                    </div>

                    <div style="clear:both" class="hide visible-xs"></div>

                    <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                        <h3> Stay In Touch</h3>
                        <ul>
                            <li>
                                <div class="input-append newsLatterBox text-center">
                                    <input type="text" class="full text-center" placeholder="Email">
                                    <button class="btn  bg-gray" type="button"> SubSCript <i
                                            class="fa fa-long-arrow-right"> </i></button>
                                </div>
                            </li>
                        </ul>
                        <ul class="social">
                            <li>
                                <a href=""> 
                                    <i class=" fa fa-facebook"> &nbsp; </i> 
                                </a>
                            </li>
                            <li>
                                <a href=""> 
                                    <i class="fa fa-twitter"> &nbsp; </i> 
                                </a>
                            </li>
                            <li>
                                <a href=""> 
                                    <i class="fa fa-google-plus"> &nbsp; </i> 
                                </a>
                            </li>
                            <li>
                                <a href=""> 
                                    <i class="fa fa-pinterest"> &nbsp; </i> 
                                </a>
                            </li>
                            <li>
                                <a href=""> 
                                    <i class="fa fa-youtube"> &nbsp; </i> 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </div>
        <!--/.footer-->

        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left"> &copy; TSHOP 2018. All right reserved. </p>

                <div class="pull-right paymentMethodImg">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/master_card.png" alt="img"> 
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/visa_card.png" alt="img">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/paypal.png" alt="img">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/american_express_card.png" alt="img"> 
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/discover_network_card.png" alt="img">
                    <img height="30" class="pull-right" src="/assets/frontend/images/site/payment/google_wallet.png" alt="img">

                </div>
            </div>
        </div>
        <!--/.footer-bottom-->
    </footer>

</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'

    export default {
        data() {
            return {
                flash: Flash.state,
                error: Flash.state,
                //StateData:Flash.state,
                error: {},
                footers: [],
                isProcessing: false
            }
        },
        created() {
          axios.get(`/api/footer`)
  		    .then(response => {
            
  		      this.footers = response.data['data']
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