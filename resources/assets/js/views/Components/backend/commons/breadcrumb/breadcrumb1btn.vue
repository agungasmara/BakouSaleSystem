<template>
	<!--breadcrumbs start-->
		<div id="breadcrumbs-wrapper">
			<!-- Search for small screen -->
			<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
			  <input type="text" class="header-search-input z-depth-2" placeholder="Explore Materialize">
			</div>
			<div class="container">
			  <div class="row">
			    <div class="col s10 m6 l6">
			      <h5 class="breadcrumbs-title">{{ breadcrumbTitle }}</h5>
			      	<v-breadcrumbs>
			        	<v-icon slot="divider">/</v-icon>
		        		<v-breadcrumbs-item  v-for="item in breadcrumbItem" :key="item.text" :disabled="item.disabled">
		          			{{ item.text }}
		        		</v-breadcrumbs-item>
		      		</v-breadcrumbs>
			    </div>
			    <div class="col s2 m6 l6">
			    	<router-link :to="btnNewUrl" replace>
			    		<v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Create New</v-btn>
			    	</router-link>
			    </div>
			  </div>
			</div>
		</div>
		<!--breadcrumbs end-->
</template>
<script type="text/javascript">
	export default{
		props:[
			'breadcrumbItem',
			'btnNewUrl',
			'breadcrumbTitle'
		]
	}
</script>