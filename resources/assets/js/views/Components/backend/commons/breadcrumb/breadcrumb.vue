<template>
	<div id="breadcrumbs-wrapper">

      </v-breadcrumbs>
		<v-breadcrumbs>
        	<v-icon slot="divider">chevron_right</v-icon>

    		<v-breadcrumbs-item v-for="item in breadcrumbItem" :key="item.text" :disabled="item.disabled">

      			{{ item.text }}

    		</v-breadcrumbs-item>
    	</v-breadcrumbs>
	</div> 
</template>
<script type="text/javascript">
	export default{
		props:[
			'breadcrumbItem'
		]
	}
</script>