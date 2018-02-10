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
		            <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order List </span></h1>

		            <div class="row userInfo">
		                <div class="col-lg-12">
		                    <h2 class="block-title-2"> Your Order List </h2>
		                </div>

		                <div style="clear:both"></div>

		                <div class="col-xs-12 col-sm-12">
		                    <table class="footable">
		                        <thead>
		                        <tr>
		                            <th data-class="expand" data-sort-initial="true"><span
		                                    title="table sorted by this column on load">Order ID</span></th>
		                            <th data-hide="phone,tablet" data-sort-ignore="true">No. of items</th>
		                            <th data-hide="phone,tablet" data-sort-ignore="true">Invoice</th>
		                            <th data-hide="phone,tablet"><strong>Payment Method</strong></th>
		                            <th data-hide="phone,tablet"><strong></strong></th>
		                            <th data-hide="default"> Total</th>
		                            <th data-hide="default" data-type="numeric"> Date</th>
		                            <th data-hide="phone" data-type="numeric"> Status</th>
		                        </tr>
		                        </thead>
		                        <tbody>
		                        <tr v-for="data in response">
		                            <td>#{{data.order_id}}</td>
		                            <td>{{data.total_product}}
		                                <small>item(s)</small>
		                            </td>
		                            <td><a target="_blank">-</a></td>
		                            <td>Bank Wire</td>
		                            <td>
		                            	<router-link v-bind:to="'/account/order_info/'+ data.order_id" class="btn btn-primary btn-sm">
		                            		view detail
                                		</router-link>
		                            </td>
		                            <td>{{data.currency_code}} {{data.total}}</td>
		                            <td data-value="78025368997">{{data.date_added}}</td>
		                            <td data-value="3"><span class="label label-success">{{data.status}}</span>
		                            </td>
		                        </tr>
		                        </tbody>
		                    </table>
		                </div>

		                <div style="clear:both"></div>

		                <div class="col-lg-12 clearfix">
		                    <ul class="pager">
		                        <li class="previous pull-right">
		                        	<router-link v-bind:to="'/'" title="Orders">
		                               <i class="fa fa-home"></i> Go to Shop
		                            </router-link>
		                        </li>
		                        <li class="next pull-left">
		                        	<router-link v-bind:to="'/account/dashboard'" title="Orders">
                                		← Back to My account
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
    data(){
      return{
        isActive: true,
        loading:true,
        response: null,
      }
    },
    created() {
    	this.loading = true
        axios.get(`/api/order`)
        .then(response => {
            this.response = response.data['data']
            this.isActive = !this.isActive
        })
        .catch(e => {
          this.errors.push(e)
        })

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

        // this.loading = true;

        // return this.$scopedSlots.default({
        //   response: this.response.data['data']
        // })
    }
  }
</script>