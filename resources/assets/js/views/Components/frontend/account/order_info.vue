<template>
	<div v-bind:class="{ active: isActive }" class="loading">
		
        <div class="container main-container headerOffset">
            <div class="row">
                <div class="breadcrumbDiv col-lg-12">
                    <ul class="breadcrumb">
                        <li><a href="">Home</a></li>
                        <li><a href="">My Account</a></li>
                        <li class="active"> Order List</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-7">
                    <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order Information </span></h1>

                    <div class="row userInfo">
                        <div class="col-lg-12">
                            <h2 class="block-title-2"> Your Order Information </h2>
                        </div>


                        <div v-for="data in response" class="statusContent">


                            <div class="col-sm-12">
                                <div class=" statusTop">
                                    <p><strong>Status:</strong> OnHold</p>

                                    <p><strong>Order Date:</strong> {{data.date_added}}<!-- Saturday, April 09,2015 --></p>

                                    <p><strong>Order Number:</strong> #{{data.order_id}} </p>
                                </div>
                            </div>
                            <div class="col-sm-6 order-info-zindex">
                                <div class="order-box">
                                    <div class="order-box-header">
                                        Billing Address
                                    </div>


                                    <div class="order-box-content">
                                        <div class="address">
                                            <p><strong>{{data.payment_firstname}} {{data.payment_last}} </strong></p>

                                            <p><strong>{{data.payment_firstname}} {{data.payment_last}} </strong></p>

                                            <div class="adr">
                                                - {{data.payment_address_1}} <br/>
                                                - {{data.payment_address_2}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="col-sm-6 order-info-zindex">
                                <div class="order-box">
                                    <div class="order-box-header">

                                        Shipping Address
                                    </div>


                                    <div class="order-box-content">


                                        <div class="address">
                                            <p><strong>TITLE</strong></p>

                                            <p><strong>{{data.shipping_firstname}} {{data.shipping_lastname}} </strong></p>

                                            <div class="adr">
                                                - {{data.shipping_address_1}}<br/>
                                                - {{data.shipping_address_2}}
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>

                            <div style="clear: both"></div>

                            <div class="col-sm-6 order-info-zindex">
                                <div class="order-box">
                                    <div class="order-box-header">

                                        Payment Method
                                    </div>

                                    <div class="order-box-content">
                                        <div class="address">
                                            <p>Payment via Master Card 
                                                <span style="color: green" class="green"> 
                                                    <strong>(Paid)</strong>
                                                </span>
                                            </p>
                                            <p><strong>Name Of card: </strong> Ruth F. Burns </p>

                                            <p><strong>Card Number: </strong> 00335 251 124 </p>

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="col-sm-6 order-info-zindex">
                                <div class="order-box">
                                    <div class="order-box-header">

                                        Shipping Method
                                    </div>


                                    <div class="order-box-content">
                                        <div class="address">
                                            <p> via Post Air Mail <a title="tracking number" href="#">#4502</a></p>

                                            <p><strong>Ruth F. Burns </strong></p>

                                            <div class="adr">
                                                4894 Burke Street<br>North Billerica, MA 01862
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                            <div class="col-sm-12 order-info-zindex clearfix">
                                <div class="order-box">
                                    <div class="order-box-header">

                                        Order Items
                                    </div>


                                    <div class="order-box-content">
                                        <div class="table-responsive">
                                            <table class="order-details-cart">
                                                <tbody>
                                                <tr v-for="op in order_product" class="cartProduct">
                                                    <td class="cartProductThumb" style="width:20%">
                                                        <div><a href=""> <img v-bind:alt="op.name" v-bind:src="op.image">
                                                        </a></div>
                                                    </td>
                                                    <td style="width:40%">
                                                        <div class="miniCartDescription">
                                                            <h4><a href=""> {{op.name}} </a></h4>
                                                            <div class="price"><span> ${{op.price}} </span></div>
                                                        </div>
                                                    </td>
                                                    <td class="" style="width:10%"><a> X {{op.quantity}} </a></td>
                                                    <td class="" style="width:15%"><span> ${{op.total}} </span></td>

                                                </tr>

                                                <tr class="cartTotalTr blank">
                                                    <td class="" style="width:20%">
                                                        <div></div>
                                                    </td>
                                                    <td style="width:40%"></td>
                                                    <td class="" style="width:20%"></td>
                                                    <td class="" style="width:15%"><span>  </span></td>

                                                </tr>

                                                <tr class="cartTotalTr">
                                                    <td class="" style="width:20%">
                                                        <div></div>
                                                    </td>
                                                    <td colspan="2" style="width:40%">Total products</td>
                                                    <td class="" style="width:15%"><span> $216.51 </span></td>

                                                </tr>
                                                <tr class="cartTotalTr">
                                                    <td class="" style="width:20%">
                                                        <div></div>
                                                    </td>
                                                    <td colspan="2" style="width:40%">Shipping</td>
                                                    <td class="" style="width:15%"><span> $10.51 </span></td>

                                                </tr>
                                                <tr class="cartTotalTr">
                                                    <td class="" style="width:20%">
                                                        <div></div>
                                                    </td>
                                                    <td colspan="2" style="width:40%">Total (tax excl.)</td>
                                                    <td class="" style="width:15%"><span> $216.51 </span></td>

                                                </tr>
                                                <tr class="cartTotalTr">
                                                    <td class="" style="width:20%">
                                                        <div></div>
                                                    </td>
                                                    <td style="width:40%"></td>
                                                    <td class="" style="width:20%">SubTotal</td>
                                                    <td class="" style="width:15%"><span class="price"> $216.51 </span></td>

                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>


                        <div class="col-lg-12 clearfix">
                            <ul class="pager">
                                <li class="previous pull-right">
                                    <router-link v-bind:to="'/'" title="Orders">
                                       <i class="fa fa-home"></i> Go to Shop
                                    </router-link>
                                </li>
                                <li class="next pull-left">
                                     <router-link v-bind:to="'/account/orderlist'" title="Orders">
                                            ← Back to My Order List
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/row end-->

                </div>
                <div class="col-lg-3 col-md-3 col-sm-5"></div>
            </div>
            <!--/row-->

            <div style="clear:both"></div>
        </div>
        <!-- /main-container -->

        <div class="gap"></div>
	</div>
</template>

<script type="text/javascript">

  import axios from 'axios'
  import Flash from '../../../../helper/flash'
  import VueTranslate from 'vue-translate-plugin'
  import Vue from 'vue';
  Vue.use(VueTranslate);
  
  export default{
    props:['id'],
    data(){
      return{
        isActive: true,
        loading:true,
        response: null,
        order_product:[]
      }
    },
    created() {
        this.getOrderInfo(this.id)
    },
    methods:{
        getOrderInfo(id){
            axios.get('/api/order/'+this.id)
            .then(response => {
                this.response = response.data['data']
                this.order_product = response.data['order_product']
                this.isActive = !this.isActive
            })
            .catch(e => {
              this.errors.push(e)
            })
        }
    },
    locales: {
        en: {
            'entry_personal_information': 'My personal information',
            'entry_text_update_information': 'Please be sure to update your personal information if it has​​​​ changed.',
            'entry_require_field': 'Required Field'
        },
        kh: {
            'entry_personal_information': 'ពត៌មានផ្ទាល់ខ្លួន',
            'entry_text_update_information': 'Please be sure to update your personal information if it has​​​​ changed.',
            'entry_require_field': 'Required Field'
        }
    },
    mounted: function(){

    }
  }
</script>