<template>
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="0"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-app>
</template>
<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/manufacturers/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm4 md4',	 key:'name',	type:'text',	 text:'Name',count:100	},
					{	class:'xs12 sm4 md4',	 key:'sort_order',	type:'number',text:'Sort Order',count:5	},
					{	class:'xs12 sm4 md4',	 key:'image',	type:'image',	 text:'Image'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 100 || 'Name must be less than 100 characters'
				    ],
				    sort_order: [
				      (v) => !!v || 'Sort Order is required',
				      (v) => v && v.length <= 10 || 'Sort Order must be less than 10 characters'
				    ]
				},
				data:{
					name:'',
					sort_order:'',
					image: ''
				},
				select:{
					
				},
				breadcrumbTitle:'Manufacturers',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Manufacturers',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/manufacturers/list',
			}
		},
		created(){
			
		},
		methods:{
			
		}
	}
</script>